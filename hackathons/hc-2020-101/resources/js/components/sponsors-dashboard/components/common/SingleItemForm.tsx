import React, { Component } from "react";
import { RouteComponentProps } from "react-router-dom";
import { ISponsorData, IAssetInformation, SingleItemFormFields } from "../../../../interfaces/sponsors.interfaces";
import { Button, Page, Card, TextField, ResourceList, Thumbnail, TextStyle, Badge } from "@shopify/polaris";
import { AddMajorMonotone, AttachmentMajorMonotone } from "@shopify/polaris-icons";
import UploadForm from "./UploadForm";
import DestructiveConfirmation from "./DestructiveConfirmation";
import axios from "axios";
import { descriptions } from "./descriptions";
import { toast } from "react-toastify";

interface ISingleItemFormProps extends RouteComponentProps {
    hasTitle: boolean,
    hasDescription: boolean,
    hasAssets: boolean,
    detailType: string,
    baseSponsorPath: string,
    sponsor: ISponsorData,
    pageTitle: string
}

interface ISingleItemFormState {
    detail_id: number,
    complete: string,
    fields: SingleItemFormFields,
    uploadFormShowing: boolean,
    showDestructiveForm: JSX.Element | undefined,
    isLoading: boolean,
}

class SingleItemForm extends Component<ISingleItemFormProps, ISingleItemFormState> {
    state = {
        detail_id: -1,
        complete: "no",
        fields: {
            title: "",
            description: "",
            files: [],
        },
        uploadFormShowing: false,
        showDestructiveForm: undefined,
        isLoading: true,
    }

    componentDidMount() {
        this.loadContent();
    }

    render() {
        const {
            complete,
            fields,
            uploadFormShowing,
            showDestructiveForm,
            isLoading,
        } = this.state;
        const { title, description, files } = fields;

        return (
            <Page
                breadcrumbs={[{
                    content: this.props.sponsor.name, 
                    url: this.props.baseSponsorPath
                }]}
                title={this.props.pageTitle}
                titleMetadata={isLoading ? <></> : this.generateStatusBadge(complete)}
                // primaryAction={{content: 'Save', disabled: false}}
                // secondaryActions={[{content: 'Duplicate'}, {content: 'View on your store'}]}
            >
                {/* {this.props.detailType in descriptions ? 
                <Card sectioned>
                    {descriptions[this.props.detailType.toString()]}
                </Card>
                : <></>} */}
                <Card sectioned>
                    {this.props.hasTitle ?
                        <>
                            <TextField label="Title" value={title} onChange={this.handleTitleChange} disabled={isLoading} />
                            <br />
                        </>
                    : <></>}
                    {this.props.hasDescription ?
                        <>
                            <TextField label="Description" value={description} onChange={this.handleDescriptionChange} multiline={4} disabled={isLoading}/>
                            <br />
                        </>
                    : <></>}
                    {files.length > 0 ? 
                        <ResourceList
                            resourceName={{singular: 'asset', plural: 'assets'}}
                            items={files}
                            renderItem={this.renderAssetThumbnail}
                            showHeader={true}
                            loading={isLoading}
                            alternateTool={
                                <Button 
                                    plain icon={AddMajorMonotone} 
                                    onClick={() => this.setState({ uploadFormShowing: true })}>
                                </Button>
                            }
                        />
                    : <Button disabled={isLoading} icon={AttachmentMajorMonotone} onClick={() => this.setState({ uploadFormShowing: true })}>Add asset (20MB max.)</Button>}

                    <hr style={{ borderStyle: "solid", borderColor: "#dedede94", margin: "20px 0" }} />
                    <div style={{ float: "right", marginBottom: "20px" }}>
                        <Button 
                            primary 
                            loading={isLoading}
                            onClick={() => this.saveContent(false)}
                        >
                            Save
                        </Button>
                    </div>
                </Card>
                {uploadFormShowing ? <UploadForm 
                    sponsor={this.props.sponsor}
                    onClose={() => this.setState({ uploadFormShowing: false })}
                    onSubmit={(urls: IAssetInformation[]) => {
                        const newURLs: IAssetInformation[] = urls;
                        const oldFiles: IAssetInformation[] = files; 
                        const newFields = fields;
                        newFields.files = oldFiles.concat(newURLs);
                        this.setState({ fields: newFields });
                        this.saveContent(true, () => toast.success(`Successfully uploaded ${newURLs.length} file(s)`));
                    }}
                /> : <></>}
                {showDestructiveForm || <></>}
            </Page>
        );
    }

    handleTitleChange = (value: string) => {
        const newFields = this.state.fields;
        newFields.title = value;
        this.setState({ fields: newFields });
    }

    handleDescriptionChange = (value: string) => {
        const newFields = this.state.fields;
        newFields.description = value;
        this.setState({ fields: newFields });
    }

