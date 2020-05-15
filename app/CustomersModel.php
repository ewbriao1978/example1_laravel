<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    
    protected $fillable = [
        'name',
        'email',
        'passwd',
     ];

    protected $table = 'customer';
    public function allorders()
    {
        return $this->hasMany('App\OrdersModel','customer_id');
    }
}
