# Weather App

## Running App
- To start the app first install [laravel sail](https://laravel.com/docs/10.x/sail)
- Install [composer](https://getcomposer.org/) in not already installed
- Go into the `backend` directory and run `composer install`
- Once composer install has finished go into the `frontend ` direct and run `npm install`
- Next, go to the root directory and run `sh backend/vendor/bin/sail up` to start the project
- You can access the front end at `http//localhost:3000`

## Using the app
- Got to `http//localhost:3000` in the browser
- You should see the header and a "weather near me" button, click the button
- First time, it will ask you for your location in the browser click allow on the popup
- Then the latest weather data will be loaded for your area