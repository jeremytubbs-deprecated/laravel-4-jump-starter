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

- Admin views for managing users and roles.
- User registration view
- Remember me integration
- Angular JS Demo


### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
