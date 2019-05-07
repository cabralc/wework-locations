## WeWork Locations API

This is a simple API to return WeWork locations from different countries. Included is information on each of the locations.

## How to use
### Prerequisites

Docker is required. Information on how to install Docker here: https://docs.docker.com/install/

## Running the API

- After installing docker and checking out the project, nevigate to the project root.
- Run `docker-compose up`
- After building you will have three containers running: app, webserver and db.
- We need to run a few artisan commands in order to get the API running and we'll do that with `docker-compose`
- Run `docker-compose exec app php artisan key:generate`
    * This generates the application key for the laravel application 
- Run `docker-compose exec app php artisan config:cache` 
    * This clears the laravel config cache and rebuilds it
- Run `docker-compose exec app php artisan migrate` 
    * This creates the db with the tables countries, locations and floors
- Run `docker-compose exec app php artisan migrate:refresh --seed`
    * This seeds the database with some initial db records 

At this point you will be able to send API calls. Here are the calls:

```
GET '/api/locations'
GET '/api/locations/{id}'
POST /api/'locations'
    Sample Request:
    {
        "name": "Marvin Island",
        "address": "674 Carlo Trafficway Apt. 401",
        "opening_date": "2019-06-28",
        "country": "US"
    }
PUT '/api/locations/{id}'
        Sample Request:
        {
            "name": "Marvin Island",
            "address": "674 Carlo Trafficway Apt. 401",
            "opening_date": "2019-06-28",
            "country": "US"
        }
        
DELETE '/api/locations/{id}'
GET '/api/locations/{location}/floors'
GET '/api/locations/{location}/desks-amount'
GET '/api/locations/{location}/floors-amount'
POST '/api/locations/{location}/floors'
    Sample Request:
    {
        "number": 1533,
        "description": "Testing location.",
        "desks": 566
    }
GET '/api/countries'
GET '/country/{code}/locations'
GET '/country/{code}/earliest-location'
GET '/country/{code}/opening-next-month'
```


