<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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
    return view('listings', [
        'header' => 'latest listings',
        'listings' => Listing::all(),
    ]);
})->name('listings');

Route::get('/{id}', function ($id) {
    // dd(Listing::find($id));
    return view('listing', [
        'listing' => Listing::find($id),
        'id' =>$id,
    ]);
})->name('listing');