    renderAssetThumbnail = (item: IAssetInformation) => {
        const { name, url } = item;
        // const thumbnail = <Thumbnail source={url} alt={name}></Thumbnail>;
        const actions = [{
            content: 'Delete',
            onAction: () => this.deleteAsset(item)
        }];
        return (
            <ResourceList.Item
                id={name}
                // media={thumbnail}
                onClick={() => {
                    var win = window.open(item.url, '_blank');
                    win.focus();
                }}
                accessibilityLabel={`View details for ${name}`}
                shortcutActions={actions}
            >
                <h3>
                    <TextStyle variation="strong">{name}</TextStyle>
                </h3>
            </ResourceList.Item>
        );
    }

    deleteAsset(item: IAssetInformation) {
        const destructor : JSX.Element = (
            <DestructiveConfirmation 
                onConfirm={() => this.actuallyDeleteAsset(item)}
                onClose={() => this.setState({ showDestructiveForm: undefined })}
            />
        );

        this.setState({ showDestructiveForm: destructor });
    }

    actuallyDeleteAsset(item: IAssetInformation) {
        if(!this.state.isLoading) {
            this.setState({ isLoading: true });
        }
        // console.log("Trying to delete");
        axios.post(`/sponsors/dashboard-api/remove-asset.json`, {
            sponsor_id: this.props.sponsor.id,
            sponsor_slug: this.props.sponsor.slug,
            asset_url: item.url
        }).then(res => {
            const status = res.status;
            if(status == 200) {
                const payload = res.data;
                if("success" in payload && payload["success"]) {
                    const newFields = this.state.fields;
                    newFields.files = newFields.files.filter(f => f.url !== item.url)
                    this.setState({ fields: newFields });
                    this.saveContent(true, () => toast.success("Successfully removed file"));
                } else {
                    toast.error(`Failed to remove file: ${payload["message"]}`);
                }
            } else {
                toast.error("Failed to remove file");
            }
        }).finally(() => {
            this.setState({ isLoading: false });
        });
    }

    calculateCompleteness(): string {
        let complete = 0;
        let incomplete = 0;
        if(this.props.hasTitle) {
            if(this.state.fields.title.length > 0) {
                complete++;
            } else {
                incomplete++;
            }
        }

        if(this.props.hasDescription) {
            if(this.state.fields.description.length > 0) {
                complete++;
            } else {
                incomplete++;
            }
        }

        if(this.props.hasAssets) {
            if(this.state.fields.files.length > 0) {
                complete++;
            } else {
                incomplete++;
            }
        }

        if(complete == 0) return "no";
        else if(incomplete == 0) return "yes";
        else return "partial";
    }

    generateStatusBadge(completeness: string) {
        if(completeness == "no") return <Badge status={'warning'}>{"Incomplete"}</Badge>;
        else if(completeness == "yes") return <Badge status={'success'}>{"Complete"}</Badge>;
        else if(completeness == "partial")return <Badge status={'attention'}>{"Partially Complete"}</Badge>;        
        else return <Badge status={'new'}>{"Unknown"}</Badge>;        
    }

    private loadContent() {
        if(!this.state.isLoading) {
            this.setState({ isLoading: true });
        }
        axios.post(`/sponsors/dashboard-api/load-resources.json`, {
            sponsor_id: this.props.sponsor.id,
            sponsor_slug: this.props.sponsor.slug,
            detail_type: this.props.detailType
        }).then(res => {
            const status = res.status;
            if(status == 200) {
                const payload = res.data;
                if("success" in payload && payload["success"]) {
                    const detail = payload["details"];
                    if(Array.isArray(detail) && detail.length > 0) {
                        const details: {
                            title: string,
                            description: string,
                            files: IAssetInformation[]
                        } = JSON.parse(detail[0]["payload"]);

                        this.setState({ 
                            isLoading: false,
                            detail_id: detail[0]["id"],
                            complete: detail[0]["complete"],
                            fields: {
                                title: details.title,
                                description: details.description,
                                files: details.files,
                            }
                        });
                        return;
                    }
                }
            }
        }).finally(() => this.setState({ isLoading: false }));
    }

    private saveContent = (silent: boolean = false, then: () => void = () => {}) => {
        if(!this.state.isLoading) {
            this.setState({ isLoading: true });
        }

        const payload = this.state.fields;
        axios.post(`/sponsors/dashboard-api/add-resource.json`, {
            sponsor_id: this.props.sponsor.id,
            sponsor_slug: this.props.sponsor.slug,
            detail_type: this.props.detailType,
            detail_id: this.state.detail_id,
            payload: JSON.stringify(payload),
            complete: this.calculateCompleteness(),
        }).then(res => {
            const status = res.status;
            if(status == 200 || status == 201) {
                const payload = res.data;
                if("success" in payload && payload["success"]) {
                    const detailData = payload["detail"];
                    const details: {
                        title: string,
                        description: string,
                        files: IAssetInformation[]
                    } = JSON.parse(detailData["payload"]);
                    
                    this.setState({ 
                        isLoading: false,
                        complete: detailData["complete"],
                        fields: {
                            title: details.title,
                            description: details.description,
                            files: details.files,
                        }
                    });
                    if(!silent) {
                        toast.success("Form saved");
                    }
                    then();
                    return;
                }
                toast.error(payload["message"]);
            } else {
                toast.error("An error occurred");
            }
        }).finally(() => this.setState({ isLoading: false }));
    }
}

export default React.memo(SingleItemForm);