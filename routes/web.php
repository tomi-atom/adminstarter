<?php

use App\Http\Controllers\ApiJadwalController;
use App\Http\Controllers\ApiKursusController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\Backend\AssignPermissionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ResetPasswordUserController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PembayaranController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('login');
})->name('home.index');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/countries-list',[CountriesController::class, 'index'])->name('countries.list');
Route::post('/add-country',[CountriesController::class,'addCountry'])->name('add.country');
Route::get('/getCountriesList',[CountriesController::class, 'getCountriesList'])->name('get.countries.list');
Route::post('/getCountryDetails',[CountriesController::class, 'getCountryDetails'])->name('get.country.details');
Route::post('/updateCountryDetails',[CountriesController::class, 'updateCountryDetails'])->name('update.country.details');
Route::post('/deleteCountry',[CountriesController::class,'deleteCountry'])->name('delete.country');
Route::post('/deleteSelectedCountries',[CountriesController::class,'deleteSelectedCountries'])->name('delete.selected.countries');

Route::RESOURCE('mobil',  MobilController::class );
Route::get('mobil/get_data', [MobilController::class,'show'])->name('mobil.get_data');

Route::RESOURCE('kursus',  KursusController::class );
Route::get('kursus/get_data', [KursusController::class,'show'])->name('kursus.get_data');


Route::RESOURCE('pembayaran',  PembayaranController::class );
Route::get('pembayaran/get_data', [PembayaranController::class,'show'])->name('pembayaran.get_data');
Route::get('pembayaran/{id}/editbayar', [PembayaranController::class,'editbayar']);


Route::RESOURCE('jadwal',  JadwalController::class );
Route::get('jadwal/get_data', [JadwalController::class,'show'])->name('jadwal.get_data');

//API

Route::RESOURCE('apikursus',  ApiKursusController::class );
Route::get('apikursus/get_data', [ApiKursusController::class,'show'])->name('apikursus.get_data');


Route::RESOURCE('apijadwal',  ApiJadwalController::class );
Route::get('apijadwal/get_data', [ApiJadwalController::class,'show'])->name('apijadwal.get_data');



Route::post('apilogin', [ApiUserController::class, 'login']);
Route::post('apiregister', [ApiUserController::class, 'register']);
Route::put('apiupdate-user/{id}', [ApiUserController::class, 'update']);
Route::post('apiupload-user/{id}', [ApiUserController::class, 'upload']);


Route::group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('permission:lihat dasbor');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update/{id}', [ProfileController::class, 'updateGeneralInformation'])->name('profile.update.information');
    Route::put('/profile/update/password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::post('/profile/update/image', [ProfileController::class, 'updateImage'])->name('profile.update.image');

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:lihat role');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:tambah role');
        Route::post('/', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:tambah role');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:ubah role');
        Route::put('/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:ubah role');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:hapus role');
    });

    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:lihat permission');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:tambah permission');
        Route::post('/', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:tambah permission');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:ubah permission');
        Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:ubah permission');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:hapus permission');
    });

    Route::group(['prefix' => 'assignpermission'], function () {
        Route::get('/', [AssignPermissionController::class, 'index'])->name('assignpermission.index')->middleware('permission:lihat assign permission');
        Route::get('/{role}/edit', [AssignPermissionController::class, 'editRolePermission'])->name('assignpermission.edit')->middleware('permission:ubah assign permission');
        Route::post('/updaterolepermission', [AssignPermissionController::class, 'updateRolePermission'])->name('assignpermission.update')->middleware('permission:ubah assign permission');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware('permission:lihat pengguna');
        Route::get('/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:tambah pengguna');
        Route::post('/', [UserController::class, 'store'])->name('users.store')->middleware('permission:tambah pengguna');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:ubah pengguna');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:ubah pengguna');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:hapus pengguna');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:lihat pengguna');

        Route::put('/users/{user}/resetpassword', [ResetPasswordUserController::class, 'resetPassword'])->name('users.reset.password')->middleware('permission:ubah pengguna');
    });


    Route::group(['prefix' => 'settings'], function () {
        Route::get('/index', [SettingController::class, 'index'])->name('setting.index')->middleware('permission:lihat pengaturan');
        Route::put('/updateinformation/{setting}/', [SettingController::class, 'updateInformation'])->name('setting.update.information')->middleware('permission:ubah pengaturan');
        Route::put('/updatelogo/{setting}/', [SettingController::class, 'updateLogo'])->name('setting.update.logo')->middleware('permission:ubah pengaturan');
        Route::put('/updatefrontimage/{setting}/', [SettingController::class, 'updateFrontImage'])->name('setting.update.front.image')->middleware('permission:ubah pengaturan');
    });



});
