<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <style>
        /* CSS styles for the task list */
        .task-list {
            list-style-type: none;
            padding: 0;
        }

        .task-list li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #e0e0e0;
            text-decoration: none;
            color: #333;
        }

        .pagination a.active {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Tasks List</h1> 
    <button onclick="window.location.href = '{{ route('task.create') }}';">Create New Task</button>
    <button onclick="window.location.href = '{{ route('task.statistics') }}';">Statistics</button>
    <ul class="task-list">
    @foreach ($tasks as $task)
        <li>
            <h2>{{ $task->title }}</h2>
            <p>Discription: {{ $task->description }}</p>
            <p>Assigned to: {{ $task->assignedTo->name }}</p>
            <p>CreatedBy: {{ $task->createdBy->name }}</p>
        </li>
    @endforeach
    </ul>

    <div class="pagination">
        {{ $tasks->links() }}
    </div>
</body>
</html>