<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model{
    use HasFactory;

    protected $table = 'sub_categories';
    protected $fillable = [	'name','photo','active','main_category_id','created_at','updated_at'];
   
    public function main_category(){
        return $this->belongsTo('App\Models\MainCategory','main_category_id','id');
    }
    public function scopeActive($query){
        return $query->where('active',1);
    }
    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    public function getPhotoAttribute($val){
        return ($val!=null) ? asset('assets/'.$val) : "";
    }
    public function products(){
        return $this->hasMany('App\Models\Product','sub_catego_id','id');
    }
}
