<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
    <style>
        /* CSS styling for the form */
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .form-container h2 {
            text-align: center;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
        }

        .form-container input[type="text"],
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Create Task</h2>
        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>

            <label for="created_by">Created By:</label>
            <select id="created_by_id" name="created_by_id" required>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>

            <label for="assigned_to">Assigned To:</label>
            <select id="assigned_to_id" name="assigned_to_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button type="submit">Create</button>
        </form>
    </div>
</body>
</html>
