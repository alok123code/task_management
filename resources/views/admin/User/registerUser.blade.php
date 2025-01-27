<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Material Pro Template by WrapPixel</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png" />
    <link href="../../dist/css/style.min.css" rel="stylesheet" />
  </head>

  <body>
    <div class="main-wrapper">
      <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
        style="background: url(../../assets/images/big/auth-bg.jpg) no-repeat center center;">
        <div class="auth-box p-4 bg-white rounded" style="margin: 5% 0% !important;">
          <div>
            <div class="logo text-center">
              <span class="db">
                <img style="width:22%; border-radius:24%;" src="../../assets/images/restaurentLogo.jpg" alt="logo" />
              </span>
              <h5 class="font-weight-medium mb-3 mt-1">Register a new user</h5>
            </div>
           
            @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
            @endif
            
            <div class="row mt-4">
              <div class="col-12">
                <form class="form-horizontal" action="{{ url('/register') }}" method="post" id="registrationForm" novalidate>
                    @csrf
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input-bg" id="tb-rfname" placeholder="john deo" required name="name" />
                    <label for="tb-rfname">Full Name</label>
                    <div class="invalid-feedback">Full name is required</div>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control form-input-bg" id="tb-remail" placeholder="john@gmail.com" required name="email" />
                    <label for="tb-remail">Email</label>
                    <div class="invalid-feedback">Email is required</div>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control form-input-bg" id="tb-rphone" placeholder="+123423654" required name="phoneNo" />
                    <label for="tb-rphone">Phone No.</label>
                    <div class="invalid-feedback">Phone No. is required</div>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control form-input-bg" id="text-rpassword" placeholder="*****" required name="password" />
                    <label for="text-rpassword">Password</label>
                    <div class="invalid-feedback">Password should have minimum 6 characters</div>
                  </div>
                  <div class="checkbox checkbox-primary mb-3">
                    <input id="checkbox-signup" type="checkbox" class="chk-col-indigo material-inputs" name="checkbox-signup" />
                    <label for="checkbox-signup">I agree to all <a href="#">Terms</a></label>
                    <div class="invalid-feedback">You must accept the terms</div>
                  </div>
                  <div class="d-flex align-items-stretch">
                    <button type="submit" class="btn btn-info d-block w-100">Create</button>
                  </div>
                  <div class="text-center m-4">
                    Already have an account? <a href="/login">Login now</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../../dist/libs/jquery/dist/jquery.min.js"></script>
    <script src="../../dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {
        $('#registrationForm').on('submit', function (e) {
          var isValid = true;

          // Check for full name
          if ($('#tb-rfname').val().trim() === '') {
            $('#tb-rfname').addClass('is-invalid');
            isValid = false;
          } else {
            $('#tb-rfname').removeClass('is-invalid');
          }

          // Check for email
          var email = $('#tb-remail').val().trim();
          var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
          if (email === '' || !emailPattern.test(email)) {
            $('#tb-remail').addClass('is-invalid');
            isValid = false;
          } else {
            $('#tb-remail').removeClass('is-invalid');
          }

          // Check for phone number
          var phone = $('#tb-rphone').val().trim();
          if (phone === '' || isNaN(phone)) {
            $('#tb-rphone').addClass('is-invalid');
            isValid = false;
          } else {
            $('#tb-rphone').removeClass('is-invalid');
          }

          // Check for password
          if ($('#text-rpassword').val().trim() === '' || $('#text-rpassword').val().length < 6) {
            $('#text-rpassword').addClass('is-invalid');
            isValid = false;
          } else {
            $('#text-rpassword').removeClass('is-invalid');
          }

          // Check for terms acceptance
          if (!$('#checkbox-signup').is(':checked')) {
            $('#checkbox-signup').addClass('is-invalid');
            isValid = false;
          } else {
            $('#checkbox-signup').removeClass('is-invalid');
          }

          if (!isValid) {
            e.preventDefault(); 
          }
        });
      });
    </script>
  </body>
</html>
