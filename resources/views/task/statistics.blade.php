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
</head>
<body>
    <h1>Task Statistics</h1>
    <button onclick="window.location.href = '{{ route('task.index') }}';">Home</button>
    <table>
        <tr>
            <th>User</th>
            <th>Task Count</th>
        </tr>
        @foreach ($top_users_tasks as $top_users_tasks)
        <tr>
            <td>{{ $top_users_tasks->user->name }}</td>
            <td>{{ $top_users_tasks->tasks_count }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
