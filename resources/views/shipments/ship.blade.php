@extends('layouts.app')

@section('content')


<div class="jumbotron-fluid jumbotron-ship">
  <div class="container">
    <h1 class="font-weight-light">Shipping Quote</h1>
    <hr class="my-4" style="background-color:white">
    <p class="lead">We offer shipping services to the Southwestern region of the United States. Try out our shipping
      quote generator to find your cost for shipping with FillStorShip. </p>

  </div>
</div>


<!-- Confirm Data Modal -->
<div class="modal fade shipModal" action="insert.php" id="confirm_data_Modal" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin:auto">

      </div>

      <div class="modal-footer">
        <div class="m-auto">
          @guest
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="button" href="/register" name="register" id="register" value="Register"
            class="btn btn-primary" />
          @endguest

          @auth
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="bookshipment_auth" class="btn bg-denim text-white book-btn">Book</button>
          @endauth
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Confirm Data Modal Ends -->


<div class="container" style="margin-top:2%; margin-bottom:0%;">
  <h3 class="text-center"><small><span style="color:orange">*</span> required for quote</small></h3>
</div>

<form id="insert_form" class="shipquote_form" action="ship" method="POST">
  <div class="container-fluid freight-quote-container">


    <div class="row">
      <div class="col col-sm-6 bg-whitewash" style="padding:2%">
        <h3 class="text-center">Shipper</h3>

        <hr>


        <div class="form-row">

          <div class="col-lg-6 col-12">
            <label>Zip <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" id="orig_zip" name="orig_zip"
              placeholder="Zip/Postal Code">

          </div>


          <div class="col-lg-6 col-12">
            <label>Dock</label>
            <select class="form-control form-control-sm required" id="orig_dock" name="orig_dock">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>

          </div>
        </div>


        <div class="form-row mt-4">
          <div class="col-sm-4">

            <label>Forklift</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_frklft" id="orig_frklft" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <label>Liftgate</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_lfgt" id="orig_lfgt" value="No" checked> No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <label>Floorstack</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="orig_flrstk" id="orig_flrstk" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="col-sm-6 bg-whitewash" style="padding:2%">
        <h3 class="text-center">Receiver</h3>
        <hr>

        <div class="form-row ">


          <div class="col-sm-6">
            <label>Zip <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="dest_zip" id="dest_zip"
              value="{{ old('dest_zip') }}" placeholder="Zip/Postal Code">

          </div>

          <div class="col-sm-6">
            <label>Dock</label>
            <select class="form-control form-control-sm required" name="dest_dock" id="dest_dock">
              <option value="Yes">Yes</option>
              <option value="No">No</option>
            </select>

          </div>
        </div>


        <div class="form-row mt-4">
          <div class="col-sm-6">
            <label>Forklift</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_frklft" id="dest_frklft" value="No" checked>
                  No
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <label>Liftgate</label>
            <div class="form-group small">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="Yes"> Yes
                </label>
              </div>
              <br>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input class="form-check-input" type="radio" name="dest_lfgt" id="dest_lfgt" value="No" checked> No
                </label>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
  </div>


  <div class="container-fluid freight-quote-container">
    <div class="row" style="margin-top: 40px">

      <div class="col col-lg-12 col-sm-12 col-12 bg-whitewash text-gunmetal" style="padding:2%">
        <h3 class="text-center">Load Details</h3>
        <hr>

        <div class="form-row">

          <div class=" form-group col-lg-3 col-12">
            <label>Number <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="no_of_pallets" id="no_of_pallets"
              placeholder="# of Items">

          </div>


          <div class=" form-group col-lg-3 col-12">
            <label>Pack Type</label>

            <select class="form-control form-control-sm required" name="prod_type" id="prod_type"
              placeholder="Pack Type">
              <option value="Pallet">Pallet</option>
              <option value="Bag">Bag</option>
              <option value="Bale">Bale</option>
              <option value="Box">Box</option>
              <option value="Bundle">Bundle</option>
              <option value="Carton">Carton</option>
            </select>

          </div>


          <div class="col col-lg-3 col-12">
            <label>Weight Per Pallet <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="weight_per_pallet"
              id="weight_per_pallet" placeholder="lbs">

          </div>


          <div class="col col-lg-3 col-12">
            <label>Weight Total <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="tot_load_wt" id="tot_load_wt"
              placeholder="lbs">

          </div>


        </div>



        <div class="form-row justify-content-md-center">


          <div class=" form-group col-lg-3 col-12">
            <label>Width <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_width" id="pallet_width"
              placeholder="W (inches)">


          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Length <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_length" id="pallet_length"
              placeholder="L (inches)">
          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Height <span style="color:orange">*</span></label>
            <input type="text" class="form-control form-control-sm required" name="pallet_height" id="pallet_height"
              placeholder="H (inches)">
          </div>

        </div>


        <div class="form-row">
          <div class=" form-group col-lg-3 col-12">
            <label>Hazardous</label>
            <select class="form-control form-control-sm" name="prod_hazard" id="prod_hazard">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Stackable</label>
            <select class="form-control form-control-sm" name="prod_stackable" id="prod_stackable"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Load Strap</label>
            <select class="form-control form-control-sm required" name="load_strap" id="load_strap"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>

          </div>

          <div class=" form-group col-lg-3 col-12">
            <label>Load Block</label>
            <select class="form-control form-control-sm required" name="load_blck" id="load_blck"
              placeholder="stackable">
              <option value="No">No</option>
              <option value="Yes">Yes</option>

            </select>


          </div>

        </div>


      </div>



    </div>
  </div>

  <div class="row justify-content-center">

    @guest
    <button type="button" class="btn bg-denim text-white quote-btn presubmit" style="margin-right:10px">Get
      Quote</button>
    <button type="button" id="bookshipment_guest" class="btn bg-denim text-white quote-btn book-btn" disabled>Book
      Shipment</button>
    @endguest

    @auth
    <button type="button" class="btn bg-denim text-white quote-btn presubmit" style="margin-right:10px">Get
      Quote</button>
    <button type="button" id="bookshipment_guest" class="btn bg-denim text-white quote-btn book-btn">Book
      Shipment</button>
    @endauth
  </div>


  @csrf
</form>



@endsection()