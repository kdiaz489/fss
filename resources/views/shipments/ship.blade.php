@extends('layouts.app')

@section('content')


    <div class="jumbotron-fluid jumbotron-ship">
            <div class="container">
              <h1 class="display-3">Shipping Quote</h1>
              <hr class="my-4" style="background-color:white">
              <p class="lead">We offer shipping services to the Southwestern region of the United States. Try out our shipping quote generator to find your cost for shipping with FillStorShip. </p>

            </div>
          </div>


          <!-- Confirm Data Modal -->
          <div class="modal fade shipModal" action="insert.php" id="confirm_data_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalCenterTitle">Your Quote</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="margin:auto">
                  <p>Your quote is for the following amount: </p>
                  <p id="quoteTotal"></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>


                    <input type="button" name="creditApp" id="doCredit" value="Apply for Credit" class="btn btn-primary" />




                </div>
              </div>
            </div>
          </div>


          <div class="container" style="margin-top:2%; margin-bottom:0%;">
            <h5><small>*Fill in all fields. If does not apply, type in 0 or N/A.</small></h5>
          </div>

         <form id = "insert_form" action="ship" method="POST">
           <div class="container-fluid freight-quote-container">

            <div class="row" style="margin-top: 10px">

              <div class="col col-lg-12 col-sm-12 col-12 bg-whitewash" style="padding:2%">
                <h5>Shipper</h5>

                <hr>


                <div class="form-row">

                        <div class=" form-group col-lg-2 col-12">
                          <label>Company Name</label>
                          <input type="text" name="orig_company" id="orig_company" class="form-control required"  placeholder="Name">
                          <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                          <label>Street Address 1</label>
                          <input type="text" class="form-control required" id="orig_address_01" name="orig_address_01" placeholder="Address">
                          <div style="font-weight: 700; color:red">{{$errors->first('street address')}}</div>
                        </div>


                        <div class=" form-group col-lg-2 col-12">
                          <label>Street Address 2</label>
                          <input type="text" class="form-control" id="orig_address_02" name="orig_address_02" placeholder="Address (Optional)">
                          
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                          <label>City</label>
                          <input type="text" class="form-control required" id="orig_city" name="orig_city" placeholder="City">
                          <div style="font-weight: 700; color:red">{{$errors->first('city')}}</div>
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                          <label>State</label>
                          <input type="text" class="form-control required" id="orig_state" name="orig_state" placeholder="State">
                          <div style="font-weight: 700; color:red">{{$errors->first('state')}}</div>
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                          <label>Zip</label>
                          <input type="text" class="form-control required" id="orig_zip" name="orig_zip" placeholder="Zip/Postal Code">
                          <div style="font-weight: 700; color:red">{{$errors->first('zip')}}</div>
                        </div>

                  </div>

                  <div class="form-row">

                      <div class=" form-group col-lg-2 col-12">
                          <label>Contact Name</label>
                          <input type="text" class="form-control required" id="orig_cont_name" name="orig_cont_name" placeholder="Name">
                          <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                            <label> Contact E-mail</label>
                            <input type="email" class="form-control required" id="orig_cont_email" name="orig_cont_email" placeholder="E-mail">
                            <div style="font-weight: 700; color:red">{{$errors->first('email')}}</div>
                        </div>


                        <div class=" form-group col-lg-2 col-12">

                            <label>Contact Phone</label>
                            <input type="text" class="form-control required" id="orig_cont_phone" name="orig_cont_phone" placeholder="Phone Number">
                            <div style="font-weight: 700; color:red">{{$errors->first('phone')}}</div>
                          </div>

                          <div class=" form-group col-lg-2 col-12">
                              <label>Pickup Date</Label>
                              <input type="date" class="form-control" id="orig_pickup_date" name="orig_pickup_date">
                              <div style="font-weight: 700; color:red">{{$errors->first('pickup date')}}</div>
                            </div>

                            <div class=" form-group col-lg-2 col-12">
                                <label>Location Type</label>
                                <select class="form-control required" id="orig_type" name="orig_type">
                                  <option value="none" disabled selected hidden>Choose</option>
                                  <option value="Commercial">Commercial</option>
                                  <option value="Residential/Non-Commercial">Residential/Non-Commercial</option>
                                  <option value="Trade Show">Trade Show</option>
                                  <option value="Construction">Construction</option>
                                  <option value="Limited Access">Limited Access</option>
                                  <option value="Carrier Terminal">Carrier Terminal</option>
                                  <option value="Container Freight Station">Container Freight Station</option>
                                  <option value="Distribution Center">Distribution Center</option>
                                </select>
                                <div style="font-weight: 700; color:red">{{$errors->first('location type')}}</div>
                            </div>

                            <div class=" form-group col-lg-2 col-12">
                                <label>Dock</label>
                                <select class="form-control required" id="orig_dock" name="orig_dock">
                                  <option value="none" disabled selected hidden>Choose</option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                                <div style="font-weight: 700; color:red">{{$errors->first('dock')}}</div>
                              </div>

                </div>
                <div class="form-row">

                    <div class=" form-group col-lg-2  col-12">
                        <label>Forklift</label>
                        <select class="form-control required" id="orig_frklft" name="orig_frklft">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('forklift')}}</div>
                     </div>


                     <div class=" form-group col-lg-2 col-12">
                        <label>FlrStck</label>
                        <select class="form-control required" id="orig_flrstk" name="orig_flrstk">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('Floorstack')}}</div>
                     </div>


                     <div class=" form-group col-lg-2 col-12">
                        <label>Inside Pickup</label>
                        <select class="form-control required" id="orig_inside" name="orig_inside">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('Inside Pickup')}}</div>
                      </div>

                      <div class=" form-group col-lg-4 col-12">
                          <label>Liftgate Required?</label>
                          <select class="form-control required" id="orig_lfgt" name="orig_lfgt">
                            <option value="none" disabled selected hidden>Choose</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                          <div style="font-weight: 700; color:red">{{$errors->first('Liftgate Required')}}</div>
                        </div>

                        <div class=" form-group col-lg-8 col-12">
                            <label>Additional Notes</Label>
                            <input type="text" class="form-control" id="orig_notes" name="orig_notes" value= "_" placeholder="Notes (Optional)">
                        </div>

              </div>
            </div>


          </div>
        </div>


        <div class="container-fluid freight-quote-container">

            <div class="row" style="margin-top: 40px">

              <div class="col col-lg-12 col-sm-12 col-12 bg-whitewash" style="padding:2%">
                <h5>Receiver</h5>
                <hr>

                <div class="form-row">

                    <div class=" form-group col-lg-2 col-12">
                        <label>Company Name</label>
                        <input type="text" class="form-control required" name="dest_company" id="dest_company" placeholder="Name">
                        <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                     </div>

                     <div class=" form-group col-lg-2 col-12">
                        <label>Street Address 1</label>
                        <input type="text" class="form-control required" name="dest_address_01" id="dest_address_01" placeholder="Address">
                        <div style="font-weight: 700; color:red">{{$errors->first('street address')}}</div>
                      </div>


                      <div class=" form-group col-lg-2 col-12">
                          <label>Street Address 2</label>
                          <input type="text" class="form-control" name="dest_address_02" id="dest_address_02" placeholder="Address (Optional)">
                          
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                            <label>City</label>
                            <input type="text" class="form-control required" name="dest_city" id="dest_city" placeholder="City">
                            <div style="font-weight: 700; color:red">{{$errors->first('city')}}</div>
                         </div>

                         <div class=" form-group col-lg-2 col-12">
                            <label>State</label>
                            <input type="text" class="form-control required" name="dest_state" id="dest_state" placeholder="State">
                            <<div style="font-weight: 700; color:red">{{$errors->first('state')}}</div>
                          </div>

                          <div class=" form-group col-lg-2 col-12">
                              <label>Zip</label>
                              <input type="text" class="form-control required" name="dest_zip" id="dest_zip" placeholder="Zip/Postal">
                              <div style="font-weight: 700; color:red">{{$errors->first('zip')}}</div>
                            </div>

                  </div>

                  <div class="form-row">

                      <div class=" form-group col-lg-2 col-12">
                          <label>Contact Name</label>
                          <input type="text" class="form-control required" name="dest_cont_name" id="dest_cont_name" placeholder="Name">
                          <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                       </div>

                       <div class=" form-group col-lg-2 col-12">
                          <label>Contact E-mail</label>
                          <input type="text" class="form-control required" name="dest_cont_email" id="dest_cont_email" placeholder="E-mail">
                          <div style="font-weight: 700; color:red">{{$errors->first('email')}}</div>
                       </div>

                       <div class=" form-group col-lg-2 col-12">
                          <label>Contact Phone</label>
                          <input type="text" class="form-control required" name="dest_cont_phone" id="dest_cont_phone" placeholder="Phone Number">
                          <div style="font-weight: 700; color:red">{{$errors->first('phone')}}</div>
                       </div>


                       <div class=" form-group col-lg-2 col-12">
                          <label>Pickup Date</Label>
                          <input type="date" class="form-control" name="dest_pickup_date" id="dest_pickup_date">
                          <div style="font-weight: 700; color:red">{{$errors->first('date')}}</div>
                        </div>

                        <div class=" form-group col-lg-2 col-12">
                            <label>Location Type</label>
                            <select class="form-control required" name="dest_type" id="dest_type">
                              <option value="none" disabled selected hidden>Choose</option>
                              <option value="Commercial">Commercial</option>
                              <option value="Residential/Non-Commercial">Residential/Non-Commercial</option>
                              <option value="Trade Show">Trade Show</option>
                              <option value="Construction">Construction</option>
                              <option value="Limited Access">Limited Access</option>
                              <option value="Carrier Terminal">Carrier Terminal</option>
                              <option value="Container Freight Station">Container Freight Station</option>
                              <option value="Distribution Center">Distribution Center</option>
                            </select>
                            <div style="font-weight: 700; color:red">{{$errors->first('location type')}}</div>
                         </div>

                         <div class=" form-group col-lg-2 col-12">
                            <label>Dock</label>
                            <select class="form-control required" name="dest_dock" id="dest_dock">
                              <option value="none" disabled selected hidden>Choose</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>
                            <div style="font-weight: 700; color:red">{{$errors->first('dock')}}</div>
                         </div>

                </div>
                <div class="form-row">

                    <div class=" form-group col-lg-4 col-12">
                        <label>Forklift</label>
                        <select class="form-control required" name="dest_frklft" id="dest_frklft">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('forklift')}}</div>
                     </div>


                     <div class=" form-group col-lg-4 col-12">
                        <label>Liftgate Required?</label>
                        <select class="form-control required" name="dest_lfgt" id="dest_lfgt">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('liftgate')}}</div>
                     </div>


                     <div class=" form-group col-lg-4 col-12">
                        <label>Inside Delivery</label>
                        <select class="form-control required" name="dest_inside" id="dest_inside">
                          <option value="none" disabled selected hidden>Choose</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                        <div style="font-weight: 700; color:red">{{$errors->first('inside delivery')}}</div>
                      </div>

                      <div class=" form-group col-lg-4 col-12">
                          <label>Appointment Required</label>
                          <select class="form-control required" name="dest_app_req" id="dest_app_req">
                            <option value="none" disabled selected hidden>Choose</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                          </select>
                          <div style="font-weight: 700; color:red">{{$errors->first('app required?')}}</div>
                       </div>

                       <div class=" form-group col-lg-8 col-12">
                          <label>Additional Notes</label>
                          <input type="text" name="dest_notes" id="dest_notes" value= "_" class="form-control" placeholder="Notes (Optional)">
                          <div style="font-weight: 700; color:red">{{$errors->first('name')}}</div>
                       </div>

              </div>
            </div>


          </div>
        </div>


        <div class="container-fluid freight-quote-container">
             <div class="row" style="margin-top: 40px">

               <div class="col col-lg-12 col-sm-12 col-12 bg-whitewash text-gunmetal" style="padding:2%">
                 <h5>Load Details</h5>
                 <hr>

                 <div class="form-row">

                   <div class=" form-group col-lg-3 col-12">
                     <label>Number</label>
                     <input type="text" class="form-control required" name="no_of_pallets" id="no_of_pallets" placeholder="# of Items">
                     <div style="font-weight: 700; color:red">{{$errors->first('number')}}</div>
                  </div>


                   <div class=" form-group col-lg-3 col-12">
                     <label>Pack Type</label>

                     <select class="form-control required" name="prod_type" id="prod_type" placeholder="Pack Type">
                       <option value="none" disabled selected hidden>Choose</option>
                       <option value="Pallet">Pallet</option>
                       <option value="Bag">Bag</option>
                       <option value="Bale">Bale</option>
                       <option value="Box">Box</option>
                       <option value="Bundle">Bundle</option>
                       <option value="Carton">Carton</option>
                     </select>
                     <div style="font-weight: 700; color:red">{{$errors->first('pack type')}}</div>
                  </div>


                 <div class="col col-lg-3 col-12">
                   <label>Weight Per Pallet</label>
                   <input type="text" class="form-control required" name="weight_per_pallet" id="weight_per_pallet" placeholder="lbs">
                   <div style="font-weight: 700; color:red">{{$errors->first('weight')}}</div>
                 </div>


                 <div class="col col-lg-3 col-12">
                   <label>Weight Total</label>
                   <input type="text" class="form-control required" name="tot_load_wt" id="tot_load_wt" placeholder="lbs">
                   <div style="font-weight: 700; color:red">{{$errors->first('weight total')}}</div>
                 </div>


                 </div>



                 <div class="form-row">
                   <div class=" form-group col-lg-3 col-12">
                       <label>Class</label>
                       <select class="form-control required" name="freight_class" id="freight_class" placeholder="Class Type">
                         <option value="none" disabled selected hidden>Choose</option>
                         <option value="50">50</option>
                         <option value="55">55</option>
                         <option value="60">60</option>
                         <option value="65">65</option>
                         <option value="70">70</option>
                         <option value="77.5">77.5</option>
                         <option value="85">85</option>
                         <option value="92.5">92.5</option>
                         <option value="100">100</option>
                         <option value="110">110</option>
                         <option value="125">125</option>
                         <option value="150">150</option>
                         <option value="175">175</option>
                         <option value="200">200</option>
                         <option value="250">250</option>
                         <option value="300">300</option>
                         <option value="400">400</option>
                         <option value="500">500</option>
                   </select>
                   <div style="font-weight: 700; color:red">{{$errors->first('class type')}}</div>
                 </div>

                   <div class=" form-group col-lg-3 col-12">
                     <label>Description</label>
                     <input type="text" class="form-control" name="prod_desc" value= "_" id="prod_desc" placeholder="Product Description (Optional)">
                     <div style="font-weight: 700; color:red">{{$errors->first('description')}}</div>
                  </div>


                  <div class=" form-group col-lg-3 col-12">
                    <label>Dimensions (inches)</label>
                    <input type="text" class="form-control required" name="pallet_length" id="pallet_length" placeholder="L">
                    <input type="text" class="form-control required" name="pallet_width" id="pallet_width" placeholder="W">
                    <input type="text" class="form-control required" name="pallet_height" id="pallet_height" placeholder="H">
                    <div style="font-weight: 700; color:red">{{$errors->first('dimensions')}}</div>
                 </div>

                 <div class="col col-lg-3 col-12">
                   <label>Value ($)</label>
                   <input type="text" class="form-control" id="prod_value" name="prod_value" placeholder="$ USD">
                   <div style="font-weight: 700; color:red">{{$errors->first('value')}}</div>
                 </div>

                 </div>






                 <div class="form-row">
                   <div class=" form-group col-lg-3 col-12">
                     <label>Hazardous?</label>
                     <select class="form-control" name="prod_hazard" id="prod_hazard">
                       <option value="none" disabled selected hidden>Choose</option>
                       <option value="Yes">Yes</option>
                       <option value="No">No</option>
                     </select>
                     <div style="font-weight: 700; color:red">{{$errors->first('hazardous')}}</div>
                 </div>

                   <div class=" form-group col-lg-3 col-12">
                     <label>Stackable?</label>
                     <select class="form-control" name="prod_stackable" id="prod_stackable" placeholder="stackable">
                       <option value="none" disabled selected hidden>Choose</option>
                       <option value="Yes">Yes</option>
                       <option value="No">No</option>
                     </select>
                     <div style="font-weight: 700; color:red">{{$errors->first('stackable')}}</div>
                  </div>

                  <div class=" form-group col-lg-3 col-12">
                    <label>Load Strap</label>
                    <select class="form-control required" name="load_strap" id="load_strap" placeholder="stackable">
                      <option value="none" disabled selected hidden>Choose</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>
                    <div style="font-weight: 700; color:red">{{$errors->first('load strap')}}</div>
                 </div>

                 <div class=" form-group col-lg-3 col-12">
                   <label>Load Blck</label>
                   <select class="form-control required" name="load_blck" id="load_blck" placeholder="stackable">
                     <option value="none" disabled selected hidden>Choose</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                   </select>
                   <div style="font-weight: 700; color:red">{{$errors->first('load block')}}</div>

                </div>

                 </div>


               </div>



             </div>
            </div>

             <div class="row justify-content-center">
                 <button type="button" id="presubmit" class="btn bg-denim text-white quote-btn" >Get Quote</button>
             </div>

           </div>
           @csrf
         </form>



@endsection()
