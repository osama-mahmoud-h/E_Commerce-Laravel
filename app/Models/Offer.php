<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model{
    use HasFactory;

    protected $table='offers';
   
    protected $fillable=['name','photo','details','created_at','updated_at'];
    
    public function getPhotoAttribute($val){
        return ($val!=null) ? asset('assets/'.$val) : "";
    }
}
