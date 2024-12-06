 

     <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">

                          <h4>Login</h4>
                          
                  <button class="close" data-dismiss="modal" type=
                  "button">×</button>
 
                </div>

                <!-- <form action="process.php?action=login" enctype="multipart/form-data" method="post"> -->
                  <div class="modal-body hold-transition login-page">
                   
 
 
 
  
<div id="exTab3" class="container"> 
<ul  class="nav nav-pills">
      <li class="active">
        <a  href="#1b"  id="tab-1" data-toggle="tab" class="btn" style="background: blue;color: white">Login for School</a>
      </li>
      <li><a href="#2b"  id="tab-2" data-toggle="tab" class="btn">Login for Agency</a>
      </li> 
    </ul>

      <div class="tab-content clearfix">
        <div class="tab-pane active " id="1b">
            <div id="loginerrormessage"></div>
                          <p>School</p>
                    <div class="login-box"> 
                        <div class="login-box-body" style="border: solid 1px #ddd;padding: 35px;min-height: 350px;"> 
                          <form action="" method="post" autocomplete="off">
                            <div class="form-group has-feedback">
                              <input type="text" class="form-control" placeholder="Username" name="user_email" id="user_email">
                              <span class="fa fa-user form-control-feedback" style="margin-top: -22px;"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <input type="password" class="form-control" placeholder="Password" name="user_pass" id="user_pass">
                              <span class="fa fa-lock form-control-feedback" style="margin-top: -22px;"></span>
                            </div>
                           <div class="col-xs-12">
                                <div class="checkbox icheck">
                                  <label>
                                    <input type="checkbox"> Remember Me
                                  </label>
                                </div>
                              </div>
                              <!-- /.col -->
                          </form>  
                              <div class="col-xs-12"> 
                                    <button class="btn btn-primary" name="btnlogin" id="btnlogin"  >Login</button>
                              </div>

                        </div>
                        <!-- /.login-box-body -->
                      </div>

        </div>
        <div class="tab-pane" id="2b">
            <div id="loginerrormessageagency"></div>
                             <p>Agency</p>
                    <div class="login-box"> 
                        <div class="login-box-body" style="border: solid 1px #ddd;padding: 35px;min-height: 350px;"> 
                          <form action="" method="post" autocomplete="off">
                            <div class="form-group has-feedback">
                              <input type="text" class="form-control" placeholder="Username" name="agency_user_email" id="agency_user_email">
                              <span class="fa fa-user form-control-feedback" style="margin-top: -22px;"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <input type="password" class="form-control" placeholder="Password" name="agency_user_pass" id="agency_user_pass">
                              <span class="fa fa-lock form-control-feedback" style="margin-top: -22px;"></span>
                            </div> 
                              <div class="col-xs-12">
                                <div class="checkbox icheck">
                                  <label>
                                    <input type="checkbox"> Remember Me
                                  </label>
                                </div>
                              </div>
                              <!-- /.col -->
                        
                              <!-- /.col --> 
                          </form> 
                            <div class="col-xs-12"> 
                                    <button class="btn btn-primary" name="btnloginagency" id="btnloginagency"  >Login</button>
                              </div>

                        </div>
                        <!-- /.login-box-body -->
                      </div>

        </div> 
      </div>
  </div>

                  </div>

                  <div class="modal-footer">
                      Copyright 2021
                  </div>
                <!-- </form> -->
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->




<!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>



<script type="text/javascript">
  $("#tab-1").click(function(){
    $("#tab-1").css({"background-color":"blue"});
    $("#tab-1").css({"color": "white"});
    // $("#1b").show(); 
    // $("#1b").fadeIn("slow");
    // $("#2b").hide();

    

    $("#tab-2").css({"background-color":"white"});
    $("#tab-2").css({"color": "blue"});
  })

  $("#tab-2").click(function(){
    $("#tab-2").css({"background-color":"blue"});
    $("#tab-2").css({"color": "white"}); 
    $("#tab-1").css({"background-color":"white"});
    $("#tab-1").css({"color": "blue"});


    // $("#2b").show(); 
    // $("#2b").fadeIn("slow");
    // $("#1b").hide();
  })
</script>