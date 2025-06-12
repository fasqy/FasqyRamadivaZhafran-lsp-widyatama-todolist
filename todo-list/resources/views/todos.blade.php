<!-- File: resources/views/todos.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Todo List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        
        .header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .todo-form {
            padding: 25px 20px;
            border-bottom: 1px solid #eee;
        }
        
        .todo-input-container {
            display: flex;
            gap: 10px;
        }
        
        .todo-input {
            flex: 1;
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1.1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        
        .todo-input:focus {
            border-color: #6a11cb;
        }
        
        .add-btn {
            background: #6a11cb;
            color: white;
            border: none;
            padding: 0 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.3s;
        }
        
        .add-btn:hover {
            background: #5a0db9;
        }
        
        .todo-list {
            list-style: none;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .todo-item {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid #eee;
            transition: background 0.2s;
        }
        
        .todo-item:hover {
            background-color: #f9f9f9;
        }
        
        .todo-checkbox {
            margin-right: 15px;
            width: 22px;
            height: 22px;
            cursor: pointer;
        }
        
        .todo-text {
            flex: 1;
            font-size: 1.1rem;
            color: #333;
        }
        
        .todo-text.completed {
            text-decoration: line-through;
            color: #888;
        }
        
        .todo-date {
            font-size: 0.85rem;
            color: #777;
            margin-top: 5px;
        }
        
        .delete-btn {
            background: none;
            border: none;
            color: #ff4757;
            cursor: pointer;
            font-size: 1.4rem;
            padding: 5px;
            transition: color 0.2s;
        }
        
        .delete-btn:hover {
            color: #ff2e43;
        }
        
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #777;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #555;
        }
        
        .empty-state p {
            font-size: 1.1rem;
        }
        
        .footer {
            padding: 18px 20px;
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .todo-count {
            font-size: 1rem;
            color: #555;
        }
        
        .clear-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            transition: background 0.3s;
        }
        
        .clear-btn:hover {
            background: #e8414d;
        }
        
        @media (max-width: 600px) {
            .todo-input-container {
                flex-direction: column;
            }
            
            .add-btn {
                padding: 14px;
            }
            
            .footer {
                flex-direction: column;
                gap: 15px;
            }
            .edit-btn {
    background: none;
    border: none;
    color: #3498db;
    cursor: pointer;
    font-size: 1.1rem;
    padding: 5px;
    transition: color 0.2s;
}

.edit-btn:hover {
    color: #1d6fa5;
}

        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Aplikasi Daftar Tugas</h1>
            <p>Selamat Datang Di Website Fasqy</p>
        </div>

        <div class="todo-form">
            <form action="{{ route('todos.store') }}" method="POST" class="todo-input-container">
                @csrf
                <input 
                    type="text" 
                    name="title"
                    placeholder="What needs to be done?" 
                    class="todo-input"
                    autocomplete="off"
                    required
                >
                <button type="submit" class="add-btn">Tambah Tugas</button>
            </form>
        </div>

        @if(count($todos) > 0)
            <ul class="todo-list">
                @foreach($todos as $todo)
                    <li class="todo-item">
                        <form action="{{ route('todos.toggle', $todo['id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input 
                                type="checkbox" 
                                class="todo-checkbox"
                                onChange="this.form.submit()"
                                {{ $todo['completed'] ? 'checked' : '' }}
                            >
                        </form>
                        <div>
                            <div class="todo-text {{ $todo['completed'] ? 'completed' : '' }}">
                                {{ $todo['title'] }}
                            </div>
                            <div class="todo-date">
                                Added: {{ $todo['created_at'] }}
                            </div>
                        </div>
                        <form action="{{ route('todos.destroy', $todo['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">x</button>
                        </form>
                        <form action="{{ route('todos.edit', $todo['id']) }}" method="GET">
                        <button type="submit" class="edit-btn">✏️</button>
</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="empty-state">
                <h3>No tasks yet</h3>
                <p>Add your first task using the input above</p>
            </div>
        @endif

        @if(count($todos) > 0)
            <div class="footer">
                <div class="todo-count">
                    {{ count(array_filter($todos, fn($todo) => $todo['completed'])) }} of {{ count($todos) }} tasks completed
                </div>
                <form action="{{ route('todos.clear') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="clear-btn">Clear Completed</button>
                </form>
                <form action="{{ route('todos.edit', $todo['id']) }}" method="GET">
                <button type="submit" class="delete-btn" style="color: #3498db;">✏️</button>
                </form>

            </div>
        @endif
    </div>
</body>
</html>