<?php

use Illuminate\Support\Facades\Route;

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

//Default Route
Route::get('/', function() {

    if(Auth::check() == true){
        request()->session()->regenerate();

        return redirect('backusers');
    }
    return view('login');    
});



//Route to login with credentials
Route::post('/', 'App\Http\Controllers\LoginController@loginFunction')->name('userLogin');



//Register Route view
Route::get('register', function() {
    return view('register');    
});

//Register Route for new user
Route::post('register', 'App\Http\Controllers\RegisterController@store')->name('regUser');




//Forgot Password Route view
Route::get('forgot-password', function() {
    if(session()->has('userEmail')){
        return redirect('backusers');
    }
    return view('forgot_password');    
});

//Reset Password Mail Route
Route::post('resetpwdrqst', 'App\Http\Controllers\ForgotPasswordController@sendResetMail')->name('resetPwdRqst');

//Route to get the Reset Password View from the Mail Link
Route::get('reset-password/{id}', 'App\Http\Controllers\ResetPasswordController@pwdResetById')->name('reset-password');

//Route to perform the password resetting action
Route::post('password-resetted', 'App\Http\Controllers\ResetPasswordController@update')->name('pwdResetting');




//Default Logout Route
Route::get('/logout', function() {
    if(session()->has('userEmail')){
        session()->forget(['userEmail', 'userName', 'userType']);
        Auth::logout();
    }
    return redirect('/');    
});



//Route to get new_order view
Route::get('new-order',  'App\Http\Controllers\OrderController@index');

//Route to post the new order list
Route::post('new-order', 'App\Http\Controllers\OrderController@store')->name('createOrder');



//Route to get calendar_management view
Route::get('dates',  'App\Http\Controllers\DatesController@index');

//Route to post the new shipping season info
Route::post('dates', 'App\Http\Controllers\DatesController@store')->name('createSeason');

//Route to post the shipping season info update
Route::post('dates/update', 'App\Http\Controllers\DatesController@update')->name('updateSeason');

//Route to post the shipping season info delete
Route::post('dates/delete', 'App\Http\Controllers\DatesController@delete')->name('deleteSeason');

//Route to post the shipping season day info update
Route::post('dates/quota', 'App\Http\Controllers\DatesController@quotaStore')->name('createDayQuota');

//Route to update the shipping season day info update
Route::post('dates/quota-update', 'App\Http\Controllers\DatesController@quotaUpdate')->name('updateDayQuota');

//Route to post the shipping season day info delete
Route::post('dates/quota-delete', 'App\Http\Controllers\DatesController@quotaDelete')->name('deleteQuota');




//Route to get the user_management view
Route::get('backusers', 'App\Http\Controllers\UserController@index')->name('backusers');

//Route to post the new user info
Route::post('backusers', 'App\Http\Controllers\UserController@store')->name('createUser');

//Route to post the update user info
Route::post('backusers/update', 'App\Http\Controllers\UserController@update')->name('updateUser');

//Route to post the delete user info
Route::post('backusers/delete', 'App\Http\Controllers\UserController@delete')->name('deleteUser');