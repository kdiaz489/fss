 /* Javascript to check if form is empty
  *
  *
  */
 function emptyForm(){

    var emptyCounter = 0;
    $('.required').each(function(){
      console.log($(this).val());

      if(!$(this).val()) {
        emptyCounter++;
      }
    });

    if (emptyCounter >=1) {
      return true;
    }
    else{
      return false;
    }
  }

 /* Variables for modal footer and content
  * Variables to stor quote numbers
  *
 */


  var app = '<div class="container app-success"><div class="alert alert-success justify-content-center"><p>Successfully sent to FillStorShip.\
  <br> We will get back to you shortly.</p>';

  var modalFooter = '<button type="button" id="storage-apply-credit" name="storage-quote-submit" class="btn btn-primary">Apply for Credit</button>';

  var closeFooter = '<button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="location.reload()">Close</button>';

  var shippingQuoteParms;
  var quoteTotal;
  var storQuote;


$(document).ready(function() {

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var hash = $(e.target).attr('href');
    if (history.pushState) {
      history.pushState(null, null, hash);
    } else {
      location.hash = hash;
    }
  });
  
  var hash = window.location.hash;
  if (hash) {
    $('.nav-link[href="' + hash + '"]').tab('show');
  }

  $('#case_qty').keyup(function(){
    updateTotal();
  });

  $('#qty_per_case').keyup(function(){
    updateTotal();
  }); 

  $('#item_qty').keyup(function(){
    updateTotal2();
    
  });

  var updateTotal = function () {
    var input1 = parseInt($('#case_qty').val());
    var input2 = parseInt($('#qty_per_case').val());

    $('#total_qty').val(input1 * input2);
    
  };

  var updateTotal2 = function () {
    var input1 = parseInt($('#case_qty').val());
    var input2 = parseInt($('#qty_per_case').val());
    var input3 = parseInt($('#item_qty').val());

    $('#total_qty').val((input1 * input2) + input3);
    
  };


  /* Javascript for Ship Page
  *
  *
  */
 

  $('#presubmit').click(function(e) {

      e.preventDefault();

       var formCheck = emptyForm();
       if(formCheck === true){
         alert('Shipping Form not completed.');
       }
       else if(formCheck === false){
         shippingQuoteParms = $('#insert_form').serialize();
          $.ajax({
            type: 'POST',
            url: 'ship/calc',
            data: $('#insert_form').serialize(),
            success: function(result) {

              $('#quoteTotal').text(result.tot_load_cost);
              quoteTotal = result.tot_load_cost;

              $('#confirm_data_Modal').modal('show');
              console.log("Application submission was successful");
              console.log(result.orig_address);
              console.log(result.dest_address);
              console.log('mileage = ' + result.mileage);
              console.log('mileage cost = ' + result.mileage_cost_total);
              //console.log(result.tot_load_cost);
              sessionStorage.clear();
            }

          });
       }
  });



$('.shipModal').on('click', '#doCredit', function(e){

  e.preventDefault();
  $(".modal-body").load('/applyforcredit');
  $('.modal-footer').html('');

});

$('.shipModal').on('click', '#applyforcredit-submit', function(e){

  e.preventDefault();
  e.stopImmediatePropagation();
    $.ajax({
      type: 'POST',
      url: 'applyforcredit/submit',
      data: $('#credit-form').serialize() + '&quote=' + quoteTotal,
      success: function() {
        //sessionStorage.clear();

        console.log("Credit Application submission was successful");
      }

    });
    $.ajax({
      type: 'POST',
      url: 'ship',
      data: shippingQuoteParms ,
      success: function() {
        //sessionStorage.clear();
        $(".modal-body").html(app);
        $(".modal-footer").html(closeFooter);
        console.log("Shipping Form submission was successful. We will get back to you shortly");
      }

    });

});


/* Javascript for Stor Page
*
*
*/




$('.storModal').on('click', '#generate-storage-quote', function(e){
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: 'stor/calc',
    data: $('#storage-quote-form').serialize(),
    success: function(result){
      console.log(result);
      storQuote = result;
      $(".modal-body").html('<p> Your quote is the following: $' + result + '</p>' );
      $('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button> <input type="button" name="creditApp" id="doCredit" value="Apply for Credit" class="btn btn-primary" />');
      console.log('Storage Quote Submission was a success');
    }
  });

});

$('.storModal').on('click', '#doCredit', function(e){

  e.preventDefault();
  $(".modal-body").load('/applyforstoragecredit');
  $('.modal-footer').html('');

});

$('.storModal').on('click', '#applyforcredit-submit', function(e){

  e.preventDefault();
  e.stopImmediatePropagation();
    $.ajax({
      type: 'POST',
      url: 'applyforstoragecredit/submit',
      data: $('#credit-form').serialize() + '&quote=' + storQuote,
      success: function() {
        //sessionStorage.clear();

        console.log("Credit Application submission was successful");
      }

    });

});


$('.filModal').on('click', '#fil-request-submit', function(e){

  e.preventDefault();

    $.ajax({
      type: 'POST',
      url: 'fil/submitrequest',
      data: $('#fil-form').serialize(),
      success: function() {
        //sessionStorage.clear();
        $(".modal-body").html(app);
        $(".modal-footer").html(closeFooter);

        console.log("Fil request submission was successful");
      }

    });

});




});
