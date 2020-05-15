<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $fillable = [
        'customer_id',
        'description',
        'amount',
     ];

    protected $table = 'order';

    public function toCustomer()
    {
        return $this->belongsTo('App\CustomersModel', 'customer_id');
    }
}
