@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">User Profile</center>
        <div class="d-flex gap-2 align-items-center">
            <span class="fs-6 fw-bold">Name : </span>
            <span class="fs-5">{{$user->name}}</span>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="fs-6 fw-bold">Email : </span>
            <span class="fs-5">{{$user->email}}</span>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="fs-6 fw-bold">Phone No. : </span>
            <span class="fs-5">{{$user->phoneNo}}</span>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="fs-6 fw-bold">Password : </span>
            <span class="fs-5">{{$user->password}}</span>
        </div>
      </div>
    </div>
  </div>
</div>



