
provider "aws" {
  region = "eu-west-2"
}

# -------------------------------
# ----------- STAGING -----------
# -------------------------------

module "hc-staging-instance" {
  source                = "./modules/hc-instance"
  name                  = "hc-staging-instance"
  security_group        = "${aws_security_group.hc-instance-security-group.id}"
  APP_URL               = "https://canary.hackcambridge.com"
  APP_DEBUG             = "false"
  APP_ENV               = "staging"
  DB_PREFIX             = "staging_"
  DB_HOST               = module.hc-2022-rds-cluster.endpoint
  DB_DATABASE           = "${var.DB_DATABASE}"
  DB_USERNAME           = "${var.DB_USERNAME}"
  DB_PASSWORD           = "${var.DB_PASSWORD}"
  AWS_ACCESS_KEY_ID     = "${var.S3_AWS_ACCESS_KEY_ID}"
  AWS_SECRET_ACCESS_KEY = "${var.S3_AWS_SECRET_ACCESS_KEY}"
  AWS_BUCKET            = "${var.STAGING_AWS_BUCKET}"
  AUTH0_DOMAIN          = "${var.AUTH0_DOMAIN}"
  AUTH0_CLIENT_ID       = "${var.AUTH0_CLIENT_ID}"
  AUTH0_CLIENT_SECRET   = "${var.AUTH0_CLIENT_SECRET}"
  MAILGUN_SECRET        = "${var.MAILGUN_SECRET}"
    MAILCHIMP_KEY   =   "${var.MAILCHIMP_KEY}"
    MAILCHIMP_DOMAIN = "${var.MAILCHIMP_DOMAIN}"
    MAILCHIMP_APPLICANT_LIST = "${var.MAILCHIMP_APPLICANT_LIST_STAGING}"
    MAILCHIMP_PARTICIPANT_LIST = "${var.MAILCHIMP_PARTICIPANT_LIST_STAGING}"
}

module "hc-staging-cluster" {
  source           = "./modules/hc-cluster"
  name             = "hc-staging"
  launch_template  = module.hc-staging-instance.id
  vpc              = "${aws_default_vpc.default.id}"
  subnets          = ["${aws_default_subnet.default_A.id}", "${aws_default_subnet.default_B.id}"]
  desired_capacity = 1
}

# -------------------------------
# ------------ PROD -------------
# -------------------------------

module "hc-prod-instance" {
  source                = "./modules/hc-instance"
  name                  = "hc-prod-instance"
  security_group        = "${aws_security_group.hc-instance-security-group.id}"
  APP_URL               = "https://hackcambridge.com"
  APP_DEBUG             = "false"
  APP_ENV               = "production"
  DB_PREFIX             = "prod_"
  DB_HOST               = module.hc-2022-rds-cluster.endpoint
  DB_DATABASE           = "${var.DB_DATABASE}"
  DB_USERNAME           = "${var.DB_USERNAME}"
  DB_PASSWORD           = "${var.DB_PASSWORD}"
  AWS_ACCESS_KEY_ID     = "${var.S3_AWS_ACCESS_KEY_ID}"
  AWS_SECRET_ACCESS_KEY = "${var.S3_AWS_SECRET_ACCESS_KEY}"
  AWS_BUCKET            = "${var.PROD_AWS_BUCKET}"
  AUTH0_DOMAIN          = "${var.AUTH0_DOMAIN}"
  AUTH0_CLIENT_ID       = "${var.AUTH0_CLIENT_ID}"
  AUTH0_CLIENT_SECRET   = "${var.AUTH0_CLIENT_SECRET}"
  MAILGUN_SECRET        = "${var.MAILGUN_SECRET}"
    MAILCHIMP_KEY   =   "${var.MAILCHIMP_KEY}"
    MAILCHIMP_DOMAIN = "${var.MAILCHIMP_DOMAIN}"
    MAILCHIMP_APPLICANT_LIST = "${var.MAILCHIMP_APPLICANT_LIST_PROD}"
    MAILCHIMP_PARTICIPANT_LIST = "${var.MAILCHIMP_PARTICIPANT_LIST_PROD}"

}

module "hc-prod-cluster" {
  source           = "./modules/hc-cluster"
  name             = "hc-prod"
  desired_capacity = 1
  launch_template  = module.hc-prod-instance.id
  vpc              = "${aws_default_vpc.default.id}"
  subnets          = ["${aws_default_subnet.default_A.id}", "${aws_default_subnet.default_B.id}"]
}

# -------------------------------
# ---------- DATABASE -----------
# -------------------------------

module "hc-2022-rds-instance" {
    source         = "./modules/hc-rds-instance"
    name           = "hc-2022-rds-instance"
    cluster_id     =  module.hc-2022-rds-cluster.id
}

module "hc-2022-rds-cluster" {
    source           = "./modules/hc-rds-cluster"
    name             = "hc-2022-rds"
    database_name    = "hc_staging"
    security_group   = "${aws_security_group.aurora-security-group.id}"
    DB_USERNAME      = "${var.DB_USERNAME}"
    DB_PASSWORD      = "${var.DB_PASSWORD}"
}
