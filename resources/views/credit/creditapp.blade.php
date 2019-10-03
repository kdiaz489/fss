
@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">

        <h1 class="text-center">Apply For Credit</h1>
      
            <form class="signup" id="credit-form" action="" method="">
      
               <div class="form-row">
      
                 <div class=" form-group col-md-6">
                      <input type="text" name="name" class="form-control form-control-sm required"  placeholder="Legal Name of Business">
                </div>

                <div class="form-group col-md-6">
                    <input type="text" name="billingaddress" class="form-control form-control-sm required"  placeholder="Business Mailing Address">
                </div>
      

            </div>
      
              <div class="form-row">
                  <div class=" form-group col-md-6 col-12">
                      <input type="text" name="city" class="form-control form-control-sm required"  placeholder="City">                    
                    </div>

                  <div class=" form-group col-md-2 col-12">
                      <input type="text" name="state" class="form-control form-control-sm required"  placeholder="State">
                    </div>
                <div class="form-group col-md-4 col-12">
                    <input type="text" name="zip" class="form-control form-control-sm required"  placeholder="Zip">
                </div>
      
              </div>
      
              <div class="form-row">
      
                <div class="form-group col-md-4 col-12">
                    <select class="form-control form-control-sm required" name="biz-type">
                      <option value="none" disabled selected hidden>Business Type</option>
                      <option value="Corporation">Corporation</option>
                      <option value="Partnership">Partnership</option>
                      <option value="Sole-Proprietor">Sole Proprietor</option>
                      <option value="Non-Profit">Non-Profit</option>
                      <option value="LLC">LLC</option>
                    </select>
                </div>
      
                <div class="form-group col-md-4 col-12">
                    <input type="text" name="biz-phone" class="form-control form-control-sm required"  placeholder="Business Phone">

                </div>

                <div class="form-group col-md-4 col-12">
                    <input type="text" name="id-num" class="form-control form-control-sm required"  placeholder="Tax Identification Number">

                </div>
      
              </div>

              <div class="form-row">
      
                  <div class="form-group col-md-4 col-12">
                      <input type="text" name="num-employees" class="form-control form-control-sm required"  placeholder="Number of Employees">

                  </div>
        
                  <div class="form-group col-md-4 col-12">
                      <input type="text" name="biz-rev" class="form-control form-control-sm required"  placeholder="Annual business revenue/sales">
  
                  </div>
  
                  <div class="form-group col-md-4 col-12">
                      <input type="text" name="biz-years" class="form-control form-control-sm required"  placeholder="Years in Business">
  
                  </div>
        
                </div>


                <div class="form-row">
      
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="biz-industry" class="form-control form-control-sm required"  placeholder="General Industry">

                    </div>
          
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="biz-category" class="form-control form-control-sm required"  placeholder="Category">
    
                    </div>
    
                    <div class="form-group col-md-4 col-12">
                        <input type="text" name="biz-specific" class="form-control form-control-sm required"  placeholder="Specific Type">
    
                    </div>
          
                </div>
      
      
            <div class="form-row justify-content-center">
             
                    
                <button class = "btn btn-primary btn-sm credit-submit" type="button" id="applyforcredit-submit" name="credit-submit">Submit</button>
      
              
            </div>
            @csrf
            </form>
            <br> 
            <div class="wait justify-content-center text-center" style="display:none;width:69px;height:89px;padding:2px; margin:auto;">
            <img src="https://www.grouplandmark.in/assets/visual/logo/loader.gif" width="64" height="64" /><br>Loading...</div>
      </div>
    @endif
