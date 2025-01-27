@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">Update Member</center>
        <div class="row mt-4">
              <div class="col-12">
                <form class="form-horizontal" action="{{ route('members.update', $member->id) }}" method="post" id="updateMember" novalidate>
                    @csrf
                    @method('PUT')
                <div style="display:flex; gap:1%">
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-rfname" placeholder="Full Name" required name="name" value="{{ $member->name }}"/>
                    <label for="tb-rfname">Full Name</label>
                    <div class="invalid-feedback">Full name is required</div>
                  </div>
                  <div class="form-floating mb-3" style="width:50%;">
                    <input type="text" class="form-control form-input-bg" id="tb-rphone" placeholder="Phone No." required name="phone_no" value="{{ $member->phone_no }}"/>
                    <label for="tb-rphone">Phone No.</label>
                    <div class="invalid-feedback">Phone number is required</div>
                  </div>
                </div>
                <div style="display:flex; gap:1%">
                  <div class="d-flex align-items-stretch" style="width:15%;">
                    <button type="submit" class="btn btn-info d-block w-100">Update</button>
                  </div>
                </div>
                </form>
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
    <div class="alert alert-danger" style="margin-left: 258px;
    margin-right: 83px;">
        {{ session('error') }}
    </div>
@endif

<script type="text/javascript">
      $(document).ready(function () {
        $('#updateMember').on('submit', function (e) {
          var isValid = true;

          // Check for full name
          if ($('#tb-rfname').val().trim() === '') {
            $('#tb-rfname').addClass('is-invalid');
            isValid = false;
          } else {
            $('#tb-rfname').removeClass('is-invalid');
          }

          // Check for phone number
          var phone = $('#tb-rphone').val().trim();
          if (phone === '' || isNaN(phone)) {
            $('#tb-rphone').addClass('is-invalid');
            isValid = false;
          } else {
            $('#tb-rphone').removeClass('is-invalid');
          }

          if (!isValid) {
            e.preventDefault(); 
          }
        });
      });
</script>
