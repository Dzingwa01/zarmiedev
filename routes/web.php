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

Route::get('/client_order_display','ClientOrderController@getOrdersIndex');
Route::get('/client_menu_display','ClientOrderController@getOrdersIndex');

Route::resource('drinks','DrinksController');
Route::get('drinks_list','DrinksController@showDrinks')->name('drinks_list');
Route::get('show_drink_type','DrinksController@showCategories')->name('show_drink_type');
Route::get('drink_categories_list','DrinksController@showDrinksCategories')->name('drink_categories_list');
Route::get('/show_drink_type/DrinksController@showCategories');
Route::post('/drinks/update/{id}','DrinksController@update');
Route::get('/drinks/delete/{id}','DrinksController@destroy');

Route::get('/drink_categories/{id}','DrinksController@displayDrinksCategories');
Route::get('/drink_categories_edit/{id}','DrinksController@editDrinksCategories');
Route::get('/drink_categories/delete/{id}','DrinksController@deleteDrinksCategories');
Route::post('/store_drink_category','DrinksController@storeDrinkCategory')->name('store_drink_category');
Route::post('/drink_categories/update/{id}','DrinksController@updateDrinkCategory');

Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');
Route::auth();
Route::post('save_category','MenusController@saveCategory')->name('save_category');
Route::post('save_topping','MenusController@saveTopping')->name('save_topping');
Route::post('update_category/{id}','MenusController@updateCategory');
Route::get('admin','AdminController@index')->name('admin_home');
Route::get('menu_display','MenuManagementController@getIndex');

Route::get("get_ingredients","IngredientController@getIngredients");

//orders
Route::get('contact_display','OrderController@showContactUsPage');
Route::get('order_display','OrderController@getOrdersIndex');
Route::get('process_order/{id}','OrderController@goToProcessOrder');
Route::get('client_process_order/{id}','OrderController@goToProcessOrderClient');
Route::get('/order_completion','OrderController@gotToCompletion');
Route::get('get_user_by_phone/{phone_number}','OrderController@getUserByPhone');
Route::get('bread_selection/{id}','OrderController@showBread');
Route::get('/client_bread_selection/{id}','OrderController@showBreadClient');
Route::get('/address_selection/{id}','OrderController@showAddressSelection');
Route::get('/client_address_selection','OrderController@showAddressSelectionClient');
Route::get('select_ingredients_toppings/{id}','OrderController@showIngredientsToppings');
Route::get('select_ingredients_toppings_client/{id}','OrderController@showIngredientsToppingsClient');
Route::get('select_ingredients_toppings_salads/{id}','OrderController@showIngredientsToppingsSalads');
Route::get('select_ingredients_toppings_salads_client/{id}','OrderController@showIngredientsToppingsSaladsClient');

Route::get('ingredient_type','IngredientTypeController@getIndex')->name('ingredient_type_home');
Route::get('menus','MenusController@getIndex')->name('manage_menus');
Route::get('menu_categories','MenusController@getCategoriesIndex')->name('manage_category_menus');
Route::get('menu_items','MenusController@showMenus')->name('menu_items');
Route::get('menu_item_category','MenusController@showMenuCategories')->name('menu_item_category');
Route::get('toppings_list','MenusController@showToppingsList')->name('toppings_list');

Route::get('manage_toppings','MenusController@getToppingsIndex')->name('manage_toppings');

Route::post('save_item','MenusController@store')->name('add_menu_item');
Route::post('place_order_client','OrderCompletionLoginController@placeOrderClient')->name('place_order_client');

Route::post('place_order','OrderCompletionLoginController@placeOrder')->name('place_order');
Route::post('place_order_new_registration','OrderCompletionRegisterController@placeOrderRegister')->name('place_order_new_registration');

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
Route::get('menu_category/delete/{id}','MenusController@destroyMenuCategory');
Route::get('menu_category/show/{id}','MenusController@showMenuCategory');
Route::get('menu_category/{id}','MenusController@editMenuCategory');

Route::get('topping/delete/{id}','MenusController@destroyTopping');
Route::get('topping/show/{id}','MenusController@showTopping');
Route::get('topping/{id}','MenusController@editTopping');
Route::post('topping/update/{id}','MenusController@updateTopping');


Route::get('ingredient/{id}','IngredientController@editIngredient');
Route::get('ingredient_type/{id}','IngredientTypeController@editIngredientType');
Route::post('ingredient/update/{id}','IngredientController@update');
Route::post('ingredient_type/update/{id}','IngredientTypeController@update');
Route::get('ingredient/delete/{id}','IngredientController@destroy');
Route::get('ingredient/show/{id}','IngredientController@show');
Route::get('ingredient_type/show/{id}','IngredientTypeController@show');
Route::get('ingredient_type/delete/{id}','IngredientTypeController@destroy');

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
Route::get('/account_creation_success','Auth\RegisterController@accountSuccess');
Route::get('/account_not_verified','Auth\RegisterController@accountNotRegistered');
Route::get('/verify_email/{token}', 'Auth\RegisterController@verify');
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
