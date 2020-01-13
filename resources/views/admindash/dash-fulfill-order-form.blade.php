@extends('layouts.admindashlte')

@section('main-sidebar')
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar bg-denim elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link justify-content-center border-0">
                  <img src="{{asset('img/fss-white.svg')}}" alt="AdminLTE Logo" class="brand-image" width="100px" height="80px" style="max-height:27px; width:auto">
                  <span class="brand-text font-weight-light text-white">Admin Dashboard</span>
                </a>
          
                <!-- Sidebar -->
                <div class="sidebar">
          
          
                  <!-- Sidebar Menu -->
                  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                      <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
          
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-box-open"></i>
                          <p>
                            Fulfilment
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
          
                          <li class="nav-item">
                            <a href="/dashboard/admin/fulfillment" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Fulfillment Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
          
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-warehouse"></i>
                          <p>
                            Storage
                            <i class="right fas fa-angle-left"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/inventory" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Inventory</p>
                            </a>
                          </li>
          
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-shipping-fast"></i>
                          <p>
                            Shipments
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard" class="nav-link text-white" >
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>All Shipments</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
                          <i class="nav-icon fas fa-edit"></i>
                          <p>
                            Orders
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/orders" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Storage Orders</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="nav-item has-treeview">
                            <a href="#" class="nav-link text-white">
                              <i class="nav-icon fas fa-users"></i>
                              <p>
                                Users
                                <i class="fas fa-angle-left right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="/dashboard/admin/users" class="nav-link text-white">
                                    <i class="fas fa-angle-right nav-icon"></i>
                                  <p>Manage Users</p>
                                </a>
                              </li>
                            </ul>
                          </li>
                      <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-white">
          
                          <i class="nav-icon fas fa-user-alt"></i>
                          <p>
                            {{auth()->user()->name}} 
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="/dashboard/admin/account" class="nav-link text-white">
                              <i class="fas fa-angle-right nav-icon"></i>
                              <p>Account Details</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                              <i class="fas fa-angle-right nav-icon"></i>
                              {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                            </form>
                          </li>
          
          
                        </ul>
                      </li>
          
          
          
                    </ul>
                  </nav>
                  <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
              </aside>
@endsection

@section('content')

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">

<main class="content" role="content">
	
	<section id="section1">
		<div class="container-fluid col-md-6 col-md-offset-3">

<!-- MultiStep Form -->
<form class="p-0 mb-3" id="filForm" action="">
        {{method_field('PUT')}}
  <h1 class="font-weight-light mb-3">Fulfill Shopify Order</h1>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
    <div class="card m-0 mb-3">
            <h4 class="card-header font-weight-light">
                Order Details
            </h4>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="card-text"> <span>Order #: </span> <br> {{$order->cust_order_no}}</p>
                    </div>
        
                    <div class="col-md-6">
                        <p class="card-text"> <span>Customer Name: </span> <br> {{$order->cust_name}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text"> <span>Shipping Address: </span> <br> {{$order->street_address}} <br> {{$order->city . ', ' . $order->state . ' ' . $order->zip . ' '}}</p>
                    </div>
            
                    <div class="col-md-6">
                        <p class="card-text"> <span>Current Fulfillment Status: </span> <br> {{$order->fulfillment_status}}</p>
                    </div>
                </div>
                
            </div>
            </div>
  </div>
  <div class="tab">
        <div class="card overflow-auto m-0 mb-3" style="height: 100%">
                <h4 class="card-header font-weight-light">
                    Order Products
                </h4>
                <div class="card-body">
                    @foreach ($order->basic_units as $unit)
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <p class="mb-0">SKU #: </p>
                                <p class="product_sku unit">{{$unit->sku}}</p>
                            </div>
                
                            <div class="col-md-4">
                                <p class="mb-0">Description: </p>
                                <p>{{$unit->description}}</p>
                            </div>

                            <div class="col-md-2">
                                <p class="mb-0">Quantity: </p>
                                <p class="text-center">{{$unit->pivot->quantity}}</p>
                            </div>

                            <div class="col-md-4">
                              <div class="input-group">
                                    <input type="text" class="form-control scan" placeholder="Scan Product">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-secondary bg-denim border-denim text-white verify_sku">Verify</button>
                                    </div> 
                              
                              </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
  </div>


  <div class="tab" id="final">
      <div class="card m-0 mb-3">
          <h4 class="card-header font-weight-light">
              Order Details
          </h4>
          <div class="card-body">
              <div class="row mb-4">
                  <div class="col-md-6">
                      <p class="card-text"> <span>Order #: </span> <br> {{$order->cust_order_no}}</p>
                  </div>
      
                  <div class="col-md-6">
                      <p class="card-text"> <span>Customer Name: </span> <br> {{$order->cust_name}}</p>
                  </div>
              </div>

              <div class="row">
                  <div class="col-md-6">
                      <p class="card-text"> <span>Shipping Address: </span> <br> {{$order->street_address}} <br> {{$order->city . ', ' . $order->state . ' ' . $order->zip . ' '}}</p>
                  </div>
          
                  <div class="col-md-6">
                      <p class="card-text"> <span>Current Fulfillment Status: </span> <br> {{$order->fulfillment_status}}</p>
                  </div>
              </div>
              
          </div>
          </div>
          

        <div class="card overflow-auto m-0 mb-3 w-100" style="height: 100%">
                <div class="card-body final-card-body">
                    @foreach ($order->basic_units as $unit)
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-0">SKU #: </p>
                                <p class="product_sku unit">{{$unit->sku}}</p>
                            </div>
                
                            <div class="col-md-6">
                                <p class="mb-0">Description: </p>
                                <p>{{$unit->description}}</p>
                            </div>

                        </div>
                    @endforeach
                    <div class="row mb-4">
                      <div class="col-md-12">
                          <label class="font-weight-normal" for="">Is the following order Boxed and Labeled?
                              <input type="checkbox" class="" name="" id="">
                          </label>
                      </div>
                    </div>
                </div>
            </div>

  
  </div>

  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" class="btn btn-primary border-0 bg-frenchblue text-white" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" class="btn btn-primary border-0 bg-denim text-white" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
  @csrf
</form>
<!-- /.MultiStep Form -->
	
		</div>
	</section>

</main> <!-- /content -->
</div>
@endsection

@section('scripts')

<script>

var success = '<div class="container app-success text-center justify-content-center" style="border: 1px solid #4BB543"> <p>Your order is fulfilled.\
                <br><br> <i class="fas fa-check-circle" style="font-size: 2rem; color: #4BB543"></i></p> </div>';

var fail = '<div class="container app-success text-center justify-content-center" style="border: 1px solid red"> <p>Your order was not fulfilled.\
<br><br> <i class="fas fa-check-circle" style="font-size: 2rem; color: #4BB543"></i></p> </div>';

// Multi-Step Form
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}


function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  if (!(currentTab >= x.length)){
    
      if (currentTab + n >= x.length) {  
      }
      else{
        x[currentTab].style.display = "none";
        console.log('none')
      }
    
  }
  else{
    showTab(currentTab);
  }
  
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    
    $.ajax({
        type: 'POST',
        url: '/order/update/{{$order->id}}',
        data: $('#filForm').serialize() + '&status=' + 'Completed',
        })
        .done(function (result) {
            currentTab = currentTab-1;
            showTab(currentTab);
            console.log('Success');
            $('#nextBtn').attr('disabled', true)
            $('.modal-body').html(success);
            $('.modal').modal('show');
            
        })

        .fail(function (jqXHR, textStatus, error) {
            currentTab = currentTab-1;
            showTab(currentTab);
            $('.modal-body').html(fail);
            $('.modal').modal('show');
            
        });
  }
  else{
  // Otherwise, display the correct tab:
  showTab(currentTab);
  }
    return false;
  


}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    
    if(y[i].type === 'checkbox'){
        if (y[i].checked == false ) {
          // add an "invalid" class to the field:
          y[i].closest('label').className += " invalid";
          // and set the current valid status to false
          valid = false;
      }
      else{
        y[i].closest('label').classList.remove('invalid');
      }
    }
    if(y[i].type === 'text'){
      if (y[i].value == "" || y[i].classList.contains('invalid')) {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
        else{
        y[i].classList.remove('invalid');
      }
    }


  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}



