<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AuthorsController@index');
Route::resource('authors', 'AuthorsController');
Route::resource('books', 'BooksController');

//routing ajax untuk menu admin : author
Route::get('author', array(
    'as' => 'admin-author', 'uses' => 'AuthorsController@index'));
//routing ajax untuk menu admin : book
Route::get('book', array(
    'as' => 'admin-book', 'uses' => 'BooksController@index'));
//routing ajax untuk menu user : book
Route::get('book-guest', array(
    'as' => 'guest-book', 'uses' => 'GuestController@index'));