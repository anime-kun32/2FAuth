![https://travis-ci.com/github/Bubka/2FAuth](https://img.shields.io/travis/com/bubka/2fauth?style=flat-square)
![https://codecov.io/gh/Bubka/2FAuth](https://img.shields.io/codecov/c/github/Bubka/2FAuth?style=flat-square)
![https://github.com/Bubka/2FAuth/blob/master/LICENSE](https://img.shields.io/github/license/Bubka/2FAuth.svg?style=flat-square)


# 2FAuth
A web app to manage your Two-Factor Authentication (2FA) accounts and generate their security codes

![screens](https://user-images.githubusercontent.com/858858/74479269-267a1600-4eaf-11ea-9281-415e5a54bd9f.png)

#### [2FAuth Demo](https://demo.2fauth.app/)

Credentials (login - password) : *demo@2fauth.app* - *demo*

## Purpose
2FAuth is a web based self-hosted alternative to One Time Passcode (OTP) generators like Google Authenticator, designed for both mobile and desktop.

It aims to ease you perform your 2FA authentication steps whatever the device you handle, with a clean and suitable interface.

I created it because :
* Most of the UIs for this kind of apps show tokens for all accounts in the same time with stressful countdowns (in my opinion)
* I wanted my 2FA accounts to be stored in a standalone database I can easily backup and restore (did you already encountered a smartphone loss with all your 2FA accounts in Google Auth? I did...)
* I hate taking out my smartphone to get an OTP when I use a desktop computer
* I love coding and I love self-hosted solutions

## Main features
* Manage 2FA accounts with QR code flashing/scanning and decoding
* Generate TOTP and HOTP security codes
* User authentication to protect 2FA data stored in 2FAuth

2FAuth is currently localized in English and in French.

#### Single user app
2FA are sensitives data so you have to create an account and authenticate yourself to use the app. It is not possible to create more than one user account, the app is thought for personal use.

#### RFC compliance
2FAuth generates OTP according to RFC 4226 (HOTP Algorithm) and RFC 6238 (TOTP Algorithm) thanks to [Spomky-Labs/OTPHP](https://github.com/Spomky-Labs/otphp) php library.

## Requirements
[![Requires PHP7](https://img.shields.io/badge/php-7.2.*-red.svg?style=flat-square)](https://secure.php.net/downloads.php) 
* See [Laravel server requirements](https://laravel.com/docs/5.8/installation#server-requirements)
* Any database [supported by Laravel](https://laravel.com/docs/5.8/database)

## Installation (using command line)

#### Clone the repo
```
git clone https://github.com/bubka/2fauth.git
```

#### Install all php dependencies
```
php composer.phar install
```
Don't have `composer`? [you can get it here](https://getcomposer.org/download/)

#### Set up your database

Create a database with one of the supported tools (see Requirements).
For SQLite, place the database `.sqlite` file in the `database/` folder of your 2FAuth installation.

#### Set your variables

In your installation directory make a copy of the `.env.example` file and rename the copy `.env`.
Edit the `.env` file and adapt the settings to your running environment (see instructions in the file)

#### Prepare some stuff
```
php artisan migrate:refresh
php artisan passport:install
php artisan storage:link
php artisan config:cache
```
You are ready to go.

#### For development only
Checkout the 'dev' branch then install and build js dependencies
```
npm install
npm run dev
```

## Upgrading
First, **backup your database**.

Then, using command line :
```
git pull
php composer.phar install
php artisan migrate
php artisan config:clear
```

# Contributing
to complete

# License
[AGPL-3.0](https://www.gnu.org/licenses/agpl-3.0.html)
