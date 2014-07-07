## Laravel Project Starter

> Better installataion documentation coming soon...

From the commandline of your project root:

```
	$ composer update
	$ npm install
	$ bower install
	$ gulp
```

Create a database named 'starter' if using Homestead or edit the .env.php file.

Check your enviroment:

```
	$ php artisan env
```

Install migrations and seed

```
	$ php artisan migrate
	$ php artisan db:seed
```

Now you should be able to login!
Email: 'admin@admin.com'
Password: 'admin'

You will be redirected to the admin section.

Non Admin Login:
Email: 'user@user.com'
Password: 'user'

### Todo

- Admin views for managing users and roles
- Email Confirmation for User Registration
- Connect with Facebook API
- Remember me integration
- User Profile Page
- Angular JS / Laravel Integration Demo


### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
