<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// get, post, put, delete
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/books', 'BookController@getIndex');
// Route::get('/books/show/{title}', 'BookController@getShow');
// Route::get('/books/create', 'BookController@getCreate');
// Route::post('/books/create', 'BookController@postCreate');

Route::controller('/books','BookController');

Route::get('/practice', function() {
	$random = new Rych\Random\Random();
   return $random->getRandomString(8);
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');