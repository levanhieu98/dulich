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

Route::get('/', function () {
    return redirect('./login');
});
Route::get('/test', 'BlogController@test');

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('/load', 'AdminController@show');

    //Danh sách Tag
    Route::group(['middleware' => ['permission:tag']], function () {
        Route::get('/danh-sach-tag', 'TagController@index');
        Route::post('/edit-tag', 'TagController@Edit_Tag');
        Route::post('/delete-tag', 'TagController@Delete_Tag');
        Route::get('/deletes', 'TagController@Delete');
        Route::post('/add-tag', 'TagController@add_Tag');
        Route::get('/slug', 'TagController@slug');
    });


    //  Start - Danh sách Categories
    Route::group(['middleware' => ['permission:category']], function () {
        Route::get('/danh-sach-the-loai', 'CategoryController@index')->name('category.index');
        Route::post('/add-category', 'CategoryController@Add_Category')->name('categoty.store');
        Route::post('/update-category', 'CategoryController@Update_Category')->name('categoty.update');
        Route::get('/delete-category/{id}', 'CategoryController@deleteCategory')->name('categoty.destroy');
        Route::get('/delete-category', 'CategoryController@delete');
        Route::get('/slug', 'CategoryController@slug');
        //  End - Danh sách Categories
    });
    //  Start - Danh sách Ngôn ngữ
    Route::group(['middleware' => ['permission:language']], function () {
        Route::get('/danh-sach-ngon-ngu', 'LanguageController@index');
        Route::post('/add-language', 'LanguageController@Add_Language');
        Route::post('/edit-language', 'LanguageController@Edit_Language');
        Route::post('/delete-language', 'LanguageController@Delete_Language');
        //  End - Danh sách Ngôn ngữ
    });
    Route::group(['prefix' => 'user', 'middleware' => ['permission:user']], function () {
        Route::get('/roles', 'RoleController@index')->name('role.index');
        Route::post('/roles', 'RoleController@storeRole')->name('role.store');
        Route::get('/destroy-role/{id}', 'RoleController@destroyRole')->name('role.destroy');
        Route::get('/delete', 'RoleController@delete');
        Route::post('/update-role/{id}', 'RoleController@updateRole')->name('role.update');
        Route::get('/permissions', 'PermissionController@index')->name('permission.index');
        Route::post('/permissions', 'PermissionController@storePermission')->name('permission.store');
        Route::get('/destroy-permission/{id}', 'PermissionController@destroyPermission')->name('permission.destroy');
        Route::post('/update-permission/{id}', 'PermissionController@updatePermission')->name('permission.update');
        Route::get('/form-user', 'UserController@Form_add_user')->name('form.user');
        Route::get('/users', 'UserController@show_user')->name('user.index');
        Route::post('/get-form-user', 'UserController@storeUser')->name('user.store');
        Route::get('/destroy-users/{id}', 'UserController@destroyUser')->name('user.destroy');
        Route::get('/destroy-users', 'UserController@destroy');
        Route::post('/update-users/{id}', 'UserController@updateUser')->name('user.update');
    });

    Route::group(['middleware' => ['permission:blog']], function () {
        Route::resource('blogs', 'BlogController');
        Route::get('/edit-blog/{id}', 'BlogController@ViewEditBlog')->name('blog.from');
        Route::post('/add-edit-blog', 'BlogController@EditBlog')->name('blog.update');
        Route::get('/delete-blog/{id}', 'BlogController@DeleteBlog')->name('blog.destroy');
        Route::get('/delete-blog', 'BlogController@Delete');
        Route::get('/danh-sach-bai-viet-chua-duyet', "BlogController@PageBlogReview")->name('review');
        Route::get('/xoa-danh-sach-bai-viet-chua-duyet', "BlogController@DPageBlogReview");
        Route::get('/detail-blog-chua-duyet/{id_blog}', "BlogController@DetailBlogReview");
        Route::get('/blog-review/{id_blog}', "BlogController@BlogReview")->name('blog.review')->middleware('permission:user_review');
        Route::get('/get-data-category-by-language', "BlogController@get_Data_Category_Cha_By_Language");
        Route::post('/add-category-ajax', "BlogController@add_category_ajax");
        Route::get('/ajax-get-data-category', "BlogController@ajax_Get_Data_Category_By_Language");
        Route::get('/ajax-get-data-tag-by-language', "BlogController@ajax_Get_Data_Tag_By_Language");
    });

    // da ngon ngu
    Route::get('lang/{lang}', 'LangController@changeLang')->name('lang');
    //du lich
    Route::group(['middleware' => ['permission:tourist']], function () {
        Route::get('tourist', 'TouristController@tourist')->name('tourist.index');
        Route::get('delete-tourist', 'TouristController@delete_tourist');
        Route::get('delete/{id}', 'TouristController@deletes')->name('deletekh');
        Route::get('form-tour', 'TouristController@form_tour')->name('tourist.form');
        Route::get('list-tour', 'TouristController@list_tour')->name('tourist.list');
        Route::post('add-tour', 'TouristController@add_tour')->name('tourist.store');
        Route::get('edit-tour/{id}', 'TouristController@edit_tour')->name('tourist.update');
        Route::post('get-edit-tour/{id}', 'TouristController@get_edit_tour')->name('tourist.getupdate');
        Route::get('delete-tour/{id}', 'TouristController@delete_tour')->name('tourist.destroy');
        Route::get('delete-tour', 'TouristController@delete');
    });

    Route::get('contact', 'ContactController@contact')->name('contact.index');
    Route::get('contact/{id}', 'ContactController@delete')->name('contact.destroy');
    Route::get('contacts', 'ContactController@destroy');

    Route::get('restaurant', 'RestaurantController@restaurant')->name('restaurant.index');
    Route::get('form-restaurant', 'RestaurantController@form_restaurant')->name('restaurant.form');
    Route::post('add-restaurant', 'RestaurantController@add_restaurant')->name('restaurant.store');
    Route::get('delete-restaurant/{id}', 'RestaurantController@delete_restaurant')->name('restaurant.destroy');
    Route::get('update-restaurant/{id}', 'RestaurantController@update_restaurant')->name('restaurant.show');
    Route::post('get-update-restaurant/{id}', 'RestaurantController@get_update_restaurant')->name('restaurant.update');
    Route::get('delete-restaurant', 'RestaurantController@delete');
    Route::get('checkrestaurant', 'RestaurantController@checkrestaurant');


    Route::get('food', 'FoodController@food')->name('food.index');
    Route::get('form-food', 'FoodController@form_food')->name('food.form');
    Route::post('add-food', 'FoodController@add_food')->name('food.store');
    Route::get('update-food/{id}', 'FoodController@update_food')->name('food.show');
    Route::post('get-update-food/{id}', 'FoodController@get_update_food')->name('food.update');
    Route::get('delete-food/{id}', 'FoodController@delete_food')->name('food.destroy');
    Route::get('delete-food', 'FoodController@delete');
    Route::get('checkfood', 'FoodController@checkfood');

    Route::get('hotel', 'HotelController@hotel')->name('hotel.index');
    Route::get('form-hotel', 'HotelController@form_hotel')->name('hotel.form');
    Route::post('add-hotel', 'HotelController@add_hotel')->name('hotel.store');
    Route::get('update-hotel/{id}', 'HotelController@update_hotel')->name('hotel.show');
    Route::post('get-update-hotel/{id}', 'HotelController@get_update_hotel')->name('hotel.update');
    Route::get('delete-hotel/{id}', 'HotelController@delete_hotel')->name('hotel.destroy');
    Route::get('delete', 'HotelController@delete');
    Route::get('checkhotel', 'HotelController@checkhotel');


    Route::get('place', 'PlaceController@place')->name('place.index');
    Route::get('form-place', 'PlaceController@form_place')->name('place.form');
    Route::post('add-place', 'PlaceController@add_place')->name('place.store');
    Route::get('update-place/{id}', 'PlaceController@update_place')->name('place.show');
    Route::post('get-update-place/{id}', 'PlaceController@get_update_place')->name('place.update');
    Route::get('delete-place/{id}', 'PlaceController@delete_place')->name('place.destroy');
    Route::get('delete-place', 'PlaceController@delete');
    Route::get('checkplace', 'PlaceController@checkplace');

    //map Router
    Route::resource('map', 'MapController');
    Route::get('map-distrist', 'MapPlaceController@destroy');
    Route::post('map-distrist-add', 'MapPlaceController@add');
    Route::post('map-distrist-update', 'MapPlaceController@update');

    Route::get('touroperator','TravelerController@touroperator')->name('touroperator.index');
    Route::get('form-touroperator','TravelerController@form_touroperator')->name('touroperator.form');
    Route::post('add-touroperator','TravelerController@add_touroperator')->name('touroperator.store');
    Route::get('update-touroperator/{id}','TravelerController@update_touroperator')->name('touroperator.show');
    Route::post('get-update-touroperator/{id}','TravelerController@get_touroperator')->name('touroperator.update');
    Route::get('delete-touroperator/{id}','TravelerController@delete_touroperator')->name('touroperator.destroy');
    Route::get('delete-touroperator','TravelerController@delete');

    Route::get('chart','ChartController@show');

    Route::fallback(function () {
        return view('errors.error');
    });
});
