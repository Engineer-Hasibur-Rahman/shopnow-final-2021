<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;

use App\Http\Controllers\Frontend\CartController;

use App\Models\User;


// Home Route 
// Route::get('/', function () {
//     return view('welcome');
// });

// Admin prefix route
Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){



// Admin Route
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');


// admin logout route 
Route::get('admin/logout', [AdminController::class, 'loginForm'])->name('admin.logout');


// admin profile route 
Route::get('admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.admin_profile_view');

// admin profile Edit route 
Route::get('admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.admin_profile_edit');

////Admin Profile edit store route
Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

////Admin password change
Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.admin_change_password');

////Admin update password
Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

});



// User Route
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {

    $id = Auth::user()->id;
    $user = User::find($id);

    return view('dashboard', compact('user'));
})->name('dashboard');


// Frontend Route
Route::get('/', [IndexController::class, 'index']);

// User Logout Route
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');


// User Update Profile
Route::get('/user/profile/update', [IndexController::class, 'UserProfile'])->name('user.profile');

// user profile store
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');


// user Change Password
Route::get('/user/change/password', [IndexController::class, 'UserChnagePassword'])->name('change.password');


// user  Password Update
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');



// Admin All Brands Route Group 
Route::prefix('brand')->group(function(){

    Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');

    Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');

    Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');

    Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');

    Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');

    // Route::get('/brand/destroy/{brand_id}', [BrandController::class, 'destroy']);

});



// Admin All Category Route Group 
Route::prefix('category')->group(function(){

    Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');

    Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');

    Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');

    Route::post('/update', [CategoryController::class, 'CategoryUpdate'])->name('category.update');

    Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

});

// Admin All SUb Category Route Group 
Route::prefix('subcategory')->group(function(){

    Route::get('/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');

    Route::post('/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');

    Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');

    Route::post('/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');

    Route::get('/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');


});

// Admin All Sub SUb Category Route Group 
Route::prefix('subsubcategory')->group(function(){

    Route::get('/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
   
    // sub sub category route
    Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
    
    // for auto select sub sub category route
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);

  //Sub  Sub category store 
  Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
 
  // Sub sub Catageroy edit
 Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');

 Route::post('/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');

 Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');


});

// Admin Product Route Group 
Route::prefix('product')->group(function(){

    Route::get('/view', [ProductController::class, 'ProductAdd'])->name('product.add');
    Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product_store'); 
   

    // Manage Product
    Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
    // Edit Product
    Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
    // Upadte Product
    Route::post('/update', [ProductController::class, 'UpdateProduct'])->name('product_update');

    // For Multiple Img Update
    Route::post('/update/multiimg', [ProductController::class, 'UpdateProductMultiImg'])->name('update_product_img');
    // for Multipart Deleted 
    Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');


   // For Thambnail Img Update
    Route::post('/thambnail/update', [ProductController::class, 'ThambnailImageUpdate'])->name('update-product-thambnail');


    //===================================Product Active And Deactive========================================    
    // for Deactive
    Route::get('/deactive/{id}', [ProductController::class, 'ProductDeactive'])->name('product.deactive');
    // for Active
    Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');

     //===================================Product Delete========================================  
     Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    

});

    // Slider  Route Group 
    Route::prefix('slider')->group(function(){

    Route::get('/view', [SliderController::class, 'SliderView'])->name('manage.slider');

    Route::post('/store', [SliderController::class, 'SliderStore'])->name('slider.store');
    
    Route::get('/edit/{id}', [SliderController::class, 'SliderEdit'])->name('slider.edit');  

    Route::post('/update', [SliderController::class, 'SliderUpdate'])->name('slider.update');

    Route::get('/delete/{id}', [SliderController::class, 'SliderDelete'])->name('slider.delete');

     //===================================Product Active And Deactive==================================   
    // for Deactive
    Route::get('/deactive/{id}', [SliderController::class, 'SliderDeactive'])->name('slider.deactive');
    // for Active
    Route::get('/active/{id}', [SliderController::class, 'SliderActive'])->name('slider.active');


});


// Multi language 
// Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
// Route::get('/language/hindi', [LanguageController::class, 'Hindi'])->name('hindi.language');


// product detail route
Route::get('/product/detail/{id}', [IndexController::class, 'ProductDetails']);


// Frontend tags page route
Route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);


// Frontend SubCategory wise Data
Route::get('/subcategory/product/{subcat_id}', [IndexController::class, 'SubCatWiseProduct']);
 

// Frontend Sub  SubCategory wise Data
Route::get('/subsubcategory/product/{subsubcat_id}', [IndexController::class, 'SubSubCatWiseProduct']);
 
// Product view model ajax card
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);
 
// Product Add to cart route ajax  use in package
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

