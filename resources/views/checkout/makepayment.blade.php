@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height">
    
    <div class="container mt-5">
        <div class="col-12 col-lg-12">
            <!-- Flash Alerts Begin -->

            @include('partials.alerts')
            
            <!-- Flash Alerts Ends -->
        </div>

        <h1 class="display-4 text-center mb-5">Account Balance - Make a Payment</h1>
        <form class="" id="" action="{{ url('/makeapayment') }}" method="POST">
            {{ csrf_field() }}
            <h3 class="text-center border bg-whitewash text-gunmetal">Payment Information</h3>
            <div class="form-row mt-1">
                <div class="col-6">
                    <label for="cname" class="font-weight-bold">First Name</label>
                    <input type="text" class="form-control form-control-sm required" id="cname" name="cname">
                </div>

                <div class="col-6">
                    <label for="clastname" class="font-weight-bold">Last Name</label>
                    <input type="text" class="form-control form-control-sm required" id="clastname" name="clastname">
                </div>
            </div>


            <div class="form-row mt-3">
                <div class="col-6">
                    <label for="cnumber" class="font-weight-bold ">Card Number</label>
                    <input type="text" class="form-control form-control-sm required" id="ccardnum" name="ccardnum">
                </div>
                <div class="col-6">
                    <label for="cemail" class="font-weight-bold ">E-mail</label>
                    <input type="text" class="form-control form-control-sm required" id="cemail" name="cemail">
                </div>
            </div>

            <div class="form-row mt-3">
                <div class="col-4">
                    <label for="card-expiry-month" class="font-weight-bold">Exp Month</label>
                    {{ Form::selectMonth(null, null, ['name' => 'card_expiry_month', 'class' => 'form-control form-control-sm', 'required']) }}
                </div>

                <div class="col-4">
                    <label for="card-expiry-year" class="font-weight-bold">Exp Year</label>
                    {{ Form::selectYear(null, date('Y'), date('Y') + 10, null, ['name' => 'card_expiry_year', 'class' => 'form-control form-control-sm', 'required']) }}
                </div>
                <div class="col-4">
                    <label for="ccvv" class="font-weight-bold">CVV</label>
                    <input type="text" class="form-control form-control-sm required" id="ccvv" name="ccvv">
                </div>
            </div>



            <h3 class="text-center mt-4 border bg-whitewash text-gunmental">Billing Address</h3>
            <div class="form-row mt-1">
                <label for="cstreetaddress" class="font-weight-bold">Street Address</label>
                <input type="text" class="form-control form-control-sm required" id="cstreetaddress" name="cstreetaddress">
            </div>
            <div class="form-row mt-3">
                <div class="col-4">
                    <label for="ccity" class="font-weight-bold">City</label>
                    <input type="text" class="form-control form-control-sm required" id="ccity" name="ccity">
                </div>
                <div class="col-4">
                    <label for="cstate" class="font-weight-bold">State</label>
                    <input type="text" class="form-control form-control-sm required" id="cstate" name="cstate">
                </div>
                <div class="col-4">
                    <label for="czip" class="font-weight-bold">Zip</label>
                    <input type="text" class="form-control form-control-sm required" id="czip" name="czip">
                </div>
            </div>
            <div class="form-row mt-1">
                <label for="amount" class="font-weight-bold">Amount</label>
                <input type="text" class="form-control form-control-sm required" id="amount" value="{{$user->account_balance}}" name="amount">
            </div>


            <div class="row justify-content-center mt-3">
                <a onclick="history.back()" class="btn btn-link text-frenchblue"><i class="fas fa-long-arrow-alt-left"></i> Go Back</a>
                <button type="submit" class="btn btn-primary bg-denim" name="cc-auth-submit" id="cc-auth-submit" >Submit Payment</button>
            
            </div>

        </form>
    </div>
</div>
@endsection
