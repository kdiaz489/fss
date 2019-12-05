/* Javascript to check if form is empty
 *
 *
 */
function emptyForm() {

    var emptyCounter = 0;
    $('.required').each(function () {
        console.log($(this).val());

        if (!$(this).val()) {
            emptyCounter++;
        }
    });

    if (emptyCounter >= 1) {
        return true;
    } else {
        return false;
    }
}



/***** Variables for modal footer and content ****/
var appsuccess = '<div class="container app-success text-center justify-content-center" style="border: 1px solid #4BB543"> <p>Your submission to FillStorShip\
                   was successful. We will get back to you shortly.<br><br> <i class="fas fa-check-circle"></i></p> </div>';

var shipcreditsucces =  '<div class="container app-success text-center justify-content-center" style="border: 1px solid #4BB543"> <p>Your submission to FillStorShip\
                   was successful. Please check your account balance on your user dashboard. The amount listed will need to be covered upon completion of the load.<br><br> <i class="fas fa-check-circle"></i></p> </div>';

var success = '<div class="container app-success text-center justify-content-center" style="border: 1px solid #4BB543"> <p>Your account update was successful.\
                <br><br> <i class="fas fa-check-circle"></i></p> </div>';

var errorModal = '<div class="container app-success text-center justify-content-center" style="border: 1px solid red"> <p>There was an error with your submssion.\
                <br> Please make sure you filled in the form correctly or contact us. <br><br> <i class="fas fa-exclamation-circle"></i></p> </div>';

var modalFooter = '<button type="button" id="storage-apply-credit" name="storage-quote-submit" class="btn btn-primary">Apply for Credit</button>';

var closeFooter = '<div class="m-auto"> <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="location.reload()">Close</button></div>';

var loader = '<div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">\
                <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Loading...</div>';

var disclaimer = '<div style="font-size:13px; width:90%; margin: 0 auto;"><strong>*Disclaimer:</strong> All orders are processed immediately after payment\
                     acceptance. Product will ship within the constraints on dates provided by you,\
                    pending approval by FillStorShip. If any change to your shipment order arises, we will contact you via email or phone. Shipping charges\
                    are calculated and displayed via our quote generator. Additional charges may apply.</div>';

var stordisclaimer = '<div style="font-size:13px; width:90%; margin: 0 auto;"><strong>*Disclaimer:</strong> Storage fee quote based off of minimum charges\
                        for the number of pallets shown.Your cost may vary depending on your individual requirements.</div>';

/***** Variables to stor quote numbers *****/
var initialContent;
var initialFooter;
var shippingQuoteParms;
var quoteTotal;
var quote;
var shipmentid;

