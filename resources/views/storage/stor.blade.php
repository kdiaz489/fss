@extends('layouts.app')

@section('content')

<div class="jumbotron-fluid jumbotron-storage">
        <div class="container">
          <h1 class="font-weight-light">Get your storage quote today.</h1>
          <hr class="my-4" style="background-color:white">
          <p class="lead">Need to store product at our facility? You can get an instant quote by filling out a form here on our site. Try it out today. Our price won't be matched.</p>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-light btn-sm" id="open-storage-quote" data-toggle="modal" data-target="#modalCenter">
            Instant Quote
          </button>

        </div>
      </div>

      <div class="container">
        <div class="container">
          <div class="row justify-content-center">

              <div class="col col-lg-6 col-12 align-self-center">

                <h1 class="font-weight-light"><strong>We store your inventory.</strong></h1>
                <p class="stor-txt">
                  We have designed our warehousing services to maximize your company's profit. We own and operate all of our fulfillment centers and help you strategically split and manage your inventory to reduce shipping costs and time in transit.
                  We'd love the opportunity to be both your company warehouse and your growth partner.
                </p>

              </div>

              <div class="col col-lg-6 col-12">
                <img src="img/warehouse.png" style="width: 95%; height: 95%">
              </div>

            </div>
        </div>
      </div>


      <div class="container-fluid stor-background1 stor-container-padding text-white">

        <div class="container">
          <div class="row justify-content-center">

              <div class="col col-lg-12 col-12 ">
                <h1 class="font-weight-light"><strong>Inventory Pricing</strong></h1>
                <p class="stor-txt">
                    FillStorShip's pricing is reflective of a total cost for a standard, storage request.
                    Standard fees for FillStorShip include receiving your inventory and warehousing your products.
                    We also offer special pricing for special projects.

                    If you have unique needs, FillStorShip can accommodate your business at an additional cost. All quotes are customized for each customer.
                    Ask us how we can make it work for you!
                </p>
              </div>
            </div>
        </div>

      </div>

         <!-- Modal -->
         <div class="modal fade storModal" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>
               <form id="storage-quote-form">
                 <div class="modal-body" style="margin:auto">
                   <div class="container-modal text-center">
                    <span style="color:orange">* </span> Fill in all fields. If one does not apply, type in 0.
                    <br>
                    <br>
                     <div class="form-row">

                       <div class="form-group col-lg-6 col-12">
                         <label># of Pallets</label>
                         <input type="text" name="num-pallets" id="num-pallets" class="form-control required"  placeholder="Total">
                       </div>

                       <div class=" form-group col-lg-6 col-12">

                            <label>Dimensions (in inches)</label>
                            <input type="text" name="length" id="length" class="form-control required"  placeholder="Length">
                            <input type="text" name="width" id="width" class="form-control required"  placeholder="Width">
                            <input type="text" name="height" id="height" class="form-control required"  placeholder="Height">
                            <div>{{$errors->first('message')}}</div>
                      </div>

                     </div>

                     <div class="form-row">
                       <div class="form-group col-lg-6 col-12">
                         <label>Weight</label>
                         <input type="text" name="weight" id="weight" class="form-control required"  placeholder="Weight">
                         
                       </div>

                         <div class=" form-group col-lg-6 col-12">

                           <label>Stackable</label>
                           <select class="form-control required" name="stackable" id="stackable" placeholder="Is stackable">
                             <option value="none" disabled selected hidden>Choose</option>
                             <option value="Yes">Yes</option>
                             <option value="No">No</option>
                           </select>

                           </select>

                     </div>
                 </div>


                 <div class="form-row">

                   <div class="form-group col-lg-6 col-12">
                       <label>Duration (in months)</label>
                       <input type="text" name="duration" id="duration" class="form-control required"  placeholder="Duration">

                   </div>

                 </div>
                </div>
              </div>

               <div class="modal-footer justify-content-center">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" id="generate-storage-quote" name="storage-quote-submit" class="btn btn-primary">Quick Quote</button>
               </div>
               @csrf
             </form>
             </div>
           </div>
         </div>
       </div>

@endsection

