<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin SignIn | RED STore</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resourses/Rs-logo.svg.png" />
</head>

<body >


  <div class="container py-12 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-12 mt-4" >
        <div class="card rounded-3 text-black " style="background-color: #eee">
          <div class="row g-0">
            <div class="col-lg-9 mt-4">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="resourses/Rs-logo.svg.png"
                    style="width: 90px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">Welcome to Red Store Admins..</h4>
                </div>



                <div class="col-12 col-lg-6 ">
                          <div class="row g-2">

                              <div class="col-12">
                                  <p class="title02">Sign in to your Account.</p>
                              </div>

                             
                                <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="ex : john@gmail.com" id="e" />
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-primary" onclick="adminVerification();">Send Verification Code</button>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <button class="btn btn-danger">Back to Customer Log In</button>
                                </div>
                              
                          </div>
                      </div>

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


     

                      <!-- signin box -->


                        <!--  -->

            <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->


             <!-- footer -->

             <div class="col-12 d-none d-lg-block fixed-bottom">
                  <p class="text-center">&copy;2023 RedStore.lk || ALL Rights Reserved</p>
              </div>

              <!--footer -->
          </div>
      </div>


      <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>