# Hack Cambridge Website
![alt tag](https://travis-ci.org/HackCambridge/hack-cambridge-website.svg?branch=master)
## Getting Started

To run the website on your machine, make sure you have [Node.js](https://nodejs.org) installed. Then inside this folder, run

```bash
npm install
npm start
```

And your server will be ready to go.

## Environment Variables

Certain environment variables need to be available for features to work. For convenience
you can do this in the `.env` file at the root of your project.

```
MAILCHIMP_API_KEY=
MAILCHIMP_LIST_ID=
APPLICATION_URL=
TEAM_APPLICATION_URL=
STRIPE_PUBLISH_KEY=
STRIPE_PRIVATE_KEY=
GOOGLE_SHEETS_AUTH_EMAIL=
GOOGLE_SHEETS_AUTH_KEY=
GOOGLE_SHEETS_WIFI_SHEET_ID=
```

## Build System

This uses [Gulp](http://gulpjs.org). Install it globally, and then run to build styles and scripts.

```bash
npm install -g gulp
gulp build # Build the assets
gulp serve # Start the server, automatically build assets and reload the browser when changes are made
gulp watch # Watch for changes in assets and build automatically
gulp build --prod # Build production assets (or set NODE_ENV to production)
```

## Deploying

Deploying is done manually through Heroku interface.
