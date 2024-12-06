
<!-- <div class="form-group">
  <div class="col-md-11">
  <label class="col-md-4 control-label" for=
    "NATIONALID">NationalID:</label>

    <div class="col-md-8"> 
       <input class="form-control " id="NATIONALID" name="NATIONALID" placeholder=
          "00-000000000000" type="text" value=""  onkeyup="javascript:capitalize(this.id, this.value);" >
    </div>
  </div>
</div> -->
<style type="text/css">
.form-control-2 {
  display: inline-block;
  width: 25%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
  -o-transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; }
   
</style> 

  <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo web_root; ?>plugins/jobportal/images/.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" data-scrollax-parent="true">
          <div class="col-md-8 ftco-animate text-center text-md-left mb-5" data-scrollax=" properties: { translateY: '70%' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Register Now</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Register Now</h1>
          </div>
        </div>
      </div>
    </div>
<section class="ftco-section contact-section bg-light">
      <div class="container"> 
        <div class="row"> 
        <div class="col-md-3"></div>
        <div class="row block-9 col-md-6">
        <div class="row d-flex mb-5 contact-info">  
            <h4 class="page-header" >Register School</h4> 
        </div>
            <form action="process.php?action=registerschool" method="POST" class="bg-white p-5 contact-form">

              <div class="form-group">
                  <label class="label">School Name</label>
                  <input  class="form-control " id="SCHOOLNAME" name="SCHOOLNAME" placeholder="Schoo Name"    onkeyup="javascript:capitalize(this.id, this.value);" > 
              </div> 
              <div class="form-group"> 
                  <label class="label">School Address</label>
                  <textarea class="form-control " id="ADDRESS" name="ADDRESS" placeholder="Address" type="text" value="" required  onkeyup="javascript:capitalize(this.id, this.value);" ></textarea>
              </div>
 
         
              <div class="form-group">
                  <label class="label">Email Address</label>
                   <input type="email" class="form-control " id="EMAILADDRESS" name="EMAILADDRESS" placeholder="Email Address"   autocomplete="false"/>  
              </div>
         
              <div class="form-group">
                  <label class="label">Contact Number</label>
                   <input type="text" class="form-control " id="CONTACTNO" name="CONTACTNO" placeholder="Contact Number"   autocomplete="false"/>  
              </div>
              <div class="form-group">
                 <input  class="form-control " id="USERNAME" name="USERNAME" placeholder="Username"    onkeyup="javascript:capitalize(this.id, this.value);" >
                
              </div>
              <div class="form-group">
                  <label class="label">Password</label>
                   <input  class="form-control " id="PASS" name="PASS" placeholder="Password" type="password"   onkeyup="javascript:capitalize(this.id, this.value);" > 
                
              </div>


     
 
              <div class="form-group">
                <input type="checkbox"> By Sign up you are agree with our <a href="#">terms and condition</a> 
              </div> 

              <div class="form-group">
                <input type="submit" value="Register" name="submit" name="btnRegister" class="btn btn-primary py-3 px-5">
              </div>
            </form> 
          </div>

        <div class="col-md-3"></div>
      </div>
        </div>
      </section>

    

 