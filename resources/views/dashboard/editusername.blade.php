
@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">

            <form class="update-form" id="new-username-form" action="" method="">
      
               <div class="row justify-content-md-center">
      
                    <div class=" form-group col-md-12">
                        <h5 class="mb-4">Username</h5>

                        <input type="text" name="username" class="form-control form-control-sm required" style="border-style: none none solid none;" placeholder="New Username">
                    </div>
      
                </div>
                <div class="row justify-content-md-center">
                        <button class = "btn btn-link btn-sm edit-submit" type="button" id="newusername-submit" name="edit-submit" style="font-weight:700;">Submit</button>
                    </div>
            @csrf
            </form>
      </div>
    @endif
