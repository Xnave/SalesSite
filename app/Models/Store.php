<?php namespace App\Models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/08/2015
 * Time: 21:44
 */

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

    //
    protected $fillable = ['name', 'phone', 'address', 'brand_id', 'center_id'];

    public function brand(){
        return $this->belongsTo('Brand');
    }

    public function Center(){
        return $this->belongsTo('Center');
    }

    public function sales(){
        return $this->hasMany('Sale');
    }


    public function usersGraded(){
        return $this->belongsToMany('User', 'user_stores')->withTimestamps()->withPivot('grading');
    }
}
