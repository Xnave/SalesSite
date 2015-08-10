<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model {

	//
    protected $fillable = ['name'];

    public function stores(){
        return $this->hasMany('Store');
    }

    public function brandSales(){
        return $this->belongsToMany('Sale');
    }

    public function usersGraded(){
        return $this->belongsToMany('User', 'user_brands')->withTimestamps()->withPivot('grading');
    }
}
