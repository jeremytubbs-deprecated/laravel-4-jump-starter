## Laravel Project Starter

### What works:

- User Registration, Login, Logout, Password Reminders
- Facebook Login
- Admin Group
	- Manage Users
	- Manage Groups

### Currently in Progress:

- Ghost Style Markdown Posts w/ AngularJS
- Email Confirmation for User Registration
- User Profile Page

### Future Dev Plans:

- Convert to Post/Ghost to Package
- Contact Page
- Mailing List Signup
- Mircoblogging Post Types
- Portfolio / Multi-Image Post Type


> Better installataion documentation coming soon...

From the commandline of your project root:

```
	$ composer update
	$ npm install
	$ bower install
	$ gulp
```

Create a database named 'starter' if using Homestead create the .env.php file.

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


### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
