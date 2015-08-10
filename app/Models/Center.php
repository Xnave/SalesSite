<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/08/2015
 * Time: 21:46
 */
class Brand extends Model {

    //
    protected $fillable = ['name', 'address', 'phone_number'];

    public function stores(){
        return $this->hasMany('Store');
    }
}
