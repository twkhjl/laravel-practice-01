<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // show all listings
    public function index(Request $request){
        // $listings= Listing::all();
        // if($request->tag){

        //     $tag = $request->tag;

        //     $listings= $listings->filter(function($listing) use($tag){

        //         $tags=explode(',',$listing->tags);
        //         if(in_array($tag,$tags)){
        //             return $listing;
        //         }

        //     });
        // }

        return view('listings.index', [
            'header' => 'latest listings',
            'listings' =>Listing::latest()->filterTag(request(['tag','search']))->get(),
        ]);
    }
    // show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing'=>$listing
        ]);
    }
}
