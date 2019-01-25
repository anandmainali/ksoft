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

Route::get('/', function () {
    return view('dashboard.auth.login');
})->name('/')->middleware('guest');

Route::get('/home', 'HomeController@index');

Auth::routes();


    Route::group(['middleware' => 'auth','prefix' => config('dashboard.prefix')], function(){    
        Route::get('', 'HomeController@index')->name('admin');
        //Logout
        Route::get('logout',function(){
            Auth::logout();
            return redirect()->route('login');
        })->name('admin.logout');        
        // Route assigned name "admin.users"
        Route::group(['as' => 'admin.'], function(){
            Route::get('profile', function () {
                return view('dashboard.pages.profile');
            })->name('profile');    
            
            //User Profile Update
            Route::patch('updateUser/{id}', 'ProfileUpdateController@updateUser')->name('updateUser');
            Route::post('updatePassword/{id}', 'ProfileUpdateController@updatePassword')->name('updatePassword');

            //User Status Update
            Route::get('users/{id}/status', 'UserController@updateStatus')->name('users.updateStatus');

            //Users Resource
            Route::resource('users', 'UserController');
            //Private Emails Resource
            Route::resource('companyEmail', 'CompanyPrivateEmailController');

            //Category Resource
            Route::resource('category', 'CategoryController');
            //Menu Item Resource
            Route::resource('foodItem', 'FoodItemController');

            //Orders Resource
            Route::resource('orders', 'OrderController');
            
            //Menus Related Controller
            Route::get('getItems','TodayMenuController@getActiveItems')->middleware('isKitchenStaff')->name('getItems');
            Route::post('setTodayMenu','TodayMenuController@setTodayMenu')->middleware('isKitchenStaff')->name('setTodayMenu');
            Route::get('viewTodayMenu','TodayMenuController@viewTodayMenu')->middleware('isEmployee')->name('viewTodayMenu');

            //Menus History
            Route::get('menusHistory','TodayMenuController@menusHistory')->middleware('isAdmin')->name('menusHistory');

            //Employee Order History
            Route::get('ordersHistory','HomeController@ordersHistory')->middleware('isAdmin')->name('ordersHistory');
            Route::get('orderedItems/{id}','HomeController@ordersHistoryItems')->middleware('isAdmin')->name('ordersHistoryItems');
            Route::get('allOrders','HomeController@allOrders')->middleware('isEmployee')->name('allOrders');

            //Cart System
            Route::get('addToCart/{id}','CartController@getAddToCart')->name('addToCart');
            Route::get('getCartItems','CartController@getCartItems')->name('getCartItems');
            Route::get('getReduceByOne/{id}','CartController@getReduceByOne')->name('reduceByOne');
            Route::get('remove/{id}','CartController@getRemoveItem')->name('remove');

            //Notification System
            Route::get('notification','NotificationController@markAsRead')->name('markAsRead');

            
            
            
            
        });
        
    });


