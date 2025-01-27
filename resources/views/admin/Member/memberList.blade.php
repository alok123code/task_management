@include('admin.dashboard')
<style>
  .pagination {
    float: inline-end;
  }
</style>
<div class="container-fluid" style="margin-left:240px; margin-top:85px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <div class="d-flex no-block align-items-center mb-4">
          <div class="ms-auto">
            <a href="members/create">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Member
                </button>
            </div>
            </a>
          </div>
        </div>
        <div class="table-responsive">
          <table
            id="file_export"
            class="table table-bordered nowrap display">
            <thead>
              <tr>
                <th>S. No.</th>
                <th>Member Name</th>
                <th>Phone No.</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                  <td>{{ $member->id }}</td>
                  <td>{{ $member->name }}</td>
                  <td>{{ $member->phone_no }}</td>
                  <td style="display: flex;">
                  <form id="delete-form-{{ $member->id }}" action="{{ route('members.destroy', $member->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                    <button type="button" onclick="confirmation(event, {{ $member->id }})" class="badge bg-danger me-2" style="border: none;">
                    <i data-feather="trash-2" class="feather-sm fill-white"></i>
                    </button>
                  </form>
                  <a href="{{ route('members.edit', $member->id) }}" 
                    style=" background-color:#6610f2; border-radius: .3rem;padding: .13rem .6rem; margin-right: .4rem;">
                    <i class="fa-regular fa-pen-to-square" style="color:white;"></i>
                  </a>
                  <a href="{{ route('members.show', $member->id) }}" style="background-color: #6f42c1; border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                    <i class="fa-regular fa-eye" style="color: white;"></i>
                  </a>
                  </td>
                </tr>
            @endforeach
            </tbody>
          </table>
          {{ $members->links() }}
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

<!-- sweet alert  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- sweet alert action -->
<script type="text/javascript">
    function confirmation(ev, id) {
    ev.preventDefault(); 
    swal({
        title: "Are you sure you want to delete this?",
        text: "You will not be able to revert this!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            document.getElementById('delete-form-' + id).submit(); 
        }
    });
}
</script>
