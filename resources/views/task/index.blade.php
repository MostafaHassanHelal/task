<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tasks List</h1>
        <div class="mb-3">
            <button class="btn btn-primary" onclick="window.location.href = '{{ route('task.create') }}';">Create New Task</button>
            <button class="btn btn-secondary" onclick="window.location.href = '{{ route('task.statistics') }}';">Statistics</button>
        </div>
        <ul class="list-group mb-4">
            @foreach ($tasks as $task)
                <li class="list-group-item mb-3">
                    <h2 class="h5">{{ $task->title }}</h2>
                    <p>Description: {{ $task->description }}</p>
                    <p>Assigned to: {{ $task->assignedTo->name }}</p>
                    <p>CreatedBy: {{ $task->createdBy->name }}</p>
                </li>
            @endforeach
        </ul>

        <nav aria-label="Page navigation example">
           {{ $tasks->links('vendor.pagination.custom') }}
        </nav>
    </div>
</body>
</html>