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
"Accept": "application/json" <br/>
"Authorization": "your-issued-token"

## Notie-Server EndPoints
### Authentication
#### User registration
```json
POST https://notieserver.herokuapp.com/api/user/register
{
    "name": "Your Name",
    "email": "example@email.com",
    "password": "your_preferred_password"
}
```

#### User login
```json 
POST https://notieserver.herokuapp.com/api/user/login
{
    "email": "your_registered_email@email.com",
    "password": "your_password"
}
```


### User logout
```json
POST https://notieserver.herokuapp.com/api/user/logout
Authorization: Bearer YOUR_ISSUED_TOKEN
```

## Notes 
#### Create a Note
To create a note submit a POST request with note title, note_text(description) and Authorization Bearer Token to the follwing endpoint
```json
POST https://notieserver.herokuapp.com/api/note
{
    "note_title": "Your note title",
    "note_text": "Your note description"
}
```

#### Edit Note
```json
PUT https://notieserver.herokuapp.com/api/note/{id}
Authorization: Bearer YOUR_ISSUED_TOKEN
{
    "note_title": "Updated note title",
    "note_text": "Updated note description"
}
```
#### Get LoggedIn User Notes list
```json
GET https://notieserver.herokuapp.com/api/note
Authorization: Bearer YOUR_ISSUED_TOKEN
```

#### Get particular Note Details
```json
GET http://notieserver.herokuapp.com/api/note/{id}
Authorization: Bearer YOUR_ISSUED_TOKEN
```
#### Delete a Note
```json
DELETE https://notieserver.herokuapp.com/api/note/{id}
Authorization: Bearer YOUR_ISSUED_TOKEN
