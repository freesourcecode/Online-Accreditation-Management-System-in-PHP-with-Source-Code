
    <!-- $sql = "SELECT `COMPANYID`, `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`, `AccreditorName`, `C_Username`, `C_Password`, `Img1` FROM `tblcompany` WHERE `COMPANYID`=".$_SESSION['COMPANY_USERID']; -->
   <form class="form-horizontal" action="controller.php?action=edit" method="POST">
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 col-form-label">Agency Name</label>
      <div class="col-sm-10">
        <input type="text" name="COMPANYNAME" class="form-control" id="inputName" placeholder="Name" value="<?php echo $singleCompany->COMPANYNAME;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="inputExperience" name="COMPANYADDRESS" placeholder="School Address"><?php echo $singleCompany->COMPANYADDRESS;?></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail" name="COMPANYEMAIL" placeholder="Email" value="<?php echo $singleCompany->COMPANYEMAIL;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputName2" class="col-sm-2 col-form-label">Contact #</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName2" name="COMPANYCONTACTNO" placeholder="Contact Number" value="<?php echo $singleCompany->COMPANYCONTACTNO;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputSkills" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputSkills" name="C_Username" placeholder="Username" value="<?php echo $singleCompany->C_Username;?>">
      </div>
    </div>
<!--     <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
          </label>
        </div>
      </div>
    </div> -->
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-danger">Save</button>
      </div>
    </div>
  </form>