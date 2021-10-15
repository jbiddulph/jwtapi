<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\LocationHeadersController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/venues/{id}', [VenueController::class, 'show']);
Route::get('/venue/towns', [VenueController::class, 'getTowns']);
Route::get('/venues', [VenueController::class, 'index']);

Route::get('/venues/town/{town}', [VenueController::class, 'getTownVenues']);
Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);
//Events
Route::post('/events', [EventController::class, 'store']);
Route::get('/venues/search/{postcode}', [VenueController::class, 'search']);

// Public Routes
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::resource('admin/venues', VenueController::class);
    Route::resource('events', EventController::class);
    Route::resource('users', UserController::class);
    Route::resource('pages', PageController::class);
    Route::resource('headers', HeaderController::class);
    Route::resource('logos', LogoController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('categorys', CategoryController::class);
    Route::get('/postcodes', [VenueController::class, 'getPostCodes']);
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/locations', [VenueController::class, 'getLocations']);
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/headers', [HeaderController::class, 'index']);
    Route::get('/headers/{town}', [HeaderController::class, 'getTownHeaders']);
    Route::get('/logos', [LogoController::class, 'index']);
    Route::get('/settings', [SettingController::class, 'index']);
    Route::get('/categories', [CategoriesController::class, 'index']);
    Route::get('/home', [PageController::class, 'home']);
    Route::get('/venues/{id}', [PageController::class, 'show']);
    Route::get('/venue/{id}', [VenueController::class, 'show']);
    Route::get('/pages/{id}', [PageController::class, 'show']);
    Route::get('/locations/{town}', [VenueController::class, 'getTown']);
    Route::get('pages/search/{name}', [PageController::class, 'search']);
    Route::get('/locations/{location:town}/headers', [LocationHeadersController::class, 'index']);
});

// Protected Routes
Route::group(['middleware' => ['jwt.verify']], function () {
    //Venues
    Route::post('/venues', [VenueController::class, 'store']);
    Route::put('/venues/{id}', [VenueController::class, 'update']);
    Route::delete('/venues/{id}', [VenueController::class, 'destroy']);
    Route::post('upload', [UploadController::class, 'handleUploads']);
    //Pages
    Route::post('/pages', [PageController::class, 'store']);
    Route::put('/pages/{id}', [PageController::class, 'update']);
    Route::delete('/pages/{id}', [PageController::class, 'destroy']);
    //Headers
    Route::post('/headers', [HeaderController::class, 'store']);
    Route::put('/headers/{id}', [PageController::class, 'update']);
    Route::delete('/headers/{id}', [HeaderController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

