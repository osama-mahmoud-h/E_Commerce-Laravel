<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $offers=Offer::all();
        return view('admin.offers.index',compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view ('admin.offers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request){
        try{
            //save photo
            $photoPath="";
            if($request->has('photo')){
                $photoPath = uploadImg('offers',$request->photo);
            }
            //save active
            $price=0;
            if($request->has('price')){
                $price=$request->price;
            }
            Offer::create([
                'name'=>$request->name,
                'photo'=>$photoPath,
                'price'=>$price,
                'details'=>$request->details,

            ]);
            return redirect()->route('admin.offers')->with(['success'=>'تم الحفظ بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.offers')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $offer =Offer::find($id);
            if(!$offer){
                return redirect()->route('admin.offers')->with(['error'=>' العرض غير موجود ']);
            }
            return view('admin.offers.edit',compact('offer'));
        }
        catch(\Exception $ex){
            return redirect()->route('admin.offers')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, $id) {
        try{
            $main_category = Offer::find($id);
            if(!$main_category){
                return redirect()->route('admin.offers')->with(['error'=>' المنتج غير موجود ']);
            }
            //update photo
            if($request->has('photo')){
                Offer::where('id',$id)->update([
                    'photo'=>$request->photo,
                ]);
            }

            Offer::where('id',$id)->update([
                'name'=>$request->name,
                'price'=>$request->price,
                'details'=>$request->details,
            ]);

            return redirect()->route('admin.offers')->with(['success'=>'تم التحديث بنجاح']);
           // return $request->photo;     
        }
        catch(\Exception $ex){
            return redirect()->route('admin.offers')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        
        try{
            $offer = Offer::find($id);
            if(!$offer){
                return redirect()->route('admin.offers')->with(['error'=>' المنتج غير موجود ']);
            }
            //unlink  photo first
            $photo = Str::after($offer->photo,'assets'); 
            $photo = app_path('../public/assets/'.$photo);
            unlink($photo); 
            
            $offer->delete();
            return redirect()->route('admin.offers')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.offers')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;        
    }
}
