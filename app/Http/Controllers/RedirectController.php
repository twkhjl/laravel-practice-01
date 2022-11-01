<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function flash()
    {

        // dd(request()->input('to'));

        if (!request()->input('src') || !request()->input('to')) {
            return redirect(route('listings.index'));
        }
        $src = request()->input('src');
        $to = request()->input('to');
        $route_name='';
        $route_params=[];
        $message='';

        if($src=='listings.create'){
            if($to=='listings.index'){
                $route_name=$to;
                $message='資料已新增';
            }
            if($to=='listings.manage'){
                $route_name=$to;
                $route_params=['user_id'=>auth()->user()->id];
                $message='資料已新增';
            }
        }
        else{
            return redirect(route('listings.index'));

        }


        return redirect(route($route_name,$route_params))->with('message',$message);

    }
}