$(document).ready(function () {


    $('.shipment-history').DataTable({
        "paging":   false,
        "info":     false
    });
    $('.shipment-table').DataTable({
        "paging":   false,
        "info":     false
    });




 
    $(document).ajaxStart(function () {
        $(".wait").css("display", "block");
    });
    $(document).ajaxComplete(function () {
        $(".wait").css("display", "none");
    });

    
    $('td').on('show.bs.collapse', function () {
        //$(this).addClass('p-2');
        var toggle = $(this).children().attr('id');
        $('#toggle-' + toggle).empty();
        $('#toggle-' + toggle).append('<i class="fas fa-minus"></i>');
        $('#toggle-' + toggle).removeClass('text-denim');
        $('#toggle-' + toggle).addClass('text-danger');
        
    });




    $('td').on('hide.bs.collapse', function () {
        //$(this).removeClass('p-2');
        var toggle = $(this).children().attr('id');
        $('#toggle-' + toggle).empty();
        $('#toggle-' + toggle).append('<i class="fas fa-plus"></i>');
        $('#toggle-' + toggle).removeClass('text-danger');
        $('#toggle-' + toggle).addClass('text-denim');
        
    });


    /****  Code for Dash board tabs begins ****/
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

    /**** Code for Dash board tabs ends ****/


   $('.select_skus').select2({
        placeholder: 'Click to select'
    });






    /**** Code for updating account info begins ****/



    $('.editusername').on('click',function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updateusername', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });


    $('.editemail').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updateemail', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });


    $('.editpass').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updatepass', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });

    $('.editcompanyname').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updatecompanyname', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });


    $('.editcontact').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updatecontactname', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });

    $('.editaddress').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/updateaddress', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });

    $('.adduser').on('click', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        $(".modal-body").load('/adduser', function(){
            $('.modal-footer').html('');
            $('.modal').modal('show');
        });



    });

    $('.modal').on('click', '#paycc', function (e) {

        e.preventDefault();
        //initialContent = $('.modal-content').html();
        $(".modal-body").load('/checkout');
        $('.modal-footer').html('');
        $('.modal').modal('show');


    });


    // Code for handling new username submission
    $('.modal').on('click', '#newusername-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-username-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/submitupdateusername',
                data: $('#new-username-form').serialize(),
                })
                .done(function (result) {

                    $('.modal-body').html(appsuccess);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                })

                
                .fail( function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });
      }
    });

    // Code for handling new password (email) submission
    $('.modal').on('click', '#newpass-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-pass-email-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/password/email',
                data: $('#new-pass-email-form').serialize(),
            })
                .done( function (result) {

                    $('.modal-body').html(appsuccess);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    })
                })

                
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });

            }
        });


    


    // Code for handling new email submission
    $('.modal').on('click', '#newemail-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-email-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/submitupdateemail',
                data: $('#new-email-form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html(appsuccess);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });


                })
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });

                });
        }
      });

            
        


    


    // Code for handling new user submission

    $('.modal').on('click', '#adduser-submit', function (e) {

        e.preventDefault();

        if ($("#add-user-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/register',
                data: $('#add-user-form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html(success);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });

                })
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });
        }
    });

    // Code for handling new company name submission

    $('.modal').on('click', '#newcompanyname-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-companyname-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/submitupdatecompanyname',
                data: $('#new-companyname-form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html(success);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });

                })
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });

            
        }


    });

    // Code for handling new contact name submission

    $('.modal').on('click', '#newcontactname-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-contactname-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/submitupdatecontactname',
                data: $('#new-contactname-form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html(success);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });

                })
                .done(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });

            
        }


    });


    // Code for handling new address submission

    $('.modal').on('click', '#newaddress-submit', function (e) {

        e.preventDefault();
        $('form').append(loader);

        if ($("#new-address-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/submitupdateaddress',
                data: $('#new-address-form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html(success);
                    $('.modal-footer').html('');
                    $('.modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });

                })
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                        $('.wait').remove();
                    });
                });

            
        }


    });



    /**** Code for shipping quote (any route) begins ****/

    $('#case_qty').keyup(function () {
        updateTotal();
    });

    $('#qty_per_case').keyup(function () {
        updateTotal();
    });

    $('#item_qty').keyup(function () {
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

    $('#weight_per_pallet').keyup(function () {
        updateTotalWeight();
    });

    $('#no_of_pallets').keyup(function () {
        updateTotalWeight();
    });



    var updateTotalWeight = function () {
        var input1 = parseInt($('#weight_per_pallet').val());
        var input2 = parseInt($('#no_of_pallets').val());

        $('#tot_load_wt').val(input1 * input2);

    };


    /****  Code for shipping quote (any route) ends ****/





    /****** Code for /ship begins here *****/

    $('.presubmit').click(function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        shippingQuoteParms = $('.shipquote_form').serialize();

        if ($("#insert_form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/ship/calc',
                data: $('.shipquote_form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html('<h2 class="text-center">Your Quote: $' + result.tot_load_cost + '</h2>' + '<br> <h5 class="text-center"> Total Mileage: ' +
                        result.mileage + ' mi</h5> <br> <h5 class="text-center"> Total Pallets: ' + $('#no_of_pallets').val() + '</h5> <br> <h5 class="text-center"> Total Weight: ' +
                        $('#tot_load_wt').val() + ' lbs</h5>' + disclaimer + '<div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">\
                        <div style="font-size:12px"></div><img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Loading...</div>');

                    quoteTotal = result.tot_load_cost;

                    $('.modal').modal('show');
                    console.log("Application submission was successful");
                    console.log(result.orig_address);
                    console.log(result.dest_address);
                    console.log('mileage = ' + result.mileage);
                    console.log('mileage cost = ' + result.mileage_cost_total);
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });

                })
                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#confirm_data_Modal').modal('show');

                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                });
        }
        else{

            $('html, body').animate({
                scrollTop: ($('.error:visible').offset().top - 300)
            }, 1000);
        }
        


    });


    /****** Code for /ship ends here *****/





    /****** Code for /ship/book begins here *****/



    $('#bookshipment').click(function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        shippingQuoteParms = $('#final_book_shipment_form').serialize();
        if ($("#final_book_shipment_form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/ship/calc',
                data: $('#final_book_shipment_form').serialize(),
            })
                .done(function (result) {

                    $('.modal-body').html('<h2 class="text-center">Your Quote: $' + result.tot_load_cost +
                        '</h2>' + '<br> <h5 class="text-center"> Total Mileage: ' + result.mileage + ' mi</h5> <br> <h5 class="text-center"> Total Pallets: ' +
                        $('#no_of_pallets').val() + '</h5> <br> <h5 class="text-center"> Total Weight: ' + $('#tot_load_wt').val() + ' lbs</h5><br>\
                        <div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">\
                        <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Loading...</div>');

                    quoteTotal = result.tot_load_cost;

                    $('#final_book_shipment_modal').modal('show');
                    //console.log("Application submission was successful");
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal').data('bs.modal', null);
                        $('.modal-content').html(initialContent);
                    });
                })


                .fail(function (error) {
                    console.log(error);
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('#final_book_shipment_modal').modal('show');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal').data('bs.modal', null);
                        $('.modal-content').html(initialContent);
                    });
                });

        }
        else{

            $('html, body').animate({
                scrollTop: ($('.error:visible').offset().top - 300)
            }, 1000);
        }
        
    });



    $('.modal').on('click', '#paywcredit', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();

        $.ajax({
            type: 'POST',
            url: '/submitshipment',
            data: $('#final_book_shipment_form').serialize() + '&quote=' + quoteTotal + '&payment_type=' + 'accbal',
        })
            .done(function (result) {
                //sessionStorage.clear();
                $(".modal-body").html(appsuccess);
                $(".modal-footer").html('');
                $('#final_book_shipment_modal').modal('show');
                console.log("Shipping Form submission was successful. We will get back to you shortly");
                $('.modal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });
            })


            .fail(function (error) {
                console.log(error);
                $(".modal-body").html(errorModal);
                $(".modal-footer").html('');
                $('#final_book_shipment_modal').modal('show');
                $('.modal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });

            });

    });


    $('.modal').on('click', '#book30', function (e) {

        e.preventDefault();
        initialContent = $('.modal-content').html();
        //shippingQuoteParms = $('#bookshipment_form').serialize();
        $.ajax({
            type: 'POST',
            url: '/submitshipment',
            data: $('#book_shipment_form').serialize(),
        })
            .done(function (result) {

                $('.modal-body').html('<h2 class="text-center">Your Quote: $' + result.tot_load_cost + '</h2>' + '<br> <h5 class="text-center"> Total Mileage: ' +
                    result.mileage + ' mi</h5> <br> <h5 class="text-center"> Total Pallets: ' + $('#no_of_pallets').val() + '</h5> <br> <h5 class="text-center"> Total Weight: ' +
                    $('#tot_load_wt').val() + ' lbs</h5><br><div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">\
                    <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Sending Request...</div>');

                quoteTotal = result.tot_load_cost;

                $('#book_shipment_modal').modal('show');
                console.log("Application submission was successful");
                $('.modal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });

            })
            .fail(function (error) {
                console.log(error);
                $(".modal-body").html(errorModal);
                $(".modal-footer").html('');
                $('#book_shipment_modal').modal('show');
                $('.modal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });

            });

    });

    //Handles Credit Card Submission and Submitting to the DB

    function submitshipCredit(){
      var a1 = $.ajax({
          type: 'POST',
          url: '/checkout',
          data: $('#cc_auth_form').serialize() + '&invoiceid=' + shipmentid + '&' + shippingQuoteParms + '&quote=' + quoteTotal,
      });

      return a1;
    }

    function submitshipWork(){
      var a2 = $.ajax({
          type: 'POST',
          url: '/submitshipment',
          data: $('#final_book_shipment_form').serialize() + '&quote=' + quoteTotal + '&payment_type=' + 'creditcardpayment',
      });
      return a2;
    }

    $('.modal').on('click', '#cc-auth-submit', function (e) {


        e.preventDefault();
        e.stopImmediatePropagation();

        if ($("#cc_auth_form").valid()) {


            shipmentid = '345';
              /* Code that chains AJAX requests for credit card payment and ship work  */
              var a3 = submitshipCredit();

              var a4 = a3.then(function(data){
                submitshipWork(); 
              });

              a4.done(function(data){
                    console.log('Your Shipment was submitted!');
                    $(".modal-body").html(appsuccess);
                    $(".modal-footer").html('');
                    $('#final_book_shipment_modal').modal('show');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal').data('bs.modal', null);
                        $('.modal-content').html(initialContent);
                    });
              });

              a4.fail(function(jqXHR, textStatus, error){
                    var message = jqXHR.responseJSON.message;
                    $(".modal-body").html('<div class="container app-success text-center justify-content-center" style="border: 1px solid red"> <p>' +
                        message + '<br><br> <i class="fas fa-exclamation-circle"></i></p> </div>');
                    console.log(jqXHR.responseJSON.message);
                    $(".modal-footer").html('');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal').data('bs.modal', null);
                        $('.modal-content').html(initialContent);
                    });
                });
        }
    });


    $('.storModal').on('click', '.credit-submit', function (e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        initialContent = $('.modal-content').html();
        if ($("#storage-quote-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/applyforstorcredit/submit',
                data: $('#storage-quote-form').serialize() + '&quote=' + quoteTotal,
            })
                .done(function (result) {
                    //sessionStorage.clear();
                    $(".modal-body").html(appsuccess);
                    $(".modal-footer").html('');
                    $('.modal').modal('show');
                    console.log("Credit Application submission was successful");
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                })

                .fail(function (jqXHR, textStatus, error) {
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                });
        }
    });


    $('.shipModal').on('click', '.credit-submit', function (e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        initialContent = $('.modal-content').html();
        if ($("#final_book_shipment_form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/applyforshipcredit/submit',
                data: $('#credit-form').serialize() + '&quote=' + quoteTotal,
            })
                .done(function (result) {
                    //sessionStorage.clear();
                    $(".modal-body").html(appsuccess);
                    $(".modal-footer").html('');
                    $('.modal').modal('show');
                    console.log("Credit Application submission was successful");
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                })

                .fail(function (jqXHR, textStatus, error) {
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                });
        }
    });


    $('#final_book_shipment_modal').on('click', '#na_applycredit', function (e) {

        e.preventDefault();
        $(".modal-body").load('/applyforcredit');
        $('.modal-footer').html('');

    });



    /****** Code for /ship/book code ends here *****/






    /****** Code for ship redirect + credit app begins here *****/

    $('.modal').on('click', '#doCredit', function (e) {

        e.preventDefault();
        $(".modal-body").load('/applyforcredit');
        $('.modal-footer').html('');

    });



    $('.shipModal').on('click', '#register', function (e) {

        e.preventDefault();
        document.location.href = '/register';

    });



    $('.book-btn').on('click', function (e) {

        e.preventDefault();
        document.location.href = '/ship/book';

    });


    /****** Code for ship redirect + credit app ends here *****/





    /****  Code for Stor Page begins here ****/


    $('.storModal').on('click', '#generate-storage-quote', function (e) {
        e.preventDefault();
        initialContent = $('.modal-content').html();
        if ($("#storage-quote-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '/stor/calc',
                data: $('#storage-quote-form').serialize(),
            })
                .done(function (result) {
                    console.log(result);
                    quoteTotal = result;
                    $(".modal-body").html('<div class="text-center justify-content-center"> <h2> Your quote is the following: $' + result + '</h2>\
                    </div>' + stordisclaimer + '<br><div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">\
                    <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Loading...</div>');


                    $('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>\
                    <input type="button" name="creditApp" id="doCredit" value="Apply for Credit" class="btn btn-primary" />');

                    console.log('Storage Quote Submission was a success');
                    $('.storModal').modal('show');

                    $('.storModal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                })

                .fail(function (jqXHR, textStatus, error) {
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('.storModal').modal('show');
                    $('.storModal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                });
        }
    });

    $('.storModal').on('click', '#doCredit', function (e) {

        e.preventDefault();
        $(".modal-body").load('/applyforstoragecredit');
        $('.modal-footer').html('');

    });

    $('.storModal').on('click', '#applyforcredit-submit', function (e) {

        e.preventDefault();
        e.stopImmediatePropagation();
        initialContent = $('.modal-content').html();
        $.ajax({
            type: 'POST',
            url: '/applyforstoragecredit/submit',
            data: $('#credit-form').serialize() + '&quote=' + quoteTotal,
        })
            .done(function (result) {
                $(".modal-body").html(appsuccess);
                $(".modal-footer").html('');
                $('.storModal').modal('show');
                console.log("Credit Application submission was successful");
                $('.storModal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });
            })

            .fail(function (jqXHR, textStatus, error) {
                $(".modal-body").html(errorModal);
                $(".modal-footer").html('');
                $('.storModal').modal('show');

                $('.storModal').on('hide.bs.modal', function (e) {
                    $('.modal-content').html(initialContent);
                });
            });

    });
    /****  Code for Stor Page begins here ****/






    /* Code for fulfillment page starts here */

    $('.modal').on('click', '#fil-request-submit', function (e) {
        initialContent = $('.modal-content').html();
        e.preventDefault();
        if ($("#fil-form").valid()) {
            $.ajax({
                type: 'POST',
                url: 'fil/submitrequest',
                data: $('#fil-form').serialize(),
            })
                .done(function (result) {
                    //sessionStorage.clear();
                    $(".modal-body").html(appsuccess);
                    $(".modal-footer").html('');
                    $('.modal').modal('show');

                    console.log("Fil request submission was successful");
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                })

                .fail(function (jqXHR, textStatus, error) {
                    $(".modal-body").html(errorModal);
                    $(".modal-footer").html('');
                    $('.modal').modal('show');
                    $('.modal').on('hide.bs.modal', function (e) {
                        $('.modal-content').html(initialContent);
                    });
                });
        }
    });
    /* Code for fulfillment page ends here */



});
