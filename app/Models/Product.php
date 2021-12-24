<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    use HasFactory; 
   
   protected $table = 'products';
   protected $fillable = ['id','name','barcode','details',
                          'price','photo','main_catego_id',
                          'created_at','updated_at',
                        ];

    public function getPhotoAttribute($val){
        return ($val!=null) ? asset('assets/'.$val) : "";
        }
    public function main_category(){
        return $this->belongsTo("App\Models\MainCategory","main_catego_id","id");
    }

   /* public function orders(){
        return $this->belongsToMany(Order::class);
    }*/
}
