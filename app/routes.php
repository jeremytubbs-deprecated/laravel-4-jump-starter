<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


//User Sesions
Route::get('login', array('as' => 'login', 'uses' => 'SessionsController@create'));
Route::get('logout', array('as' => 'logout', 'uses' => 'SessionsController@destroy'));
Route::post('login', array('as' => 'sessions.store', 'uses' => 'SessionsController@store'));

// Password Resets
Route::get('password/reset/{token}', array('as' => 'reset', 'uses' => 'RemindersController@getReset'));
Route::post('password/reset/{token}', 'RemindersController@postReset');
Route::get('remind', array('as' => 'remind', 'uses' => 'RemindersController@getRemind'));
Route::post('remind', 'RemindersController@postRemind');

//admin areas
Route::group(array('before' => 'role:admin'), function() {
    Route::resource('admin', 'AdminController');
});


// Error pages uncomment in production
// App::error(function($exception, $code)
// {
//     switch ($code)
//     {
//         case 403:
//             return Response::view('errors.403', array(), 403);

//         case 404:
//             return Response::view('errors.404', array(), 404);

//         case 500:
//             return Response::view('errors.500', array(), 500);

//         default:
//             return Response::view('errors.default', array(), $code);
//     }
// });