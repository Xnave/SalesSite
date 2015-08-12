<?php namespace App\Models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/08/2015
 * Time: 22:03
 */

use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{

    protected $guarded = ['type'];

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }
}