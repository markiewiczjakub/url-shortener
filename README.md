# URL Shortener

## Introduction

Tired of long illegible URLs? Here is what you need. This simple tool written in JavaScript and PHP will let you create an app that changes ugly URLs in shorter and cleaner one. All you need is web server that handles PHP and MySQL database.

## How it works

Just type a desired name (or don't, the app will generate some hash for you) and submit the form. As an output you will get shortened URL!

## Installation

Create a .htaccess file in root directory where you are going to upload the app and paset code below
```
RewriteCond %{THE_REQUEST} /index\.php\?p=([^\s&]+) [NC]
RewriteRule ^ %1? [R=302,L]

RewriteCond %{REQUEST_FILENAME} !-d 
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.+?)/?$ index.php?p=$1 [L,QSA]
```
Then upload all the other files from this repo to your server and change the login data in api.php file. You are ready to go!

## Live example

You can try it and feel free to use it [here](https://porzy.ga).
