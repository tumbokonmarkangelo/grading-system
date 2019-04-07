## Project Setup Guide

- [Install Composer](https://getcomposer.org/Composer-Setup.exe).
- [Install Node](https://nodejs.org/en/download).

## Project Start Guide
### do this at the start.
```sh
composer update
npm install
npm run dev
```
- Create database named 'grading_system' as what set on .env then do the step below.
```sh
php artisan migrate --seed 
```

## Project Development Guide
### run laravel mixer to compile project assets.
```sh
npm run watch
```

## Project Test Guide
```sh
php arisan serve
```
- [See running project on](http://127.0.0.1:8000).