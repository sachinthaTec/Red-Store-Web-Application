<!DOCTYPE html>

<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> RED STore</title>
      <link rel="icon" href="resourses/Rs-logo.svg.png">
      <link rel="stylesheet" href="bootstrap.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="style.css">

  </head>

 <body>

 <section class="h-100 gradient-form" style="background-color: white;">
  <div class="container py-12 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12" >
        <div class="card rounded-3 text-black" style="background-color: #eee">
          <div class="row g-0">
            <div class="col-lg-9">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="resourses/Rs-logo.svg.png"
                    style="width: 90px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Welcome Red Store Team...</h4>
                </div>

                
                
                <!--signup box-->
                <div class="col-12 col-lg-6" id="SignUpBox">
                          <div class="row g-2">

                              <div class="col-12">
                                  <p class="title02">Create New Account.</p>
                              </div>
                              <div class="col-12 d-none" id="msgdiv">
                                  <div class="alert alert-danger" role="alert" id="msg">

                                  </div>
                              </div>
                              <div class="col-6">
                                  <label class="form-label">First Name</label>
                                  <input class="form-control" type="text" placeholder="ex:Jhon" id="fname" />
                              </div>
                              <div class="col-6">
                                  <label class="form-label">Last Name</label>
                                  <input class="form-control" type="text" placeholder="ex:Silva" id="lname" />

                              </div>
                              <div class="col-6">
                                  <label class="form-label">Email</label>
                                  <input class="form-control" type="email" placeholder="ex:Jhon@gmail.com" id="email" />
                              </div>

                              <div class="col-6">
                                  <label class="form-label">Password</label>
                                  <input class="form-control" type="password" placeholder="***********" id="password" />

                              </div>

                              <div class="col-6">
                                  <label class="form-label">Mobile</label>
                                  <input class="form-control" type="text" placeholder="0700000000" id="mobile" />

                              </div>
                              <div class="col-6">
                                  <label class="form-label">Gender</label>
                                  <select class="form-control" id="gender">
                                      <option value="0">Select your Gender</option>
                                      <?php
                                        require "connection.php";

                                        $rs = Database::search("SELECT * FROM `gender`");
                                        $n = $rs->num_rows;

                                        for ($x = 0; $x < $n; $x++) {
                                            $d = $rs->fetch_assoc();

                                        ?>

                                          <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                      <?php

                                        }

                                        ?>
                                  </select>

                              </div>
                              <div class="col-12 col-lg-6 d-grid">
                                  <button class="btn btn-primary" onclick="signUp();"> Sign Up</button>
                              </div>
                              <div class="col-12 col-lg-6 d-grid">
                                  <button class="btn btn-dark" onclick="ChangeView();">
                                      Already have an Account? Sign In</button>
                              </div>

                          </div>
                      </div>
                      
                      <!--signup box-->
                      <!-- signin box -->
                      <div class="col-12 col-lg-6 d-none" id="SignInBox">
                          <div class="row g-2">

                              <div class="col-12">
                                  <p class="title02">Sign in to your Account.</p>
                              </div>

                              <?php
                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }
                                ?>

                              <div class="col-12">
                                  <label class="form-label">Email</label>
                                  <input class="form-control" type="email" id="email2" value="<?php echo $email; ?>" placeholder="ex:Jhon@gmail.com" />
                              </div>

                              <div class="col-12">
                                  <label class="form-label">Password</label>
                                  <input class="form-control" type="password" id="password2" value="<?php echo $password; ?>" placeholder="12345678" />
                              </div>

                              <div class="col-6">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                      <label class="form-check-label" for="rememberme">
                                          Remember Me
                                      </label>
                                  </div>
                              </div>
                              <div class="col-6 text-end">
                                  <a href="#" class="link-primary" onclick="forgotPassword();"> Forgotten Password?</a>
                              </div>

                              <div class="col-12 col-lg-6 d-grid">
                                  <button class="btn btn-primary" onclick="signin();"> Sign In</button>
                              </div>
                              <div class="col-12 col-lg-6 d-grid">
                                  <button class="btn btn-danger" onclick="ChangeView();"> New to eshop? Join Now </button>
                              </div>
                          </div>
                      </div>

                      <!-- signin box -->

                

              </div>
            </div>
            <div class="col-lg-3 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We are more than just a company</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                  exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <!-- modal -->
 <div class="modal" tabindex="-1" id="forgotPasswordModal">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">Forgot Password?</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <div class="row g-3">

                                  <div class="col-6">
                                      <label class="form-label">New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="np" />
                                          <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showpassword();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-6">
                                      <label class="form-label">Retype New Password</label>
                                      <div class="input-group mb-3">
                                          <input type="password" class="form-control" id="rnp" />
                                          <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showpassword2();">
                                              <i class="bi bi-eye"></i>
                                          </button>
                                      </div>
                                  </div>

                                  <div class="col-12">
                                      <label class="form-label">Verifiction Code</label>
                                      <input type="text" class="form-control" id="vc" />
                                  </div>

                              </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- modal -->

              <!-- footer -->

              <div class="col-12 d-none d-lg-block fixed-bottom">
                  <p class="text-center">&copy;2023 RedStore.lk || ALL Rights Reserved</p>
              </div>

              <!--footer -->
          </div>
      </div>





      <script src="script.js"></script>
      <script src="bootstrap.js"></script>
  </body>

  </html>

 