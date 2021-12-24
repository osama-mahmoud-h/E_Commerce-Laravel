<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $sub_categories = SubCategory::all();
    return view('admin.sub_categories.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $main_categories = MainCategory::select('name','id')->active()->get();
        if(!$main_categories){
            return redirect()->route('admin.main_categories')->with(['error'=>'الاقسام الرئيسية فارغة  اضف قسم اولا']);
        }
    return view('admin.sub_categories.create',compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request){
       
        try{
            //save photo
            $photoPath="";
            if($request->has('photo')){
                $photoPath = uploadImg('sub_categories',$request->photo);
            }
            //save active
            $active=0;
            if($request->has('active')){
                $active=$request->active;
            }
            SubCategory::create([
                'name'=>$request->name,
                'photo'=>$photoPath,
                'active'=>$active,
                'main_category_id'=>$request->main_category_id,
            ]);
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم الحفظ بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.sub_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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

        $sub_category=SubCategory::find($id);
        if(!$sub_category){
            return redirect()->route('admin.sub_categories')->with(['error'=>'القسم غير موجود']);
        }

        return view('admin.sub_categories.edit',compact('main_categories','sub_category'));
       }
        catch(\Exception $ex){
            return redirect()->route('admin.sub_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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
    public function update(SubCategoryRequest $request, $id){
    try{
        $sub_category = SubCategory::find($id);
        if(!$sub_category){
            return redirect()->route('admin.sub_categories')->with(['error'=>' القسم غير موجود ']);
        }
        //update photo
        if($request->has('photo')){
            SubCategory::where('id',$id)->update([
                'photo'=>$request->photo,
            ]);
        }
        //update active
           $active=0;
        if($request->has('active')){
            $active=1;
        }

        SubCategory::where('id',$id)->update([
            'name'=>$request->name,
            'active'=>$active,
            'main_category_id'=>$request->main_category_id,
        ]);

        return redirect()->route('admin.sub_categories')->with(['success'=>'تم التحديث بنجاح']);
       // return $request->photo;     
    }
    catch(\Exception $ex){
   
        return redirect()->route('admin.sub_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
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
            $sub_category = SubCategory::find($id);
            if(!$sub_category){
                return redirect()->route('admin.sub_categories')->with(['error'=>' القسم غير موجود ']);
            }
            //unlink  photo first
            $photo = Str::after($sub_category->photo,'assets'); 
            $photo = app_path('../public/assets/'.$photo);
            unlink($photo); 
            
            $sub_category->delete();
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.sub_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }
}
