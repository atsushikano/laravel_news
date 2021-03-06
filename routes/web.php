<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\backend\DistrictController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\backend\SubDistrictController;
use App\Http\Controllers\backend\SettingController;
use App\Http\Controllers\Frontend\ExtraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ExtraControllerr;


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
    return view('main.home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


// Admin Logout
Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');

// Admin Categories All Route
Route::get('/categories', [CategoryController::class, 'Index'])->name('categories');
Route::get('/add/category', [CategoryController::class, 'AddCategory'])->name('add.category');
Route::post('/store/category', [CategoryController::class, 'StoreCategory'])->name('store.category');
Route::get('/edit/category/{id}', [CategoryController::class, 'EditCategory'])->name('edit.category');
Route::post('/update/category/{id}', [CategoryController::class, 'UpdateCategory'])->name('update.category');
Route::get('/delete/category/{id}', [CategoryController::class, 'DeleteCategory'])->name('delete.category');

// Admin SubCategories All Route
Route::get('/subcategories', [SubCategoryController::class, 'Index'])->name('subcategories');
Route::get('/add/subcategory', [SubCategoryController::class, 'AddSubCategory'])->name('add.subcategory');
Route::post('/store/subcategory', [SubCategoryController::class, 'StoreSubCategory'])->name('store.subcategory');
Route::get('/edit/subcategory/{id}', [SubCategoryController::class, 'EditSubCategory'])->name('edit.subcategory');
Route::post('/update/subcategory/{id}', [SubCategoryController::class, 'UpdateSubCategory'])->name('update.subcategory');
Route::get('/delete/subcategory/{id}', [SubCategoryController::class, 'DeleteSubCategory'])->name('delete.subcategory');

// Admin SubCategories All Route
Route::get('/districts', [DistrictController::class, 'Index'])->name('districts');
Route::get('/add/district', [DistrictController::class, 'AddDistrict'])->name('add.district');
Route::post('/store/district', [DistrictController::class, 'StoreDistrict'])->name('store.district');
Route::get('/edit/district/{id}', [DistrictController::class, 'EditDistrict'])->name('edit.district');
Route::post('/update/district/{id}', [DistrictController::class, 'UpdateDistrict'])->name('update.district');
Route::get('/delete/district/{id}', [DistrictController::class, 'DeleteDistrict'])->name('delete.district');

// Admin SubCategories All Route
Route::get('/subdistricts', [SubDistrictController::class, 'Index'])->name('subdistricts');
Route::get('/add/subdistrict', [SubDistrictController::class, 'AddSubSubDistrict'])->name('add.subdistrict');
Route::post('/store/subdistrict', [SubDistrictController::class, 'StoreSubDistrict'])->name('store.subdistrict');
Route::get('/edit/subdistrict/{id}', [SubDistrictController::class, 'EditSubDistrict'])->name('edit.subdistrict');
Route::post('/update/subdistrict/{id}', [SubDistrictController::class, 'UpdateSubDistrict'])->name('update.subdistrict');
Route::get('/delete/subdistrict/{id}', [SubDistrictController::class, 'DeleteSubDistrict'])->name('delete.subdistrict');

// Json Data for Category and District
Route::get('/get/subcategory/{category_id}', [PostController::class, 'GetSubCategory']);
Route::get('/get/subdistrict/{district_id}', [PostController::class, 'GetSubDistrict']);

// Admin Posts All Route
Route::get('/allpost', [PostController::class, 'index'])->name('all.post');
Route::get('/createpost', [PostController::class, 'Create'])->name('create.post');
Route::post('/store/post', [PostController::class, 'StorePost'])->name('store.post');
Route::get('/edit/post/{id}', [PostController::class, 'EditPost'])->name('edit.post');
Route::post('/update/post/{id}', [PostController::class, 'UpdatePost'])->name('update.post');
Route::get('/delete/post/{id}', [PostController::class, 'DeletePost'])->name('delete.post');

// Social Setting All Route
Route::get('/social/setting', [SettingController::class, 'SocialSetting'])->name('social.setting');
Route::post('/social/update/{id}', [SettingController::class, 'SocialUpdate'])->name('update.social');

// Seo Setting All Route
Route::get('/seo/setting', [SettingController::class, 'SeoSetting'])->name('seo.setting');
Route::post('/seo/update/{id}', [SettingController::class, 'SeoUpdate'])->name('update.seo');

// Livetv Setting All Route
Route::get('/livetv/setting', [SettingController::class, 'LivetvSetting'])->name('livetv.setting');
Route::post('/livetv/update/{id}', [SettingController::class, 'LivetvUpdate'])->name('update.livetv');
Route::get('/livetv/active/{id}', [SettingController::class, 'ActiveLivetvSetting'])->name('active.livetv');
Route::get('/livetv/deactive/{id}', [SettingController::class, 'DeActiveLivetvSetting'])->name('deactive.livetv');

// Notice Setting All Route
Route::get('/notice/setting', [SettingController::class, 'NoticeSetting'])->name('notice.setting');
Route::post('/notice/update/{id}', [SettingController::class, 'NoticeUpdate'])->name('update.notice');
Route::get('/notice/active/{id}', [SettingController::class, 'ActiveNoticeSetting'])->name('active.notice');
Route::get('/notice/deactive/{id}', [SettingController::class, 'DeActiveNoticeSetting'])->name('deactive.notice');

// Website Link All Route
Route::get('/website/setting', [SettingController::class, 'WebsiteSetting'])->name('all.website');
Route::get('/add/website', [SettingController::class, 'AddWebsiteSetting'])->name('add.website');
Route::post('/store/website', [SettingController::class, 'StoreWebsite'])->name('store.website');
Route::get('/edit/website/{id}', [SettingController::class, 'EditWebsite'])->name('edit.website');
Route::post('/update/website/{id}', [SettingController::class, 'UpdateWebsite'])->name('update.website');
Route::get('/delete/website/{id}', [SettingController::class, 'DeleteWebsite'])->name('delete.website');

// Photo Gallery All Route
Route::get('/photo/gallery', [GalleryController::class, 'PhotoGallery'])->name('photo.gallery');
Route::get('/add/photo', [GalleryController::class, 'AddPhoto'])->name('add.photo');
Route::post('/store/photo', [GalleryController::class, 'StorePhoto'])->name('store.photo');
Route::get('/edit/photo/{id}', [GalleryController::class, 'EditPhoto'])->name('edit.photo');
Route::post('/update/photo/{id}', [GalleryController::class, 'UpdatePhoto'])->name('update.photo');
Route::get('/delete/photo/{id}', [GalleryController::class, 'DeletePhoto'])->name('delete.photo');

// Video Gallery All Route
Route::get('/video/gallery', [GalleryController::class, 'VideoGallery'])->name('video.gallery');
Route::get('/add/video', [GalleryController::class, 'AddVideo'])->name('add.video');
Route::post('/store/video', [GalleryController::class, 'StoreVideo'])->name('store.video');
Route::get('/edit/video/{id}', [GalleryController::class, 'EditVideo'])->name('edit.video');
Route::post('/update/video/{id}', [GalleryController::class, 'UpdateVideo'])->name('update.video');
Route::get('/delete/video/{id}', [GalleryController::class, 'DeleteVideo'])->name('delete.video');

// Frontend
// Multi Language Routes
Route::get('/lang/japanese', [ExtraController::class, 'Japanese'])->name('lang.japanese');
Route::get('/lang/english', [ExtraController::class, 'English'])->name('lang.english');
