<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('list.css') }}">
    <title>Task List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="row d-flex justify-content-center container">
        <div class="col-md-8">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        <i class="fa fa-tasks"></i>&nbsp;Task Lists
                    </div>
                </div>
                <div class="scroll-area-sm">
                    <perfect-scrollbar class="ps-show-limits">
                        <div style="position: static;" class="ps ps--active-y">
                            <div class="ps-content">
                                <ul class="list-group list-group-flush">
                                    @foreach ($tasks as $task)
                                        <li class="list-group-item">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-2">
                                                        <div class="custom-checkbox custom-control">
                                                            <input class="custom-control-input" id="task-{{ $task->id }}" type="checkbox" {{ $task->completed ? 'checked' : '' }} onchange="updateTask({{ $task->id }}, this.checked);">
                                                            <label class="custom-control-label" for="task-{{ $task->id }}">&nbsp;</label>
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">{{ $task->title }}</div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        <button class="btn btn-outline-info" data-toggle="modal" data-target="#editModal-{{ $task->id }}">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="border-0 btn-transition btn btn-outline-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="update-form-{{ $task->id }}" action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="completed" value="{{ $task->completed ? 0 : 1 }}">
                                            </form>
                                        </li>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="text" name="title" class="form-control" value="{{ $task->title }}" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </perfect-scrollbar>
                </div>
                <div class="d-block text-right card-footer">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="title" class="form-control" placeholder="Add new task" required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add Task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateTask(taskId, isCompleted) {
            $.ajax({
                url: '/tasks/' + taskId,
                type: 'POST',
                data: {
                    _method: 'PUT',
                    _token: '{{ csrf_token() }}',
                    completed: isCompleted ? 1 : 0
                },
                success: function(response) {
                    console.log('Task updated successfully');
                },
                error: function(xhr) {
                    console.error('Error updating task:', xhr);
                }
            });
        }
    </script>
</body>
</html>
