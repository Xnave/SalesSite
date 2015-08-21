<?php namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/08/2015
 * Time: 21:46
 */
class Center extends ExtendedModel {

    //
    protected $fillable = ['name', 'address', 'phone_number'];
    protected $nullable = ['phone_number'];

    public function stores(){
        return $this->hasMany('App\Models\Store');
    }
}
