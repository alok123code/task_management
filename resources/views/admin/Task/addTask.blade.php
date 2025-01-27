@include('admin.dashboard')

<div class="container-fluid" style="margin-left:240px; margin-top:115px">     
  <div class="col-lg-9 col-xl-7 col-md-7">
    <div class="card">
      <div class="card-body">
        <center style="font-size:2rem;">Create a New Task</center>
        <div class="row mt-4">
          <div class="col-12">
            <form class="form-horizontal" action="{{ route('tasks.store') }}" method="post" id="createTask" novalidate>
              @csrf
              <div style="display:flex; gap:1%">
                <div class="form-floating mb-3" style="width:50%;">
                  <input type="text" class="form-control form-input-bg" id="tb-taskdesc" placeholder="Task name" required name="task_name" />
                  <label for="tb-taskdesc">Task Name</label>
                  <div class="invalid-feedback">Task Name is required</div>
                </div>
                <div class="form-floating mb-3" style="width:50%;">
                  <input type="date" class="form-control form-input-bg" id="tb-taskduedate" required name="due_date" />
                  <label for="tb-taskduedate">Due Date</label>
                  <div class="invalid-feedback">Due date is required</div>
                </div>
              </div>
              <div style="display:flex; gap:1%">
                <div class="form-floating mb-3" style="width:50%;">
                  <select class="form-select form-input-bg" id="tb-taskpriority" required name="priority">
                    <option value="low" selected>Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                  </select>
                  <label for="tb-taskpriority">Task Priority</label>
                  <div class="invalid-feedback">Task priority is required</div>
                </div>
                <div class="form-floating mb-3" style="width:50%;">
                  <select class="form-select form-input-bg" id="tb-taskstatus" required name="status">
                    <option value="pending" selected>Pending</option>
                    <option value="in-progress">In - Progress</option>
                    <option value="completed">Completed</option>
                  </select>
                  <label for="tb-taskstatus">Task Status</label>
                  <div class="invalid-feedback">Task status is required</div>
                </div>
              </div>
              <div style="display:flex; gap:1%">
                <div class="form-floating mb-3" style="width:50%;">
                  <select class="form-select form-input-bg" id="tb-assignedto" required name="assigned_to">
                    <option value="">Select Assigned To</option>
                    @foreach ($members as $member)
                      <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                  </select>
                  <label for="tb-assignedto">Assigned To</label>
                  <div class="invalid-feedback">Assigned To is required</div>
                </div>
                <div class="form-floating mb-3" style="width:50%;">
                  <select class="form-select form-input-bg" id="tb-assignedby" required name="assigned_by">
                    <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                  </select>
                  <label for="tb-assignedby">Assigned By</label>
                  <div class="invalid-feedback">Assigned By is required</div>
                </div>
              </div>
              <div style="display:flex; gap:1%">
                <div class="d-flex align-items-stretch" style="width:15%;">
                  <button type="submit" class="btn btn-info d-block w-100">Create</button>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createTask');

    form.addEventListener('submit', function (event) {
      let isValid = true;

      // Elements to validate
      const fields = ['tb-taskdesc', 'tb-taskduedate', 'tb-taskpriority', 'tb-taskstatus', 'tb-assignedto', 'tb-assignedby'];

      fields.forEach(field => {
        const element = document.getElementById(field);
        if (element.value.trim() === '') {
          element.classList.add('is-invalid');
          isValid = false;
        } else {
          element.classList.remove('is-invalid');
        }
      });

      if (!isValid) {
        event.preventDefault();
      }
    });
  });
</script>
