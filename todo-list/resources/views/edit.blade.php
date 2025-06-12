<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            color: #6a11cb;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"] {
            padding: 14px 18px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1.1rem;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #6a11cb;
        }

        .btn {
            background: #6a11cb;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #5a0db9;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #2575fc;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .back-link a:hover {
            color: #1a5edb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Tugas</h2>
        <form action="{{ route('todos.update', $todo['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{ $todo['title'] }}" required>
            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>

        <div class="back-link">
            <a href="{{ route('todos.index') }}">← Kembali ke daftar tugas</a>
        </div>
    </div>
</body>
</html>
