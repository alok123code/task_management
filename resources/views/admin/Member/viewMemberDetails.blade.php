@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">
    <div class="col-lg-9 col-xl-7 col-md-7">
        <div class="card">
            <div class="card-body">
                <center style="font-size:2rem;">View Member</center>
                <div class="row mt-4">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $member->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone No.</th>
                                <td>{{ $member->phone_no }}</td>
                            </tr>
                            <tr>
                                <th>Add By</th>
                                <td>{{ Auth:: user()->name}}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $member->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $member->updated_at }}</td>
                            </tr>
                        </table>

                        <div class="d-flex align-items-stretch">
                            <a href="{{ route('members.index') }}" class="btn btn-primary">Back to Members</a>
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
