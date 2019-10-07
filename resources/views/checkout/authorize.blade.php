<div class="flex-center position-ref full-height">
    <div class="container">
        <form class="cc_auth_form" id="cc_auth_form" action="{{ url('/checkout') }}" method="post">
            {{ csrf_field() }}
            <h3 class="text-center bg-denim text-white">Payment Information</h3>
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



            <h3 class="text-center mt-4 bg-denim text-white">Billing Address</h3>
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


            <div class="row justify-content-center mt-3">
                <button type="button" class="btn btn-primary bg-denim" name="cc-auth-submit" id="cc-auth-submit"
                    style="margin: 0 auto;">Submit Payment</button>
                    <br>
            </div>
            <div class="wait justify-content-center text-center"
                style="display:none;width:69px;height:89px;padding:2px; margin:auto;">
                <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64"
                    height="64" /><br>Loading...</div>
        </form>
    </div>
</div>