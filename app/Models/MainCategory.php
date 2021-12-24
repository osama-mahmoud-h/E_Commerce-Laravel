<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model{
    use HasFactory;

   protected $table='main_categories';
   
   protected $fillable=['name','photo','slug','active','created_at','updated_at'];
   
   public function scopeSelection($query){
       return $query->select('id','name','slug','photo','active');
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
    return $this->hasMany("App\Models\Product","main_catego_id","id");
}

}
