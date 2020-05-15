@extends('layouts.customersessionlayout')
@section('customerview')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('update/'.$order->id) }}" method="post">
 @csrf 
        <div class="form-group">
          <div class="col-md-4 mb-3">
            <label for="nameInputLabel">Description:</label>
            <input type="text" class="form-control" id="nameInputLabel" name="description" value="{{ $order->description }}">
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-4 mb-3">
            <label for="emailInputLabel">Amount:</label>
            <input type="text" class="form-control" id="emailInputLabel" name = "amount" value="{{ $order->amount }}">
          </div>
        </div>   
        <input type = "hidden" id="inputHidden" name="customer_id" value="{{ $order->customer_id }} ">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
@endsection