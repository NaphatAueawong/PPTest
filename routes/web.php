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

Route::get('/', 'LoanController@showCustomer');
Route::get('/addLoan', 'LoanController@addLoan');
Route::post('/addLoan', 'LoanController@add');
Route::get('/detailLoan/{id}', 'LoanController@showDetailLoan');
Route::get('/deleteLoan/{id}', 'LoanController@deleteLoan');
Route::get('/editLoan/{id}', 'LoanController@editLoan');
Route::post('/editLoan/{id}', 'LoanController@edit');
Route::post('/advanceSearch', 'LoanController@advanceSearch');


