## Laravel 4.2 Jump Starter
This project uses gulp for sass and angularjs.

Check out my truely barebones project skeleton: [Laravel 4.3 Jump Starter](https://github.com/jeremytubbs/laravel-4.3-jump-starter).

### What Works:

- User Registration, Login, Logout, Password Reminders
- Facebook Login
- Admin Group
	- Manage Users
	- Manage Groups
- Contact Form
- Posts
	- Ghost Style Editor w/Angular
	- Publish or Save Draft
	- Edit / Update Post
	- List and Display
	- Post Slugs

### Currently in Progress / Todos:

- Posts Todo
	- Delete? or Soft Delete?
	- Admin "all posts" index style
	- Meta Title, Meta Description
	- Tags / Catagories
	- Featured Posts
- User Profile Page
	- User Slugs
	- Profile Picture
	- Public Boolean Options
- Dashboard
	- Styles

### Future Dev Plans:

- xml sitemap
- Convert to Post/Ghost to Package
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
