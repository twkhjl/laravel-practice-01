<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ListingController extends Controller
{
    // show all listings
    public function index(Request $request)
    {
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
            // 'listings' => Listing::latest()->filterTag(request(['tag', 'search']))->get(),
            'listings' => Listing::latest()->filterTag(request(['tag', 'search']))->paginate(6),
            // 'listings' => Listing::paginate(6),
        ]);
    }
    // show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    public function create()
    {
        return view('listings.create');
    }
    public function store(Request $request)
    {

        $formField = $request->validate([
            // 'company'=>['required',Rule::unique('listings','company')],
            // 'company'=>'required|unique:listings',
            'company' => ['required', 'unique:listings'],

            'title' => ['required'],
            // 'email' => ['required', 'email'],
            // 'tags' => ['required'],
            // 'website' => ['required'],
            // 'location' => ['required'],
            // 'description' => ['required'],
        ], [
            // 自定錯誤訊息

            // 'company.unique'=>'"'.$request->input('company').'"'.'已被使用',
            // 'required' => ':attribute不可空白',
            // 'email' => '請輸入有效的email格式',
        ],[
            // 自定欄位在錯誤訊息中的顯示名稱
            'company' => '公司名稱',
            'title' => '職稱',
            'tags' => '關鍵字',
            'website' => '公司網站',
            'location' => '工作地點',
            'description' => '工作描述',
        ]);

        Listing::create($formField);

        return redirect(route('listings.index'))->with('message','成功新增一筆資料');
    }
}
