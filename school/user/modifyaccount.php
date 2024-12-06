
 
<!--       $school =New School; 
      $school->SCHOOLNAME = $_POST['SCHOOLNAME']; 
      $school->ADDRESS = $_POST['ADDRESS'];   
      $school->EMAILADDRESS = $_POST['EMAILADDRESS'];
      $school->CONTACTNO = $_POST['CONTACTNO']; 
      $school->USERNAME = $_POST['USERNAME'];
      $school->PASS = sha1($_POST['PASS']);
      $school->create();
 -->
   <form class="form-horizontal" action="controller.php?action=edit" method="POST">
    <div class="form-group row">
      <label for="inputName" class="col-sm-2 col-form-label">School Name</label>
      <div class="col-sm-10">
        <input type="text" name="SCHOOLNAME" class="form-control" id="inputName" placeholder="Name" value="<?php echo $singleSchool->SCHOOLNAME;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
      <div class="col-sm-10">
        <textarea class="form-control" id="inputExperience" name="ADDRESS" placeholder="School Address"><?php echo $singleSchool->ADDRESS;?></textarea>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail" name="EMAILADDRESS" placeholder="Email" value="<?php echo $singleSchool->EMAILADDRESS;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputName2" class="col-sm-2 col-form-label">Contact #</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputName2" name="CONTACTNO" placeholder="Contact Number" value="<?php echo $singleSchool->CONTACTNO;?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputSkills" class="col-sm-2 col-form-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputSkills" name="USERNAME" placeholder="Username" value="<?php echo $singleSchool->USERNAME;?>">
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