<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function index(){
        $main_categories = MainCategory::all();
        $offers = Offer::all(); 
        return view('site.home',compact('main_categories','offers'));
    }
    public function subscribe(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);
           
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:subscribers',
            ]);
            if ($validator->fails()) {
                return redirect('/')->with(['error'=>'هذا البريد ربما يكون موجود بالفعل او غير صالح ']);

            }
            $subscriber=Subscriber::create([
                'email'=>$request->email,
            ]);
            return redirect('/')->with(['success'=>'تم الاشتراك بنجاح   ']);

            
        }catch(\Exception $ex){
             return ;
        }
       
        return redirect('/');
    }
}
