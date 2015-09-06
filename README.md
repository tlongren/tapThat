# Tap That

##### Find what's on tap at local pubs. 9/3/2015

#### By Austin Blanchard, Alexandra Brown, Chris Calascione, Deron Johnson, Phillip Shannon

## Description

This application allows a user search for a particular beer at a pub and see a list of all beers from a pub or a brewery. Users can also create profiles where they can log and rate the beers that they drink.

http://tapthat.therealphilshannon.xyz/

## Setup
* Clone this repository

* Run the following command in the project directory
```console
$ composer install
```

* Import sql.zip files to PHPMyAdmin or follow along with the command line steps below:

```console
>CREATE DATABASE tap_that;
>USE tap_that;
>CREATE TABLE beers (id serial PRIMARY KEY, name VARCHAR (255), type VARCHAR (255), abv DECIMAL (3,1), region VARCHAR (255), ibu INT, brewery_id INT);
>CREATE TABLE breweries (id serial PRIMARY KEY, name VARCHAR (255), location VARCHAR (255), link VARCHAR (255));
>CREATE TABLE brews (id serial PRIMARY KEY, drunk_id INT, brand_id INT, pub_id INT, beer_rating DECIMAL (3,1), brew_date DATE));
>CREATE TABLE drunks (id serial PRIMARY KEY, name VARCHAR (255), date_of_birth DATE, email VARCHAR (255), location VARCHAR (255), password VARCHAR (255));
>CREATE TABLE on_tap (id serial PRIMARY KEY, pub_id INT, beer_id INT);
>CREATE TABLE pubs (id serial PRIMARY KEY, name VARCHAR (255), location VARCHAR (255), link VARCHAR (255));
```
(to run tests make a copy of tap_that database as "tap_that_test")

* Start Apache server with the following command:
```console
$ apachectl start
```

* Start a PHP server in the web directory
```console
$ php -S localhost:8000
```

* Navigate your browser to localhost:8000

* Enjoy!

## Technologies Used

PHP, PHPUnit, MySQL, Silex, Twig, HTML, CSS, Bootstrap, JavaScript, jQuery

### Legal

Copyright (c) 2015 Austin Blanchard, Alexandra Brown, Chris Calascione, Deron Johnson, Phillip Shannon

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
