<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomersModel;
use App\OrdersModel;

class AdminController extends Controller
{
    
    public function adminSession(){
        $data['admin'] = "true";
        $data['customers'] = CustomersModel::all()->sortBy('name');
        $data['orders'] = OrdersModel::all()->sortBy('description'); 
        
        return view('admin.adminsessionview',$data);
    }
}
