<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	//
    protected $fillable = ['percentage', 'amount', 'items', 'text', 'start_day', 'end_day', 'type_id', 'store_id'];

    public function type(){
        return $this->belongsTo('App\Models\SaleType');
    }

    public function store(){
        return $this->belongsTo('App\Models\Store');
    }

    public function sale(){
        return $this->belongsTo('App\Models\User');
    }



    public function brandSales(){
        return $this->belongsToMany('App\Models\Brand');
    }

    public function usersGraded(){
        return $this->belongsToMany('App\Models\User', 'user_watched_sales')->withTimestamps()->withPivot('grading');
    }
}

