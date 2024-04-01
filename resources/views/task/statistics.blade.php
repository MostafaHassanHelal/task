<!DOCTYPE html>
<html>
<head>
    <title>Task Statistics</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tasks Statistics</h1>
        <div class="mb-3">
            <button class="btn btn-secondary" onclick="window.location.href = '{{ route('task.index') }}';">Home</button>
        </div>
        <table class="table">
            <tr>
                <th scope="col">User</th>
                <th scope="col">Task Count</th>
            </tr>
            @foreach ($top_users_tasks as $top_users_tasks)
            <tr>
                <td>{{ $top_users_tasks->user->name }}</td>
                <td>{{ $top_users_tasks->tasks_count }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
