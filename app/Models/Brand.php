<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

	//
    protected $fillable = ['name'];

    public function stores(){
        return $this->hasMany('App\Models\Store');
    }

    public function brandSales(){
        return $this->belongsToMany('App\Models\Sale');
    }

    public function usersGraded(){
        return $this->belongsToMany('App\Models\User', 'user_brands')->withTimestamps()->withPivot('grading');
    }
}
