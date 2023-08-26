<?php
define('PAGINATION_COUNT',3);

use App\Http\Controllers\Admin\AdminPanelSettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvItemcardCategoriesController;
use App\Http\Controllers\Admin\InvUomController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SalesMatrialTypeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TreasurieController;
use App\Http\Controllers\Admin\TreasurieDeliveriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*
Route::get('/', function () {
    return view('layouts.admin');
});


Route::get('login',function (){
    return view('admin.auth.login');
});
*/
//Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');

Route::group(['prefix' => 'admin', 'Middleware' => 'auth:admin'] ,function (){

    Route::get('adminPanelSettings',[AdminPanelSettingController::class,'index'])->name('admin.adminPanelSettings.index');
    Route::get('adminPanelSettingsEdit/{id}',[AdminPanelSettingController::class,'edit'])->name('admin.adminPanelSettings.edit');
    Route::post('adminPanelSettingsUpdate/{id}',[AdminPanelSettingController::class,'update'])->name('admin.adminPanelSettings.update');


    /// Start Treasuries
    Route::get('treasuries/index',[TreasurieController::class,'index'])->name('admin.treasuries.index');
    Route::get('treasuries/edit/{id}',[TreasurieController::class,'edit'])->name('admin.treasuries.edit');
    Route::get('treasuries/create',[TreasurieController::class,'create'])->name('admin.treasuries.create');
    Route::post('treasuries/store',[TreasurieController::class,'store'])->name('admin.treasuries.store');
    Route::post('treasuries/ajaxSearch',[TreasurieController::class,'ajax_search'])->name('admin.treasuries.ajax_search');
    Route::post('treasuries/update/{id}',[TreasurieController::class,'update'])->name('admin.treasuries.update');
    Route::get('details/{id}',[TreasurieDeliveriesController::class,'index'])->name('admin.details.index');
    Route::get('deliveries/{id}',[TreasurieDeliveriesController::class,'create'])->name('admin.treasurie_deliveries.add_treasurie_deliveries');
    Route::post('deliveries/{id}',[TreasurieDeliveriesController::class,'store'])->name('admin.reasurie_deliveries.store');
    Route::get('destroy/{id}',[TreasurieDeliveriesController::class,'destroy'])->name('admin.details.destroy');
    /// End Treasuries
    /// Start sales_matrial_types
    Route::get('sales',[SalesMatrialTypeController::class,'index'])->name('admin.sales_matrial_types.index');
    Route::get('sales/create',[SalesMatrialTypeController::class,'create'])->name('admin.sales_matrial_types.create');
    Route::post('sales/store',[SalesMatrialTypeController::class,'store'])->name('admin.sales_matrial_types.store');
    Route::get('sales/edit/{id}',[SalesMatrialTypeController::class,'edit'])->name('admin.sales_matrial_types.edit');
    Route::post('sales/update/{id}',[SalesMatrialTypeController::class,'update'])->name('admin.sales_matrial_types.update');
    Route::get('sales/destroy/{id}',[SalesMatrialTypeController::class,'destroy'])->name('admin.sales_matrial_types.destroy');

    /// End sales_matrial_types
    /// Start Stores

    Route::get('store',[StoreController::class,'index'])->name('admin.store.index');
    Route::get('store/create',[StoreController::class,'create'])->name('admin.store.create');
    Route::post('store/store',[StoreController::class,'store'])->name('admin.store.store');
    Route::get('edit/{id}',[StoreController::class,'edit'])->name('admin.store.edit');
    Route::post('update/{id}',[StoreController::class,'update'])->name('admin.store.update');
    Route::get('destroy/{id}',[StoreController::class,'destroy'])->name('admin.store.destroy');
    /// End Stores

    /// Start inv_uoms
    Route::get('inv_uoms/',[InvUomController::class,'index'])->name('admin.inv_uoms.index');
    Route::get('inv_uoms/create',[InvUomController::class,'create'])->name('admin.inv_uoms.create');
    Route::post('inv_uoms/store',[InvUomController::class,'store'])->name('admin.inv_uoms.store');
    Route::get('inv_uoms/edit/{id}',[InvUomController::class,'edit'])->name('admin.inv_uoms.edit');
    Route::post('inv_uoms/update/{id}',[InvUomController::class,'update'])->name('admin.inv_uoms.update');
    Route::get('inv_uoms/destroy/{id}',[InvUomController::class,'destroy'])->name('admin.inv_uoms.destroy');
    Route::post('inv_uoms/ajax_search',[InvUomController::class,'ajax_search'])->name('admin.inv_uoms.ajax_search');
    /// End inv_uoms


    // Start Uoms

    Route::resource('item_categories',InvItemcardCategoriesController::class);

    // End Uoms
    Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');

    Route::get('logout',[LoginController::class,'store'])->name('admin.logout');
});


Route::group(['namespace' => 'Admin','prefix' => 'admin','Middleware' => 'guest:admin'],function (){

    Route::get('login',[LoginController::class,'index'])->name('admin.showLogin');

    Route::post('/login',[LoginController::class,'create'])->name('admin.Login');


});


