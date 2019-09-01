<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landingpage.css') }}" rel="stylesheet">
</head>
<body>

@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">

        <div class="row justify-content-center">
          <p class="about-text">Apply For Credit</p>
        </div>
      
            <form class="signup" id="credit-form" action="" method="">
      
               <div class="form-row">
      
                 <div class=" form-group col-lg-6 col-12">
      
                      <label>Cardholder Name</label>
                      <input type="text" name="name" class="form-control"  placeholder="Name">
                </div>
      
      
               <div class=" form-group col-lg-6 col-12">
      
                    <label>Billing Address</label>
                    <input type="text" name="billingaddress" class="form-control"  placeholder="Billing Address">
              </div>
            </div>
      
            <div class="form-row">
      
              <div class="form-group col-lg-6 col-12">
                <label>City</label>
                <input type="text" name="city" class="form-control"  placeholder="City">
              </div>
      
                <div class=" form-group col-lg-6 col-12">
      
                  <label>State</label>
                  <input type="text" name="state" class="form-control"  placeholder="State">
                </div>
      
            </div>
      
      
              <div class="form-row">
      
                <div class="form-group col-lg-6 col-12">
                    <label>Zip</label>
                    <input type="text" name="zip" class="form-control"  placeholder="Zip">
                </div>
      
                <div class="form-group col-lg-6 col-12">
                  <label>E-mail</label>
                  <input type="email" name="email" class="form-control"  placeholder="E-mail">
                </div>
      
              </div>
      
              <div class="form-row">
      
                <div class="form-group col-lg-6 col-12">
                    <label>Account Number</label>
                    <input type="text" name="acc" class="form-control"  placeholder="Acc. Num">
                </div>
      
                <div class="form-group col-lg-6 col-12">
                  <label>Exp. Date</label>
                  <input type="month" name="date" class="form-control"  placeholder="EXP Date">
                </div>
      
              </div>
      
      
              <div class="form-row">
      
                <div class="form-group col-lg-6 col-12">
                    <label>Card Type</label>
                    <select class="form-control" name="card-type">
                      <option value="none" disabled selected hidden>Choose</option>
                      <option value="Visa">Visa</option>
                      <option value="Amex">Amex</option>
                      <option value="MasterCard">MasterCard</option>
                      <option value="Discover">Discover</option>
                    </select>
                </div>
      
                <div class="form-group col-lg-6 col-12">
                  <label>CVC</label>
                  <input type="text" name="cvc" class="form-control"  placeholder="CVC">
                  
                </div>
      
              </div>
      
            <div class="form-row">
              <div class="col-lg-12 col-12 justify-content-center" style="padding-top:3%; padding-bottom:3%">
                    @csrf
                <button class = "btn btn-primary" type="button" id="applyforcredit-submit" name="credit-submit">Submit Application</button>
      
              </div>
            </div>
      
            </form>
      </div>
    @endif

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/myjs.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
</body>
</html>