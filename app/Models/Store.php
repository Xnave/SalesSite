<?php namespace App\Models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/08/2015
 * Time: 21:44
 */

use Illuminate\Database\Eloquent\Model;

class Store extends ExtendedModel {

    //
    protected $fillable = ['name', 'phone', 'address', 'brand_id', 'center_id'];
    protected $nullable = ['name', 'phone', 'brand_id', 'center_id'];

    public function brand(){
        return $this->belongsTo('App\Models\Brand');
    }

    public function center(){
        return $this->belongsTo('App\Models\Center');
    }

    public function sales(){
        return $this->hasMany('App\Models\Sale');
    }


    public function usersGraded(){
        return $this->belongsToMany('App\Models\User', 'user_stores')->withTimestamps()->withPivot('grading');
    }
}
