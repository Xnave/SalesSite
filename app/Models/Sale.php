<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

	//
    protected $fillable = ['percentage', 'amount', 'items', 'text', 'start_day', 'end_day', 'type_id', 'store_id'];

    public function type(){
        return $this->belongsTo('SaleType');
    }

    public function store(){
        return $this->belongsTo('Store');
    }

    public function sale(){
        return $this->belongsTo('User');
    }



    public function brandSales(){
        return $this->belongsToMany('Brand');
    }

    public function usersGraded(){
        return $this->belongsToMany('User', 'user_watched_sales')->withPivot('grading');
    }
}

