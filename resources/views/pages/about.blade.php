@extends('layouts.app')

@section('content')
<div class="jumbotron-fluid jumbotron-about">
        <div class="container">
        </div>
      </div>


     <div class="container py-5" style="margin-top:2%">

       <div class="row justify-content-center">
         <div class="col-lg-6 col-12">
           <h1 class="text-gunmetal display-3">About FillStorShip</h1>

         </div>

         <div class="col-lg-6 col-12 ">
           <p><strong>FillStorShip</strong> is providing manufacturing experience to create turnkey solutions including fulfillment, warehousing, and distribution via e-commerce solutions in one place.  Our goal is to allow companies a place to launch new products and grow their business, while staying focused on their product.  We will handle the fulfillment and distribution.  As many big box retailers close their doors, more are opening for small businesses.  You can reach new customers through social media outlets and the new storefront is your webpage. Instagram, Facebook, or whatever channels are used to get attention to your product can result in sales directly from your webpage.
            Our experience in manufacturing has showed us the success and errors of others, and we have learned to be efficient, cost effective with environmentally cautious practices.  It’s the localized feel of your farmers market going from farm to fork, and we are now in a manufacturer direct to consumer market.
           </p>
           <p><strong>Founded: </strong>2017</p>
           <p><strong>Fulfillment Coverage: </strong> All 50 U.S states</p>
           <p><strong>Shipping Coverage: </strong> Southwestern United States</p>
           <p><strong>Storage Location: </strong> Ontario, California and La Verne, California</p>

         </div>
       </div>
      </div>


      <div class="container py-5" style="margin-top:2%">

        <div class="row justify-content-center">
          <div class="col-lg-6 col-12">
            <h1 class="text-gunmetal display-3">What Makes us Unique?</h1>

          </div>

          <div class="col-lg-6 col-12 ">
            <p>
              Fillstorship combines our experience in manufacturing and warehousing with E-commerce order processing so your products and kits can be fulfilled during the E-commerce order process.
              The results are faster turn time to customer, reduced warehousing cost, reduced shrinkage loss, and less handling charges. FillStorShip also caters to the smaller start-up business. There is  no minimum monthly requirements, experience in manufacturing and distribution, assist in development and processes for your product, an extension of your business without the costs of your own warehouse and shipping departments.

            </p>
          </div>
        </div>
       </div>





      <div class="container-fluid bg-whitewash py-5">
        <div class="container px-5">
          <div class="text-center py-5">
            <h1 class="text-gunmetal display-4">Our Proud Customers</h1>
          </div>
            <div class="row" style="padding-top:2% ">
              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid" src="{{asset('img/colorproof-logo.png')}}" style="width:200px ; height: 100px" >
              </div>
              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid bg-white" src="{{asset('img/easyday-logo.png')}}" style="width:200px ; height: 100px" >
              </div>
              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid" src="{{asset('img/shebd-logo.png')}}" style="width:200px ; height: 100px" >
              </div>
              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid bg-white" src="{{asset('img/oliveandjune-logo.png')}}" style="width:200px ; height: 100px">
              </div>

              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid" src="{{asset('img/whitemountainimaging-logo.jpg')}}"style="width:200px ; height: 100px" >
              </div>
              <div class="col-lg-2 col-12 mb-4 text-center">
                <img class="img-fluid" src="{{asset('img/rodanfields-logo.jpeg')}}"style="width:200px ; height: 100px" >
              </div>
      </div>
      <div class="row">
          <div class="col-lg-2 col-sm-4 mb-4 text-center">
            <img class="img-fluid" src="{{asset('img/algenist-logo.png')}}" style="width:200px ; height: 100px" >
          </div>
          <div class="col-lg-2 col-sm-4 mb-4 text-center">
              <img class="img-fluid bg-white" src="{{asset('img/slmd-logo.jpg')}}" style="width:200px ; height: 100px" >
            </div>
            <div class="col-lg-2 col-sm-4 mb-4 text-center">
              <img class="img-fluid" src="{{asset('img/yoursuperfoods-logo.jpg')}}" style="width:200px ; height: 100px" >
            </div>
            <div class="col-lg-2 col-sm-4 mb-4 text-center">
              <img class="img-fluid bg-white" src="{{asset('img/avery-logo.png')}}" style="width:200px ; height: 100px">
            </div>

            <div class="col-lg-2 col-sm-4 mb-4 text-center">
              <img class="img-fluid" src="{{asset('img/cenveo-logo.jpg')}}"style="width:200px ; height: 100px" >
            </div>
            <div class="col-lg-2 col-sm-4 mb-4 text-center">
              <img class="img-fluid" src="{{asset('img/essentialoxygen-logo.png')}}"style="width:200px ; height: 100px" >
            </div>

    </div>
  </div>
</div>




@endsection
