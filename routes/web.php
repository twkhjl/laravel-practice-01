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
    return redirect()->route('listings.index');
});


Route::prefix('listings')->group(function () {
    Route::get('/', function () {
        return view('listings', [
            'header' => 'latest listings',
            'listings' => Listing::all(),
        ]);
    })->name('listings.index');

    // Route::get('/id/{id}', function ($id) {
    //     // dd(Listing::find($id));
    //     return view('listing', [
    //         'listing' => Listing::find($id),
    //         'id' => $id,
    //     ]);
    // })->name('listings.show');




    // route model binding
    // ===================================
    // 綁定前:

    // Route::get('/id/{id}',function($id){
    //     $listing = Listing::find($id);
    //     if($listing){
    //         return view('listing',
    //         ['listing'=>$listing]
    //     );
    //     }else{
    //         abort('404');
    //     };
    // })->name('listings.show');

    // 綁定後(兩段程式碼效果相同):
    Route::get('/id/{listing}',function(Listing $listing){
        return view('listing',[
            'listing'=>$listing
        ]);
    })->name('listings.show');

    // ===================================

});
