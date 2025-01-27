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
            <a href="{{ route('tasks.create') }}">
              <div class="btn-group">
                <button type="button" class="btn btn-primary">
                    Add Task
                </button>
              </div>
            </a>
          </div>
        </div>

        <div class="table-responsive">
          <table id="file_export" class="table table-bordered nowrap display">
            <thead>
              <tr>
                <th>S. No.</th>
                <th>Task Name</th>
                <th>Assigned To</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Planned Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tasks as $task)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $task->task_name }}</td>
                  <td>{{ $task->member_name }}</td>
                  <td>{{ $task->priority }}</td>
                  <td><span class="badge 
                      @if ($task->status == 'Pending') bg-warning 
                      @elseif ($task->status == 'In-Progress') bg-info 
                      @elseif ($task->status == 'Completed') bg-success 
                      @else bg-secondary @endif">
                          {{ ucfirst($task->status) }}
                      </span>
                  </td>
                  <td>{{ $task->planned_date }}</td>
                  <td style="display: flex;">
                    <!-- Delete Task -->
                    <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="button" onclick="confirmation(event, {{ $task->id }})" class="badge bg-danger me-2" style="border: none;">
                        <i data-feather="trash-2" class="feather-sm fill-white"></i>
                      </button>
                    </form>

                    <!-- Edit Task -->
                    <a href="{{ route('tasks.edit', $task->id) }}" 
                      style="background-color:#6610f2; border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                      <i class="fa-regular fa-pen-to-square" style="color:white;"></i>
                    </a>

                    <!-- View Task -->
                    <a href="{{ route('tasks.show', $task->id) }}" 
                      style="background-color: #6f42c1; border-radius: .3rem; padding: .13rem .6rem; margin-right: .4rem;">
                      <i class="fa-regular fa-eye" style="color: white;"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

          <!-- Pagination -->
          {{ $tasks->links() }}
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

<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Sweet Alert Action -->
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
