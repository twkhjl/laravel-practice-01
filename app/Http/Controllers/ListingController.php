<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

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

		// return response()->json($request->all());

		try {
			// 驗證表單
			$validator = Validator::make($request->all(), [

				// 'company'=>['required',Rule::unique('listings','company')],
				// 'company'=>'required|unique:listings',
				'company' => ['required', 'unique:listings'],

				'title' => ['required'],

				// 'logo'=>['mimes:jpg,jpeg,png','max:1024'],
				// 'logo'=>['image','max:1024','dimensions:max_width=300,max_height=218'],
				// 'logo'=>['image','max:1024','dimensions:width=640,height=915'],
				'logo' => ['image', 'max:1024'],

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
			], [
				// 自定欄位在錯誤訊息中的顯示名稱
				'company' => '公司名稱',
				'title' => '職稱',
				'tags' => '關鍵字',
				'website' => '公司網站',
				'location' => '工作地點',
				'description' => '工作描述',
			]);

			if ($validator->fails()) {

				//只想回傳json
				return response()->json(['errors' => $validator->errors()]);
			};


			// 取得表單輸入值
			$listing = new Listing();
			$fillable = collect($listing->getFillable())->toArray();
			$formField = $request->only($fillable);



			// 處理上傳檔案
			if ($request->hasFile('logo')) {
				$formField['logo'] = $request->file('logo')->store('logos', 'public');
			};


            // 方1
            $user_id=auth()->user()->id;
            $formField['user_id']=$user_id;

            Listing::create($formField);


            // 方2
			// $user = auth()->user();
			// $user->listings()->create($formField);


		} catch (\Exception $e) {

			return
				response()->json(['server error' => $e->getMessage()]);
		}


		return response()->json(['status' => 'success']);



		// return redirect(route('listings.index'))->with('message','成功新增一筆資料');
	}
	public function edit(Listing $listing)
	{

		return view('listings.edit', [
			'listing' => $listing
		]);
	}
	public function update(Request $request)
	{
		// return response()->json($request->all());
		// return response()->json($request->input('id'));


		// 驗證表單
		$validator = Validator::make($request->all(), [

			// 'company' => ['required', 'unique:listings'],
			'company' => ['required'],

			'title' => ['required'],

			'logo' => ['image', 'max:1024'],

		], [
			// 自定錯誤訊息

		], [
			// 自定欄位在錯誤訊息中的顯示名稱
			'company' => '公司名稱',
			'title' => '職稱',
			'tags' => '關鍵字',
			'website' => '公司網站',
			'location' => '工作地點',
			'description' => '工作描述',
		]);

		if ($validator->fails()) {

			//只想回傳json
			return response()->json(['errors' => $validator->errors()]);
		};


		// 取得表單輸入值



		$listing = Listing::find($request->input('id'));
		$fillable = collect($listing->getFillable())->toArray();
		$formField = $request->only($fillable);

		// 處理上傳檔案
		if ($request->hasFile('logo')) {

			// 移除舊檔案
			if (FacadesFile::exists(public_path('storage/' . $listing->logo))) {
				FacadesFile::delete(public_path('storage/' . $listing->logo));
			}

			// 儲存新檔案
			$formField['logo'] = $request->file('logo')->store('logos', 'public');
		};

		$listing->update($formField);

		return response()->json(['status' => 'success']);



		// return redirect(route('listings.index'))->with('message','成功新增一筆資料');
	}
	public function destroy(Request $request)
	{
		// dd($request->input('id'));
		$listing = Listing::find($request->input('id'));

		// 移除圖檔
		if (FacadesFile::exists(public_path('storage/' . $listing->logo))) {
			FacadesFile::delete(public_path('storage/' . $listing->logo));
		}

		$listing->delete();

		return redirect(route('listings.index'))->with('message', '資料已刪除');
	}
}
