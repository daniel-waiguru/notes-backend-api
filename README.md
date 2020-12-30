<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Contributing

If you find a missing feature or a bug, please feel free to open an issue or pull request

BASE_URL = https://notieserver.herokuapp.com/

## Headers
"Content-Type": "application/json" <br/>
"Accept": "application/json"
"Authorization": "your-issued-token"

## Notie-Server EndPoints
#### User registration
https://notieserver.herokuapp.com/api/user/register

To register a user submit a POST request with name, email and passoword to the above endpoint

#### User login
https://notieserver.herokuapp.com/api/user/login

To login registered a user submit a POST request with email and passoword to the above endpoint

### User logout
request method POST

https://notieserver.herokuapp.com/api/user/logout


#### Create a Note
To create a note submit a POST request with note title, note_text(description) and Authorization Bearer Token to the follwing endpoint

https://notieserver.herokuapp.com/api/note

#### Edit Note
To create a note submit a PUT request with note title, note_text(description) and Authorization Bearer Token to the follwing endpoint

https://notieserver.herokuapp.com/api/note/{id}

#### Get LoggedIn User Notes list
To get user notes submit a GET request with Authoarization Bearer Token

https://notieserver.herokuapp.com/api/note

#### Get particular Note Details
To get Note details submit a GET request with note id as query parameter and Authorization Bearer Token

http://notieserver.herokuapp.com/api/note/{id}

#### Delete a Note
request methhod DELETE

https://notieserver.herokuapp.com/api/note/{id}
