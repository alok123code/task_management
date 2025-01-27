@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">Create a new user</center>
        <div class="row mt-4">
              <div class="col-12">
                <form class="form-horizontal" action="{{ route('users.store') }}" method="post" id="createUser" novalidate>
                    @csrf
                <div style="display:flex; gap:1%">
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-rfname" placeholder="john deo" required name="name" />
                    <label for="tb-rfname">Full Name</label>
                    <div class="invalid-feedback">Full name is required</div>
                  </div>
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="email" class="form-control form-input-bg" id="tb-remail" placeholder="john@gmail.com" required name="email" />
                    <label for="tb-remail">Email</label>
                    <div class="invalid-feedback">Email is required</div>
                  </div>
                </div>
                <div style="display:flex; gap:1%">
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-rphone" placeholder="+123423654" required name="phoneNo" />
                    <label for="tb-rphone">Phone No.</label>
                    <div class="invalid-feedback">Phone No. is required</div>
                  </div>
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="password" class="form-control form-input-bg" id="text-rpassword" placeholder="*****" required name="password" />
                    <label for="text-rpassword">Password</label>
                    <div class="invalid-feedback">Password should have minimum 6 characters</div>
                  </div>
                </div>
                <div style="display:flex; gap:1%">
                  <div class="d-flex align-items-stretch" style="width:15%;">
                    <button type="submit" class="btn btn-info d-block w-100">Create</button>
                  </div>
                </div>
                </form>
                <div class="d-flex align-items-stretch" style="float: inline-end; margin-top: -2.3rem;">
                  <a href="/users">
                    <button type="submit" class="btn btn-danger d-block w-100">cancel</button>
                  </a>
                  </div>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>


@if (session('error'))
    <div class="alert alert-danger" style="margin-left: 258px;
    margin-right: 83px;">
        {{ session('error') }}
    </div>
@endif


<script type="text/javascript">
      $(document).ready(function () {
        $('#createUser').on('submit', function (e) {
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


          if (!isValid) {
            e.preventDefault(); 
          }
        });
      });
</script>
