
@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">

            <form class="update-form" id="new-email-form" action="" method="">
      
               <div class="row justify-content-md-center">
      
                    <div class=" form-group col-md-12">
                        <h5 class="mb-4">E-Mail</h5>
                        <input type="text" name="email" class="form-control form-control-sm required" style="border-style: none none solid none;" placeholder="New E-mail Address">
                    </div>
      
                </div>
                <div class="row justify-content-md-center">
                        <button class = "btn btn-link btn-sm edit-submit" type="button" id="newemail-submit" name="edit-submit" style="font-weight:700;">Submit</button>
                    </div>

            @csrf
            </form>

      </div>
    @endif
