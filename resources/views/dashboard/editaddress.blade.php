
@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">

            <form class="update-form" id="new-address-form" action="" method="">
      
               <div class="row justify-content-md-center">
      
                    <div class=" form-group col-md-12">
                        <h5 class="">Street Address</h5>
                        <input type="text" name="street-address" class="form-control form-control-sm required mb-4" style="border-style: none none solid none;" placeholder="">
                        <h5 class="">City</h5>
                        <input type="text" name="city" class="form-control form-control-sm required mb-4" style="border-style: none none solid none;" placeholder="">
                        <h5 class="">State</h5>
                        <input type="text" name="state" class="form-control form-control-sm required mb-4" style="border-style: none none solid none;" placeholder="">
                        <h5 class="">Zip</h5>
                        <input type="text" name="zip" class="form-control form-control-sm required mb-4" style="border-style: none none solid none;" placeholder="">

                    </div>
      
                </div>
                <div class="row justify-content-md-center">
                        <button class = "btn btn-link btn-sm edit-submit" type="button" id="newaddress-submit" name="edit-submit" style="font-weight:700;">Submit</button>
                    </div>

            @csrf
            </form>
      </div>
    @endif
