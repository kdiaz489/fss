@extends('layouts.app')

@section('content')


    <div class="jumbotron-fluid jumbotron-ship">
            <div class="container">
              <h1 class="display-3">Book Your Shipment</h1>
              <hr class="my-4" style="background-color:white">
              <p class="lead">We offer shipping services to the Southwestern region of the United States. If you are interested in the quote that was generated for you, feel free to book the shipment with us below. </p>

        </div>
    </div>


          <!-- Confirm Data Modal -->
          <div class="modal fade confirm_data_Modal" action="" id="final_book_shipment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" data-backdrop="false" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" style="margin:auto">

                </div>
                <div class="modal-footer justify-content-center">

                    
                    @if(Auth::user()->credit == 'Approved')
                        
                        <input type="button" name="paywcredit" id="paywcredit" value="Book" class="btn btn-primary text-white bg-denim"/>
                    @elseif(Auth::user()->credit == 'Not Approved')
                        
                        <input type="button" name="creditApp" id="na_applycredit" value="Apply for Credit" class="btn btn-primary text-white bg-denim" />
                    @endif
                </div>
              </div>
            </div>
          </div>


        <div class="container" style="margin-top:2%; margin-bottom:0%;">
        <h4 class="text-center"><span style="color:orange">* </span>Required.</h4>
        </div>

         <form id = "final_book_shipment_form" class="shipquote_form" action="/ship" method="POST">
           <div class="container-fluid freight-quote-container">

            <div class="row" style="margin-top: 10px">
              <div class="col col-sm-12 bg-whitewash" style="padding:2%">
                <h5>Shipper</h5>

                <hr>
                <div class="form-row">

                
                        <div class="col-sm-6 col-12">
                          <label>Company Name <span style="color:orange">* </span></label>
                          <input type="text" name="orig_company" id="orig_company" class="form-control form-control-sm required"  placeholder="Name">
                          
                        </div>
                        <div class="col-sm-6 col-12">
                                <label>Street Address 1 <span style="color:orange">* </span></label>
                                <input type="text" class="form-control form-control-sm required" id="orig_address_01" name="orig_address_01" placeholder="Address 01">
                              </div>

                  </div>

                  <div class="form-row">

                        <div class=" col-lg-3 col-12">
                          <label>Street Address 2</label>
                          <input type="text" class="form-control form-control-sm" id="orig_address_02" name="orig_address_02" placeholder="Address 02 (Optional)">
                        </div>

                        <div class=" col-lg-3 col-12">
                            <label>City <span style="color:orange">* </span></label>
                            <input type="text" class="form-control form-control-sm required" id="orig_city" name="orig_city" placeholder="City">
                        </div>

                        <div class=" col-lg-3 col-12">
                            <label>State <span style="color:orange">* </span></label>
                            <input type="text" class="form-control form-control-sm required" id="orig_state" name="orig_state" placeholder="State">

                        </div>

                        <div class=" col-lg-3 col-12">
                            <label>Zip <span style="color:orange">* </span></label>
                            <input type="text" class="form-control form-control-sm required" id="orig_zip" name="orig_zip" placeholder="Zip/Postal Code">
                        </div>

                  </div>

                  <div class="form-row">



                        <div class=" col-lg-4 col-12">
                            <label>Contact Name</label>
                            <input type="text" class="form-control form-control-sm required" id="orig_cont_name" name="orig_cont_name" placeholder="Name">
                        </div>

                        <div class=" col-lg-4 col-12">
                            <label> Contact E-mail</label>
                            <input type="email" class="form-control form-control-sm required" id="orig_cont_email" name="orig_cont_email" placeholder="E-mail">
                        </div>

                        <div class=" col-lg-4 col-12">
                            <label>Contact Phone</label>
                            <input type="text" class="form-control form-control-sm required" id="orig_cont_phone" name="orig_cont_phone" placeholder="Phone Number">
                        </div>

                    </div>
                    

                    
                <div class="form-row">

                        
                        <div class="col-lg-6 col-12">
                            <label>Pickup Date</Label>
                            <input type="date" class="form-control form-control-sm required" id="orig_pickup_date" name="orig_pickup_date">
                        </div>


                        <div class=" col-lg-6 col-12">
                                <label>Location Type</label>
                                <select class="form-control form-control-sm required" id="orig_type" name="orig_type">
                                  <option value="Commercial">Commercial</option>
                                  <option value="Residential/Non-Commercial">Residential/Non-Commercial</option>
                                  <option value="Trade Show">Trade Show</option>
                                  <option value="Construction">Construction</option>
                                  <option value="Limited Access">Limited Access</option>
                                  <option value="Carrier Terminal">Carrier Terminal</option>
                                  <option value="Container Freight Station">Container Freight Station</option>
                                  <option value="Distribution Center">Distribution Center</option>
                                </select>
                            </div>

                </div>


                <div class="form-row justify-content-center">
                    <div class="col-sm-2">
                            <label>Dock</label>

                            <div class="small">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_dock" id="orig_dock" value="Yes" checked> Yes
                                        </label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_dock" id="orig_dock" value="No"> No
                                        </label>
                                    </div>
                                </div>
                    </div>

                    <div class="col-sm-2">
                            <label>Fork Lift</label>

                            <div class="small">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="Yes"> Yes
                                        </label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="No" checked> No
                                        </label>
                                    </div>
                                </div>
                    </div>

                    <div class="col-sm-2">
                            <label>Floor Stack</label>

                            <div class="small">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="Yes"> Yes
                                        </label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="No" checked> No
                                        </label>
                                    </div>
                                </div>
                    </div>


                    <div class="col-lg-2">
                            <label>Inside Pickup</label>

                            <div class="small">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_inside" id="orig_inside" value="Yes"> Yes
                                        </label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_inside" id="orig_inside" value="No" checked> No
                                        </label>
                                    </div>
                                </div>
                    </div>

                    <div class="col-lg-2">
                            <label>Lift Gate?</label>

                            <div class="small">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="Yes"> Yes
                                        </label>
                                    </div>
                                    
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="No" checked> No
                                        </label>
                                    </div>
                                </div>
                    </div>


            </div>

            <div class="form-row">
                <div class="col-lg-12">
                    <label for="">Additional Notes</label>
                    <textarea class="form-control form-control-sm" rows="5" id="dest_notes" placeholder="Notes (optional) "></textarea>
                </div>

            </div>


            </div> 
          </div> 
        </div> 


    

        <div class="container-fluid freight-quote-container">
                
                        <div class="row" style="margin-top: 10px">
                          <div class="col col-sm-12 bg-whitewash" style="padding:2%">
                            <h5>Receiver</h5>
            
                            <hr>
                            <div class="form-row">
            
                            
                                    <div class="col-lg-6 col-12">
                                      <label>Company Name <span style="color:orange">* </span></label>
                                      <input type="text" name="dest_company" id="dest_company" class="form-control form-control-sm required"  placeholder="Name">
                                      
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <label>Street Address 1 <span style="color:orange">* </span></label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_address_01" name="dest_address_01" placeholder="Address 01">
                                    </div>
            
                              </div>
            
                              <div class="form-row">
            
                            
                                    <div class="col-lg-3 col-12">
                                      <label>Street Address 2</label>
                                      <input type="text" class="form-control form-control-sm" id="dest_address_02" name="dest_address_02" placeholder="Address 02 (Optional)">
                                    </div>
            
                                    <div class="col-lg-3 col-12">
                                        <label>City <span style="color:orange">* </span></label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_city" name="dest_city" placeholder="City">
                                    </div>
            
                                    <div class="col-lg-3 col-12">
                                        <label>State <span style="color:orange">* </span></label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_state" name="dest_state" placeholder="State">
            
                                    </div>
            
                                    <div class="col-lg-3 col-12">
                                        <label>Zip <span style="color:orange">* </span></label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_zip" name="dest_zip" placeholder="Zip/Postal Code">
                                    </div>
            
                              </div>
            
                              <div class="form-row">
            
            
            
                                    <div class="col-lg-4 col-12">
                                        <label>Contact Name</label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_cont_name" name="dest_cont_name" placeholder="Name">
                                    </div>
            
                                    <div class="col-lg-4 col-12">
                                        <label> Contact E-mail</label>
                                        <input type="email" class="form-control form-control-sm required" id="dest_cont_email" name="dest_cont_email" placeholder="E-mail">
                                    </div>
            
                                    <div class="col-lg-4 col-12">
                                        <label>Contact Phone</label>
                                        <input type="text" class="form-control form-control-sm required" id="dest_cont_phone" name="dest_cont_phone" placeholder="Phone Number">
                                    </div>
            
                                </div>
                                
            
                                
                            <div class="form-row">
            
                                    
                                    <div class="col-lg-6 col-12">
                                        <label>Delivery Date</Label>
                                        <input type="date" class="form-control form-control-sm required" id="dest_pickup_date" name="dest_pickup_date">
                                    </div>
            
            
                                    <div class="col-lg-6 col-12">
                                            <label>Location Type</label>
                                            <select class="form-control form-control-sm required" id="dest_type" name="dest_type">
                                              <option value="Commercial">Commercial</option>
                                              <option value="Residential/Non-Commercial">Residential/Non-Commercial</option>
                                              <option value="Trade Show">Trade Show</option>
                                              <option value="Construction">Construction</option>
                                              <option value="Limited Access">Limited Access</option>
                                              <option value="Carrier Terminal">Carrier Terminal</option>
                                              <option value="Container Freight Station">Container Freight Station</option>
                                              <option value="Distribution Center">Distribution Center</option>
                                            </select>
                                        </div>
            
                            </div>
            
            
                            <div class="form-row justify-content-center mt-4">
                                <div class="form-group col-lg-2 col-12">
                                        <label>Dock</label>
            
                                        <div class="small">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_dock" id="dest_dock" value="Yes" checked> Yes
                                                    </label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_dock" id="dest_dock" value="No"> No
                                                    </label>
                                                </div>
                                            </div>
                                </div>
            
                                <div class="form-group col-lg-2 col-12">
                                        <label>Fork Lift</label>
            
                                        <div class="small">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="Yes"> Yes
                                                    </label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="No" checked> No
                                                    </label>
                                                </div>
                                            </div>
                                </div>
            
                                <div class="form-group col-lg-2 col-12">
                                        <label>Inside Delivery</label>
            
                                        <div class="small">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_inside" id="dest_inside" value="Yes"> Yes
                                                    </label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_inside" id="dest_inside" value="No" checked> No
                                                    </label>
                                                </div>
                                            </div>
                                </div>
            
                                <div class="form-group col-lg-2 col-12">
                                        <label>Lift Gate?</label>
            
                                        <div class="small">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="Yes"> Yes
                                                    </label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="No" checked> No
                                                    </label>
                                                </div>
                                            </div>
                                </div>
        
                                <div class="form-group col-lg-2 col-12">
                                        <label>App Required?</label>
            
                                        <div class="small">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_app_req" id="dest_app_req" value="Yes"> Yes
                                                    </label>
                                                </div>
                                                
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="dest_app_req" id="dest_app_req" value="No" checked> No
                                                    </label>
                                                </div>
                                            </div>
                                </div>
            
            
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12">
                                        <label for="">Additional Notes</label>
                                        <textarea class="form-control form-control-sm" rows="5" id="dest_notes" placeholder="Notes (optional) "></textarea>
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

                   <div class="col-lg-3 col-12">
                     <label>Number <span style="color:orange">* </span></label>
                     <input type="text" class="form-control form-control-sm required" name="no_of_pallets" id="no_of_pallets" placeholder="# of Items">
                  </div>


                   <div class="col-lg-3 col-12">
                     <label>Pack Type</label>

                     <select class="form-control form-control-sm required" name="prod_type" id="prod_type" placeholder="Pack Type">
                       <option value="Pallet">Pallet</option>
                       <option value="Bag">Bag</option>
                       <option value="Bale">Bale</option>
                       <option value="Box">Box</option>
                       <option value="Bundle">Bundle</option>
                       <option value="Carton">Carton</option>
                     </select>
                  </div>


                 <div class="col col-lg-3 col-12">
                   <label>Weight Per Pallet <span style="color:orange">* </span></label>
                   <input type="text" class="form-control form-control-sm required" name="weight_per_pallet" id="weight_per_pallet" placeholder="lbs">
                 </div>


                 <div class="col col-lg-3 col-12">
                   <label>Weight Total <span style="color:orange">* </span></label>
                   <input type="text" class="form-control form-control-sm required" name="tot_load_wt" id="tot_load_wt" placeholder="lbs">
                 </div>


                 </div>



                 <div class="form-row">
                        <div class="col-lg-3 col-12">
                            <label>Class</label>
                            <select class="form-control form-control-sm required" name="freight_class" id="freight_class" placeholder="Class Type">
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
                        </div>

                        <div class="col-lg-3 col-12">
                            <label>Description</label>
                            <input type="text" class="form-control form-control-sm" name="prod_desc" value= "" id="prod_desc" placeholder="Product Description">
                        </div>


                        <div class="col-lg-3 col-12">
                            <label>Dimensions (inches) <span style="color:orange">* </span></label>
                            <input type="text" class="form-control form-control-sm required" name="pallet_length" id="pallet_length" placeholder="L">
                            <input type="text" class="form-control form-control-sm required" name="pallet_width" id="pallet_width" placeholder="W">
                            <input type="text" class="form-control form-control-sm required" name="pallet_height" id="pallet_height" placeholder="H">
                        </div>

                        <div class="col col-lg-3 col-12">
                        <label>Value ($)</label>
                        <input type="text" class="form-control form-control-sm" id="prod_value" name="prod_value" placeholder="$ USD">
                        </div>

                 </div>






                 <div class="form-row m-auto">

                        <div class="col-lg-3 col-12">
                                <label>Hazardous</label>
    
                                <div class="small">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="prod_hazard" id="prod_hazard" value="Yes"> Yes
                                            </label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="prod_hazard" id="prod_hazard" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                        </div>

                        <div class="col-lg-3 col-12">
                                <label>Stackable</label>
    
                                <div class="small">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="prod_stackable" id="prod_stackable" value="Yes"> Yes
                                            </label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="prod_stackable" id="prod_stackable" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                        </div>

                        <div class="col-lg-3 col-12">
                                <label>Load Strap</label>
    
                                <div class="small">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="load_strap" id="load_strap" value="Yes"> Yes
                                            </label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="load_strap" id="load_strap" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                        </div>

                        <div class="col-lg-3 col-12">
                                <label>Load Block</label>
    
                                <div class="small">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="load_blck" id="load_blck" value="Yes"> Yes
                                            </label>
                                        </div>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="load_blck" id="load_blck" value="No" checked> No
                                            </label>
                                        </div>
                                    </div>
                        </div>


                 </div>


               </div>



             </div>
            </div>

             <div class="row justify-content-center">
                 <button type="submit" id="bookshipment" class="btn bg-denim text-white quote-btn">Book Shipment</button>
                 <br>
             </div>
            <div class="row justify-content-center" style="font-size:14px; width:35%; margin: 0 auto;">
                <strong>*Disclaimer</strong>All orders are processed immediately after payment acceptance. Product will ship within the constraints on dates provided by you,
                pending approval by FillStorShip. If any change to your shipment order arises, we will contact you via email or phone. Shipping charges are calculated and displayed via our quote generator. Additional charges may apply.

            </div>
           
           @csrf
         </form>



@endsection()
