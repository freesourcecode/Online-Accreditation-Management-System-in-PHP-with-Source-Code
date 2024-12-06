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
            <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-3"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Register</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Register</h1>
          </div>
        </div>
      </div>
    </div>



    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <form class="form-horizontal " action="process.php?action=registerAgency" method="POST">

                <div class="row">
                   <div class="col-lg-12">
                      <h1 class="page-header">Fill Up Agency Information</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                 </div> 
<!-- SELECT `COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1` FROM `tblcompany` WHERE 1 -->
 
                  <div class="form-group">
                   <div class="row">
                      <label class="col-md-4 control-label" for=
                      "COMPANYNAME">Agency Name:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="COMPANYNAME" name="COMPANYNAME" placeholder=
                            "Agency Name" type="text" value="" autocomplete="none">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                 <div class="row">
                      <label class="col-md-4 control-label" for=
                      "COMPANYADDRESS">Agency Address:</label> 
                      <div class="col-md-8">
                        <textarea class="form-control input-sm " id="compose-textarea" name="COMPANYADDRESS" placeholder=
                            "Agency Address"  type="text" value=""   onkeyup="javascript:capitalize(this.id, this.value);" autocomplete="off"></textarea> 
                      </div>
                    </div>
                  </div> 

                  <div class="form-group">
                 <div class="row">
                      <label class="col-md-4 control-label" for=
                      "COMPANYCONTACTNO">Agency Contact No.:</label>

                      <div class="col-md-8">
                         <input class="form-control input-sm" id="COMPANYCONTACTNO" name="COMPANYCONTACTNO" placeholder=
                            "Agency Contact No." type="text" value="" autocomplete="none"> 
                      </div>
                    </div>
                  </div>  
 

                  <div class="form-group">
                 <div class="row">
                      <label class="col-md-4 control-label" for=
                      "C_Username">Username:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" value="">
                         <input class="form-control input-sm" id="C_Username" name="C_Username" placeholder=
                            "Account Username" type="text" value="">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                 <div class="row">
                      <label class="col-md-4 control-label" for=
                      "C_Password">Password:</label>

                      <div class="col-md-8">
                        <input name="deptid" type="hidden" minlength="2" value="">
                         <input class="form-control input-sm" id="C_Password" min="3" name="C_Password" placeholder="Account Password" type="Password" value="" required>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                 <div class="row">
                      <label class="col-md-4 control-label" for=
                      "idno"></label>  

                      <div class="col-md-8">
                         <button class="btn btn-primary btn-lg" name="btnRegister" type="submit" ><span class="fa fa-save fw-fa"></span> Register</button>
                      <!-- <a href="index.php" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;<strong>Back</strong></a> -->
                     
                     </div>
                    </div>
                  </div> 
 
          
        </form>
      </div>
    </div>
  </section>