$('.verify_sku').focus(function(e){
  e.preventDefault();
  $(this).click();
});

$('.verify_sku').on('click', function(e){
    
    //var button = $(this).next().children('.verify_sku');
    var button = $(this);
    console.log(button);
    var sku = '';
    var barcode = '';
    var type = '';
    sku = $(this).closest('.row').find('.product_sku').text();
    console.log('SKU = ' + sku)
    barcode = $(this).closest('.input-group').find('input[type=text]').val();
    if($(this).closest('.row').find('.product_sku').hasClass('unit')){
        type = 'Unit';
    }
    $.ajax({
    type: 'POST',
    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
    url: '/verifyorderskus/{{$order->id}}',
    data: {
        sku: sku,
        barcode: barcode,
        type: type,
        _token: $(this).next("input[name=_token]").val()
    },
    })
    .done(function (result) {
        $(button).removeClass('bg-danger border-danger');
        $(button).addClass('bg-success border-success');
        $(button).html('<i class="fas fa-check-circle"></i>');
        $(button).closest('input').removeClass('invalid');
        $(button).parent().prev('input').removeClass('invalid');
        
    })

    .fail(function (jqXHR, textStatus, error) {
        $(button).removeClass('bg-success border-success');
        $(button).addClass('bg-danger border-danger');
        $(button).html('<i class="fas fa-times-circle"></i>');
        
        $(button).parent().prev('input').addClass('invalid');
    });
});

</script>
@endsection