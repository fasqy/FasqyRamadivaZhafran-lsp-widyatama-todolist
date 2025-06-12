<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel To-Do List</title>
    <style>
        body { font-family: sans-serif; padding: 30px; background: #f7f7f7; }
        .task { margin-bottom: 10px; padding: 10px; background: white; border-radius: 5px; display: flex; justify-content: space-between; }
        .done { text-decoration: line-through; color: gray; }
    </style>
</head>
<body>
    <h1>📝 To-Do List</h1>

    <form action="/tasks" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Tugas baru..." required>
        <button type="submit">Tambah</button>
    </form>

    <ul>
        @foreach($tasks as $task)
        <li class="task">
            <form action="/tasks/{{ $task->id }}" method="POST" style="margin:0;">
                @csrf @method('PATCH')
                <button type="submit" style="background:none; border:none;">
                    <span class="{{ $task->completed ? 'done' : '' }}">{{ $task->name }}</span>
                </button>
            </form>
            <form action="/tasks/{{ $task->id }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">🗑</button>
            </form>
        </li>
        @endforeach
    </ul>
</body>
</html>
