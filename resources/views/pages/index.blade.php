@extends('layouts.app')

@section('content')
    <div class="jumbotron-fluid jumbotron-home">
        <div class="container">
          <h1 class="font-weight-light text-break">Welcome to FillStorShip</h1>
          <hr class="my-4" style="background-color:white">
          <p class="lead">Fillstorship combines our experience in manufacturing and warehousing with E-commerce order processing so your products and kits can be fulfilled during the E-commerce order process.
             The results are faster turn time to customer, reduced warehousing cost, reduced shrinkage loss, and less handling charges</p>
        </div>
      </div>

      <!-- Flash Alerts Begin -->

      @include('partials.alerts')
      
      <!-- Flash Alerts Ends -->

      <div class="services-container container w-55 m-auto">
          <section id="process" class="process">
            <div class="container-fluid container-fluid-max">
              <div class="row text-center">
                <div class="col-12">
                  <h2 class="text-gunmetal font-weight-light mb-0">Our Services</h2>
                  <br>
                  <br>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-box-open fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Fulfillment</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-warehouse fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Storage</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-shipping-fast fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Shipping</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-clipboard-list fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Kitting + Assembly</h3>
                </div>
              </div>

              <div class="row text-center">
                <div class="col-12 pb-4">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-lightbulb fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Packaging Solutions</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-globe fa-stack-1x text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">E-commerce Processing</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-truck-loading fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Distribution</h3>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                  <span class="fa-stack fa-2x">
                    <!--<i class="fas fa-circle fa-stack-2x text-frenchblue"></i>-->
                    <i class="fas fa-handshake fa-stack-1x fa-sm text-frenchblue"></i>
                  </span>
                  <h3 class="mt-3 services-h3 font-weight-light">Consulting</h3>
                </div>

              </div>
            </div>
          </section>
          </div>




          <section id="" class=" bg-whitewash text-gunmetal">
            <div class="row no-gutters">

              <div class="col-12 col-md-6 d-flex align-items-center order-1 order-md-0">
                <div class="left-text">
                  <h2 class="font-weight-light">Fulfillment</h2>
                  <p>FillStorShip warehouses all the components that make up your complete product.
                    Orders are received through your Ecommerce driver and based on sales volume, we fulfill as needed, “On Demand” by pre-determined volumes that you can control.
                    Warehousing, fulfillment and distribution are all wrapped up in detailed reports tracking inventory, sales trends and custom set alerts to advise when levels are low.
                    </p>
                  <a class="btn bg-denim text-white" href="/fil" role="button">Read More</a>
                </div>
              </div>
              <div class="col-12 col-md-6 order-0 order-md-1">
                <div class="vh-75 cover fullfillment-img" style="background-image: url('/img/shipping.JPG');"></div>
              </div>
              <div class="col-12 col-md-6 order-2">
                <div class="vh-75 cover storage-img" style="background-image: url('/img/pallettes.JPG');"></div>
              </div>
              <div class="col-12 col-md-6 d-flex align-items-center order-3 bg-whitewash text-gunmetal">
                <div class="right-text">
                  <h2 class="font-weight-light">Storage</h2>
                  <p>FillStorShip provides optimal warehousing spaces that are modern, efficient, sanitation-certified and securely monitored for our customer’s inventory.</p>
                  <a class="btn bg-denim text-white" href="/stor" role="button">Read More</a>
                </div>
              </div>

              <div class="col-12 col-md-6 d-flex align-items-center order-5 order-md-3">
                <div class="left-text">
                  <h2 class="font-weight-light">Shipping</h2>
                  <p>FillStorShip enables you to maximize efficiency, maintain visibility, and reduce cost. Our shipping coverage extends to the entire Southwestern U.S.
                  Products we ship for our customers include beauty care, wellness and healthcare, industrial supplies, pre-packaged food products, limited quantity hazardous materials, and much more.</p>
                  <a class="btn bg-denim text-white" href="/ship" role="button">Read More</a>
                </div>
              </div>
              <div class="col-12 col-md-6 order-4 order-md-4">
                <div class="vh-75 cover shipping-img" style="background-image: url('/img/forklift.jpg');"></div>
              </div>

            </div>
          </section>

            <section id="request-quote" class="py-5  request-quote bg-denim text-white">
            <div class="container-fluid container-fluid-max">
              <div class="row justify-content-center">
                <div class="col-12 col-md-auto py-3 text-center text-white">
                  <h2 class="mb-0 font-weight-light">Ready to start your business journey with FillStorShip?</h2>
                  <p class="mb-0 h4 font-weight-light">Get in touch today!</p>
                </div>
                <div class="col-12 col-md-auto d-flex justify-content-center align-items-center">
                  <a class="btn bg-orange text-white font-weight-light" href="/stor" role="button">
                    Request a Quote
                    <i class="ml-1 fas fa-hand-point-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </section>

@endsection
