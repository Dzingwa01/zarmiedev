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
    return view('welcome');
});
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::auth();
Route::post('save_category','MenusController@saveCategory')->name('save_category');
Route::get('admin','AdminController@index')->name('admin_home');
Route::get('menu_display','MenuManagementController@getIndex');


//orders
Route::get('contact_display','OrderController@showContactUsPage');
Route::get('order_display','OrderController@getOrdersIndex');
Route::get('process_order','OrderController@goToProcessOrder');
Route::get('bread_selection','OrderController@showBread');
Route::get('/address_selection','OrderController@showAddressSelection');
Route::get('select_ingredients_toppings/{id}','OrderController@showIngredientsToppings');

Route::get('ingredient_type','IngredientTypeController@getIndex')->name('ingredient_type_home');
Route::get('menus','MenusController@getIndex')->name('manage_menus');
Route::get('menu_items','MenusController@showMenus')->name('menu_items');

Route::post('save_item','MenusController@store')->name('add_menu_item');
Route::get('ingredients','IngredientController@getIndex')->name('manage_ingredients');
Route::get('uploads','UploadsController@getIndex')->name('manage_uploads');
Route::get('ingredient_items','IngredientController@showIngredients')->name('ingredient_items');
Route::get('ingredient_item_types','IngredientTypeController@showIngredientTypes')->name('ingredient_item_types');
Route::post('save_ingredient','IngredientController@store')->name('add_ingredient');
Route::post('save_ingredient_type','IngredientTypeController@store')->name('add_ingredient_type');


Route::get('users/{id}','UserController@editUser');
Route::post('user/update/{id}','UserController@update');
Route::get('users/delete/{id}','UserController@destroy');
Route::get('users/show/{id}','UserController@show');

Route::get('menu/{id}','MenusController@editMenu');
Route::post('menu/update/{id}','MenusController@update');
Route::get('menu/delete/{id}','MenusController@destroy');
Route::get('menu/show/{id}','MenusController@show');

Route::get('ingredient/{id}','IngredientController@editIngredient');
Route::get('ingredient_type/{id}','IngredientTypeController@editIngredientType');
Route::post('ingredient/update/{id}','IngredientController@update');
Route::post('ingredient_type/update/{id}','IngredientTypeController@update');
Route::get('ingredient/delete/{id}','IngredientController@destroy');
Route::get('ingredient/show/{id}','IngredientController@show');
Route::get('ingredient_type/show/{id}','IngredientTypeController@show');
Route::get('ingredient_type/delete/{id}','IngredientController@destroy');
Route::group(['middleware' => ['web','isVerified']], function() {
    Route::get('/home', 'HomeController@index');
    // Route::get('users', ['as' => 'UserController', 'uses' => 'UserController@getIndex']);
    //
    // Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
    // Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
    // Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
    // Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
    // Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
    // Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
    // Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);
});
Route::get('order_selection','OrderController@getIndex')->name('order_selection');
Route::get('show','UserController@showUsers')->name('users_info');
Route::get('users','UserController@getIndex')->name('users');

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    // Route::get('/', 'AdminController@welcome');
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
