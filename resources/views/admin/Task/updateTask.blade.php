@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">Update Task</center>
        <div class="row mt-4">
              <div class="col-12">
                <form class="form-horizontal" action="{{ route('tasks.update', $task->id) }}" method="post" id="updateTask" novalidate>
                    @csrf
                    @method('PUT')
                    <div style="display:flex; gap:1%">
                      <div class="form-floating mb-3" style="width:50%;">
                        <input type="text" class="form-control form-input-bg" id="task-name" placeholder="Task Name" required name="task_name" value="{{ $task->task_name }}"/>
                        <label for="task-name">Task Name</label>
                        <div class="invalid-feedback">Task name is required</div>
                      </div>
                      <div class="form-floating mb-3" style="width:50%;">
                        <input type="text" class="form-control form-input-bg" id="assigned-to" placeholder="Assigned To" required name="assigned_to" value="{{ $task->assigned_to_name }}"/>
                        <label for="assigned-to">Assigned To</label>
                        <div class="invalid-feedback">Assigned person is required</div>
                      </div>
                    </div>

                    <div style="display:flex; gap:1%">
                      <div class="form-floating mb-3" style="width:50%;">
                        <select class="form-control form-input-bg" id="priority" required name="priority">
                          <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                          <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                          <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        <label for="priority">Priority</label>
                        <div class="invalid-feedback">Priority is required</div>
                      </div>

                      <div class="form-floating mb-3" style="width:50%;">
                        <select class="form-control form-input-bg" id="status" required name="status">
                          <option value="pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                          <option value="in-progress" {{ $task->status == 'In-Progress' ? 'selected' : '' }}>In Progress</option>
                          <option value="completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        <label for="status">Status</label>
                        <div class="invalid-feedback">Status is required</div>
                      </div>
                    </div>

                    <div style="display:flex; gap:1%">
                      <div class="form-floating mb-3" style="width:50%;">
                        <input type="date" class="form-control form-input-bg" id="planned-date" required name="planned_date" value="{{ $task->planned_date }}"/>
                        <label for="planned-date">Planned Date</label>
                        <div class="invalid-feedback">Planned date is required</div>
                      </div>
                      <div class="form-floating mb-3" style="width:50%;">
                        <input type="text" class="form-control form-input-bg" id="assigned-by" placeholder="Assigned By" required name="assigned_by" value="{{ Auth::user()->name }}"/>
                        <label for="assigned-to">Assigned To</label>
                        <div class="invalid-feedback">Assigned person is required</div>
                      </div>
                    </div>

                    <div style="display:flex; gap:1%">
                      <div class="d-flex align-items-stretch" style="width:15%;">
                        <button type="submit" class="btn btn-info d-block w-100">Update</button>
                      </div>
                    </div>
                </form>

                <div class="d-flex align-items-stretch" style="float: inline-end; margin-top: -2.3rem;">
                  <a href="/tasks">
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
    $('#updateTask').on('submit', function (e) {
      var isValid = true;

      // Check for task name
      if ($('#task-name').val().trim() === '') {
        $('#task-name').addClass('is-invalid');
        isValid = false;
      } else {
        $('#task-name').removeClass('is-invalid');
      }

      // Check for assigned to
      if ($('#assigned-to').val().trim() === '') {
        $('#assigned-to').addClass('is-invalid');
        isValid = false;
      } else {
        $('#assigned-to').removeClass('is-invalid');
      }

      // Check for priority
      if ($('#priority').val().trim() === '') {
        $('#priority').addClass('is-invalid');
        isValid = false;
      } else {
        $('#priority').removeClass('is-invalid');
      }

      // Check for status
      if ($('#status').val().trim() === '') {
        $('#status').addClass('is-invalid');
        isValid = false;
      } else {
        $('#status').removeClass('is-invalid');
      }

      // Check for planned date
      if ($('#planned-date').val().trim() === '') {
        $('#planned-date').addClass('is-invalid');
        isValid = false;
      } else {
        $('#planned-date').removeClass('is-invalid');
      }

      if (!isValid) {
        e.preventDefault(); 
      }
    });
  });
</script>
