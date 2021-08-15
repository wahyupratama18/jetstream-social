<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
    <a href="https://github.com/laravel/socialite" target="_blank">
        <img src="https://user-images.githubusercontent.com/42894387/129441816-65db9f50-39af-417c-b9fc-ae6dcd227db5.png" width="400">
    </a>
</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Repository

This is Laravel 8 repository using Laravel Jetstream Livewire and Socialite Login Authentication. Currently, I've already tested login with Google and Github. But, the routes are already prepared for other's authentication with Facebook, Twitter, and LinkedIn.

## How To Use
There's a new model that being inserted, named SocialLogin. In my opinion, a user could have many social login platforms they can used. Drivers that currently available (starting from zero, in the column called as driver_id) are ['Facebook', 'Twitter', 'LinkedIn', 'Google', 'GitHub']
When someone tries to login with the social accounts, after redirection to all of those drivers, they landed to "callback" routes.
If user already authenticated before, a function called socialSave will be called. That function using SocialLogin's model firstOrCreate, means that if there aren't any record there, it will be saved as a new record.
If user not logged in, it will check wheter this social accounts has been logged in before. If it isn't, a createUser and socialSave function will be called. After that, it attempts to login just like normal authentication.
After all of that, it redirects to dashboard based on fortify's home route.

## Get your Credentials
All of the credentials is saved on .env (Called '(GOOGLE|GITHUB|FACEBOOK|TWITTER|LINKEDIN)' CLIENT_ID and CLIENT_SECRET), see config/services.php

### #1 How to get it from Google
1. Open Google Cloud Console (https://console.cloud.google.com/apis/credentials?pli)
2. Click (+ Create Credentials), then click OAuth Client ID
   
   ![image](https://user-images.githubusercontent.com/42894387/129442512-ba29c75f-e981-462a-9ad7-36718c1ead0e.png)

3. Select Web Application from input Application Type, and give the name of your application

    ![image](https://user-images.githubusercontent.com/42894387/129442556-e3cc04b2-6b44-476c-a3e5-e882cca0cbc7.png)

4. Add origin url's and redirect (Remember that they could accept localhost, and live url. If you're using custom url locally, make sure that the top level domain are public (like .com, .id, etc) )

    ![image](https://user-images.githubusercontent.com/42894387/129442613-b97fa762-d1e1-49fc-99ef-7468318a279b.png)

5. Copy your secret ID and client ID to the .env

### #2 How to get it from GitHub
1. Open GitHub Settings Developer (https://github.com/settings/developers)
2. Click New OAuth App
    
    ![image](https://user-images.githubusercontent.com/42894387/129442727-480e2d02-862f-407c-9545-8c2263242853.png)
    
3. Fill all of the forms needed

    ![image](https://user-images.githubusercontent.com/42894387/129442755-f6a0d235-4cca-464f-9a29-8aeaf0cbcea9.png)

4. Copy your secret ID and client ID to the .env

## Usage and Collaboration
Feel free to download this repository, no attribution needed.
If you think there's a bug or other improvement, open up the issue. Or, you could fork this and create a pull request.

## Sources
I couldn't done this without several documentations online, like:
1. https://laravel.com/docs/8.x/socialite
2. https://codyrigg.medium.com/how-to-add-a-google-login-using-socialite-on-laravel-8-with-jetstream-6153581e7dc9
3. https://www.itsolutionstuff.com/post/laravel-8-socialite-login-with-google-account-exampleexample.html
4. https://www.positronx.io/laravel-socialite-oauth-login-with-twitter-example-tutorial/
5. https://www.remotestack.io/login-with-facebook-in-laravel-with-socialite-and-jetstream/
6. https://www.nicesnippets.com/blog/laravel-8-socialite-login-with-linkedin-tutorial
7. https://www.positronx.io/laravel-socialite-login-with-github-example-tutorial/

Don't forget to look at them as well. They have a great explanation to you, in order to understand this repository.
