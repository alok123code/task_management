@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">Create a New Member</center>
        <div class="row mt-4">
          <div class="col-12">
            <form class="form-horizontal" action="{{ route('members.store') }}" method="post" id="createMember" novalidate>
                @csrf
                <div style="display:flex; gap:1%">
                  <!-- Full Name Field -->
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-mfname" placeholder="John Doe" required name="name" />
                    <label for="tb-mfname">Full Name</label>
                    <div class="invalid-feedback">Full name is required</div>
                  </div>

                  <!-- Phone Number Field -->
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-mphone" placeholder="+123456789" required name="phone_no" />
                    <label for="tb-mphone">Phone No.</label>
                    <div class="invalid-feedback">Phone number is required</div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div style="display:flex; gap:1%">
                  <div class="d-flex align-items-stretch" style="width:15%;">
                    <button type="submit" class="btn btn-info d-block w-100">Create</button>
                  </div>
                </div>
            </form>

            <!-- Cancel Button -->
            <div class="d-flex align-items-stretch" style="float: inline-end; margin-top: -2.3rem;">
              <a href="/members">
                <button type="button" class="btn btn-danger d-block w-100">Cancel</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@if (session('error'))
    <div class="alert alert-danger" style="margin-left: 258px; margin-right: 83px;">
        {{ session('error') }}
    </div>
@endif

<script type="text/javascript">
    $(document).ready(function () {
        $('#createMember').on('submit', function (e) {
            var isValid = true;

            // Check for full name
            if ($('#tb-mfname').val().trim() === '') {
                $('#tb-mfname').addClass('is-invalid');
                isValid = false;
            } else {
                $('#tb-mfname').removeClass('is-invalid');
            }

            // Check for phone number
            var phone = $('#tb-mphone').val().trim();
            if (phone === '' || isNaN(phone)) {
                $('#tb-mphone').addClass('is-invalid');
                isValid = false;
            } else {
                $('#tb-mphone').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault(); 
            }
        });
    });
</script>
