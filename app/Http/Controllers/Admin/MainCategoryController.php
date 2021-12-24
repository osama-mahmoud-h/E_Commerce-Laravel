<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $main_categories = MainCategory::all();
        return view('admin.main_categories.index',compact('main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.main_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainCategoryRequest $request){
        try{
            //save photo
            $photoPath="";
            if($request->has('photo')){
                $photoPath = uploadImg('main_categories',$request->photo);
            }
            //save active
            $active=0;
            if($request->has('active')){
                $active=$request->active;
            }
            MainCategory::create([
                'name'=>$request->name,
                'slug'=>$request->name,
                'photo'=>$photoPath,
                'active'=>$active,
            ]);
            return redirect()->route('admin.main_categories')->with(['success'=>'تم الحفظ بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try{
            $main_category = MainCategory::selection()->find($id);
            if(!$main_category){
                return redirect()->route('admin.main_categories')->with(['error'=>' القسم غير موجود ']);
            }
            return view('admin.main_categories.edit',compact('main_category'));
        }
        catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function update(MainCategoryRequest $request,$id){
      // return $request;
        try{
            $main_category = MainCategory::selection()->find($id);
            if(!$main_category){
                return redirect()->route('admin.main_categories')->with(['error'=>' القسم غير موجود ']);
            }
            //update photo
            if($request->has('photo')){
                MainCategory::where('id',$id)->update([
                    'photo'=>$request->photo,
                ]);
            }
            //update active
             $active=1;
            if($request->has('active')){
                $active=1;
            }else{
                $active=0;
            }

            MainCategory::where('id',$id)->update([
                'name'=>$request->name,
                'active'=>$active,
            ]);

            return redirect()->route('admin.main_categories')->with(['success'=>'تم التحديث بنجاح']);
           // return $request->photo;     
        }
        catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\MainCategory  $mainCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        try{
            $mainCategory = MainCategory::find($id);
            if(!$mainCategory){
                return redirect()->route('admin.main_categories')->with(['error'=>' القسم غير موجود ']);
            }
            //unlink  photo first
            if(($mainCategory->photo)!=""){
            $photo = Str::after($mainCategory->photo,'assets'); 
            $photo = app_path('../public/assets/'.$photo);
            unlink($photo); 
            }
            $mainCategory->delete();
            return redirect()->route('admin.main_categories')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch(\Exception $ex){
            return redirect()->route('admin.main_categories')->with(['error'=>' خطأ غير متوقع, برجاء المحاولة لاحقا ']);
        }
        return null;
    }
}
