@extends('layouts.app')

@section('content')
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron-fluid jumbotron-fil">
        <div class="container">
          <h1 class="font-weight-light">Submit your Fulfillment Request.</h1>
          <hr class="my-4" style="background-color:white">
          <p class="lead">Interested in having FillStorShip fulfill your orders? Submit a request below and we will begin the process with you as soon as possible.</p>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-light btn-sm" id="open-storage-quote" data-toggle="modal" data-target="#modalCenterFil">
            Fulfillment Request
          </button>

        </div>
      </div>

      <div class="container stor-container">
        <div class="container">
          <div class="row justify-content-center">

              <div class="col col-lg-12 col-12">
                <h1 class="font-weight-light text-center"><strong>Have you ever under or over-estimated a product launch?</strong></h1>
                <p class="stor-txt">
                Going too low and running out is stressful and costly with rush deliveries, rushed manufacturing and unhappy customers.
                Going too high would leave you with un-sold inventory, causing unbuilding kits or liquidating product at a loss.  You can put that scenario behind you …
                </p>
              </div>
            </div>
        </div>
      </div>



      <div class="container-fluid bg-whitewash py-5">
        <div class="container">
          <div class="row justify-content-center">
              <div class="col col-lg-6 col-12 align-self-center">
                <h1 class="font-weight-light"><strong>Our Solution</strong></h1>
                <p class="stor-txt">
                  FillStorShip offers turnkey solutions for your product. It’s in our name - Fulfillment, Storage and Shipping.
                  The big box models of distribution have changed. More and more small businesses are bringing their products to market quicker, more cost effective and direct to the consumer.
                  Our streamline process has combined Kitting and Assembly with Warehousing and Distribution by incorporating Ecommerce processing all in one place.
                </p>

              </div>

              <div class="col col-lg-6 col-12">
                <img src="img/warehouse-logistics.png" style="width: 95%; height: 95%">
              </div>

            </div>
        </div>
      </div>


      <div class="container-fluid stor-container-padding">

        <div class="container">
          <div class="row justify-content-center">

              <div class="col col-lg-12 col-12 ">
                <h1 class="font-weight-light text-center"><strong>Kitting Assembly</strong></h1>
                <p class="stor-txt">
                The upfront costs to fulfill and assemble kits can be expensive. Why not absorb that cost after the product is sold? Fillstorship combines our experience in manufacturing and warehousing with E-commerce order
                processing so your products and kits can be fulfilled during the E-commerce order process.
                The results are faster turn time to customer, reduced warehousing cost, reduced shrinkage loss, and less handling charges.

                </p>

              </div>
            </div>
        </div>

      </div>

      <div class="container-fluid stor-background2 stor-container-padding text-white">

        <div class="container">
          <div class="row justify-content-center">

              <div class="col col-lg-12 col-12 ">
                <h1 class="font-weight-light text-center" style="font-weight: 300;"><strong>How It Works</strong></h1>
                <p class="stor-txt">
                  We start by warehousing all the components that make up your complete product. This includes packaging, printed material, finished bulk product and items that would be included in the complete package.
                  Orders are received through your E-commerce driver and based on sales volume, we fulfill as needed, “On Demand” by pre-determined volumes that you can control.  The cost of fulfillment is billed after your products have been shipped.
                  Warehousing, fulfillment and distribution all wrapped up in detailed reports tracking inventory, sales trends and custom set alerts to advise when levels are low.  All customizable and scalable to your actual volumes.
                </p>

              </div>
            </div>
        </div>

      </div>









         <!-- Modal -->
         <div class="modal fade filModal" id="modalCenterFil" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitleFil" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <form id="fil-form">
                 <div class="modal-body" style="margin:auto">
                   <div class="container-modal">

                     <div class="form-row">

                       <div class="form-group col-lg-6 col-12">
                         <label>Company Name</label>
                         <input type="text" name="co-name" id="name" class="form-control required"  placeholder="Company Name">
                       </div>

                       <div class=" form-group col-lg-6 col-12">

                            <label>Contact Full Name</label>
                            <input type="text" name="contact-name" id="contact-name" class="form-control required"  placeholder="Contact Name">
                      </div>

                     </div>


                     <div class="form-row">

                       <div class="form-group col-lg-6 col-12">
                         <label>Contact Email</label>
                         <input type="text" name="contact-email" id="contact-email" class="form-control required"  placeholder="Contact Email">
                       </div>

                       <div class=" form-group col-lg-6 col-12">

                            <label>Contact Phone Number</label>
                            <input type="text" name="contact-phone" id="contact-phone" class="form-control required"  placeholder="Contact Phone">
                      </div>

                     </div>


                     <div class="form-row">

                       <div class="form-group col-lg-6 col-12">
                         <label>Kit or Product Name</label>
                         <input type="text" name="product-name" id="product-name" class="form-control required"  placeholder="Name">
                       </div>

                       <div class=" form-group col-lg-6 col-12">

                            <label>Product Type</label>
                            <input type="text" name="product-type" id="product-type" class="form-control required"  placeholder="Type">
                      </div>

                     </div>

                     <div class="form-row">
                       <div class="form-group col-lg-12 col-12">
                         <label>Quantity</label>
                         <input type="text" name="quantity" id="quantity" class="form-control required"  placeholder="Quantity">
                       </div>

                 </div>


                 <div class="form-row">

                     <div class=" form-group col-lg-12 col-12">

                       <label>Description</label>
                       <textarea class="form-control required" name="desc" id="desc" rows="3" placeholder="Description"></textarea>

                       </select>

                 </div>
             </div>

                </div>
              </div>

               <div class="modal-footer justify-content-center">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" id="fil-request-submit" name="fil-request-submit" class="btn btn-primary">Send Request</button>
               </div>
               @csrf
             </form>
             </div>
           </div>
         </div>
       

@endsection()
