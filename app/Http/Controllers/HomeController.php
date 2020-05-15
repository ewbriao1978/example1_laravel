<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CustomersModel;
use App\OrdersModel;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.login');
    }

    public function loginAuth(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email:rfc',
            'password' => 'required|min:5|max:100',
        ]);
        if ($validator->fails()){ 
            return redirect('/')
            ->withErrors($validator)
            ->withInput();
        }

        $result = CustomersModel::where('email',$request->input('email'))->where('passwd',md5($request->input('password')))->first();
       if (!$result) { // Does it match the user credentials?
           return redirect('/')->with('loginFail',' Incorrect username (your e-mail) or password.');
       } else {
            //Session::put(['customer_name',"eduarod"]);
            session(['customer_name'=> $result['name']]);
            session(['id'=>$result['id']]);
            if ($result['name'] == 'admin'){
                
               return redirect('adminsession')->with(['admin','true']);
            }else{
                return redirect()->route('customersession', ['id' => $result['id']]);
               
            }
       }
                
    }// end of loginAuth function



    public function registrationMethod(){
        return view('pages.formregister');
    }

    public function insertDataUser(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:5|max:255',
            'email' => 'required|email:rfc',
            'passwd' => 'required|min:5|max:100',
        ]);
        if ($validator->fails()){ 
            return redirect('/registration')
            ->withErrors($validator)
            ->withInput();
             
        }

        $customermodel = new CustomersModel;
        $customermodel->name = $request->name;
        $customermodel->email = $request->email;
        $customermodel->passwd = md5($request->passwd);
        // store data to table customer
        $customermodel->save();
        return redirect('/')->with('success','Registered Successfull. Please, login.');

    }


    public function customerSession($id){
        
        $customermodel = new CustomersModel;
        $customer = $customermodel->find($id);
        $orders = $customermodel->find($id)->allorders;
        $result = array(
            'name' => $customer->name,
            'id' => $id,
            'orders' => $orders
        );
        
        return view ('pages.customersessionview',$result);
    }



    public function insertOrder($id){
        $customermodel = new CustomersModel;
        $customer = $customermodel->find($id);
        return view ('pages.formorders', ['id' => $id]);
    }

    public function saveOrder(Request $request, $id){
        $orders = new OrdersModel;

        $validator = Validator::make($request->all(),[
            'description' => 'required|min:5|max:255',
            'amount' => 'required|numeric'
        ]);
        if ($validator->fails()){ 
            return back()
            ->withErrors($validator)
            ->withInput();          
        }
      
        $orders->description = $request->description;
        $orders->amount = $request->amount;
        $orders->customer_id = $id;
        // store data to table orders
        $orders->save();
        return redirect()->route('customersession', ['id' => $id]);
    }

    public function removeOrder($id){
        $order = OrdersModel::where('id', $id)->first();
        $customer_id = $order->customer_id;
         $order = OrdersModel::where('id', $id)->delete();
       
        if ($order) {
            return redirect()->route('customersession', ['id' => $customer_id]);
        }
    }


 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = OrdersModel::where('id', $id)->first();
        return view ('pages.formeditorders',['order' => $order]);

    }


/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'description' => 'required|min:5|max:255',
            'amount' => 'required|numeric'
        ]);
        if ($validator->fails()){ 
            return back()
            ->withErrors($validator)
            ->withInput();          
        }
       
        OrdersModel::find($id)->update($request->all());
        
        return redirect()->route('customersession', ['id' => $request->customer_id]);
    }

    public function logout(){
            session()->flush();
            return redirect('/');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

   

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
