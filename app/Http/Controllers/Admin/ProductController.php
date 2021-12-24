<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\MainCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Subscriber;
use App\Notifications\AddItemNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $main_categories = MainCategory::select('name','id')->get();
        if(! $main_categories){
            return redirect()->route('admin.main_categories')->with(['error'=>'الاقسام الرئيسية  فارغة  اضف قسم اولا']);
        }
        return view('admin.products.create',compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request){
      //  return $request;
        try{
            //save photo
            $photoPath="";
            if($request->has('photo')){
                $photoPath = uploadImg('products',$request->photo);
            }
            //save barcode
           $barcode="0000";
           if($request->has("barcode")){
               $barcode=$request->barcode;
           }
           $product = Product::create([
                'name'=>$request->name,
                'price'=>$request->price,
                'barcode'=>$barcode,
                'main_catego_id'=>$request->main_catego_id,
                'photo'=>$photoPath,
                'details'=>$request->details,
            ]);

            // notify subScriber
            $subscribers=Subscriber::all();
            foreach($subscribers as $subscriber)
                    $subscriber->notify(new AddItemNotification);

            return redirect()->route('admin.products')->with(['success'=>'تم الحفظ بنجاح']);
        }
        catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.products')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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
            $main_categories = MainCategory::select('name','id')->active()->get();
            if(!$main_categories){
                return redirect()->route('admin.main_categories')->with(['error'=>'الاقسام الرئيسية فارغة  اضف قسم اولا']);
            }
    
            $product=Product::find($id);
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>'المنتج غير موجود']);
            }
    
            return view('admin.products.edit',compact('product','main_categories'));
           }
            catch(\Exception $ex){
                return $ex;
                return redirect()->route('admin.products')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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
    public function update(ProductRequest $request, $id){
        
        try{
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>' القسم غير موجود ']);
            }
            //update photo
            if($request->has('photo')){
                Product::where('id',$id)->update([
                    'photo'=>$request->photo,
                ]);
            }
            //update active
               $barcode="0000";
            if($request->has('barcode')){
                $barcode=$request->barcode;
            }
            $details="";
            if($request->has('details')){
                $details=$request->details;
            }
    
            Product::where('id',$id)->update([
                'name'=>$request->name,
                'price'=>$request->price,
                'barcode'=>$barcode,
                'main_catego_id'=>$request->main_catego_id,
                'details'=>$details,
            ]);
    
            return redirect()->route('admin.products')->with(['success'=>'تم التحديث بنجاح']);
           // return $request->photo;     
        }
        catch(\Exception $ex){
       
            return redirect()->route('admin.products')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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
            $product = Product::find($id);
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>' القسم غير موجود ']);
            }
            //unlink  photo first 
            $photo = Str::after($product->photo,'assets'); 
            $photo = app_path('../public/assets/'.$photo);
            unlink($photo); 
            
            $product->delete();
            return redirect()->route('admin.products')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.products')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

} 