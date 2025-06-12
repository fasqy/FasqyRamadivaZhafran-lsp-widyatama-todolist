<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    public function index(Request $request)
    {
    $todos = $request->session()->get('todos');

    if (!$todos) {
        // Data awal
        $todos = [
            [
                'id' => '1',
                'title' => 'Belajar PHP',
                'completed' => false,
                'created_at' => now()->toDateTimeString()
            ],
            [
                'id' => '2',
                'title' => 'Kerjakan tugas UX',
                'completed' => true,
                'created_at' => now()->toDateTimeString()
            ],
        ];

        $request->session()->put('todos', $todos);
    }

    return view('todos', compact('todos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todos = $request->session()->get('todos', []);
        
        $todos[] = [
            'id' => Str::random(10),
            'title' => $request->title,
            'completed' => false,
            'created_at' => now()->toDateTimeString()
        ];

        $request->session()->put('todos', $todos);

        return redirect()->back();
    }

    // Gabungkan kedua fungsi update menjadi satu
    public function update(Request $request, $id)
    {
        $todos = $request->session()->get('todos', []);

        foreach ($todos as $index => &$todo) {
            if ($todo['id'] === $id) {
                // Jika ada input title, update title
                if ($request->has('title')) {
                    $request->validate([
                        'title' => 'required|string|max:255',
                    ]);
                    $todo['title'] = $request->title;
                } else {
                    // Jika tidak, toggle status completed
                    $todo['completed'] = !$todo['completed'];
                }
                break;
            }
        }

        $request->session()->put('todos', $todos);

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $todos = $request->session()->get('todos', []);

        $todos = array_filter($todos, function ($todo) use ($id) {
            return $todo['id'] !== $id;
        });

        $request->session()->put('todos', array_values($todos));

        return redirect()->back();
    }
    
    public function clearCompleted(Request $request)
    {
        $todos = $request->session()->get('todos', []);
        
        $todos = array_filter($todos, function ($todo) {
            return !$todo['completed'];
        });

        $request->session()->put('todos', array_values($todos));

        return redirect()->back();
    }

    public function edit($id)
    {
        $todos = session('todos', []);
        $todo = collect($todos)->firstWhere('id', $id);

        if (!$todo) {
            return redirect()->route('todos.index')->withErrors('Todo not found.');
        }

        return view('edit', compact('todo'));
    }
}