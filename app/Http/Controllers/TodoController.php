<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Command\EditCommand;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->user()->id)
            ->orderBy('is_complete', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        //dd($todos);

        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();
        return view('todo.index', compact('todos', 'todosCompleted'));
    }

    public function create()
    {
        return view('todo.create');
    }


    public function store(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
            'is_complete' => 'required',
        ]);

        // practical
        $todo = new Todo();
        $todo->title = $request->title;
        // $todo->description = $request->description;
        $todo->user_id = auth()->user()->id;
        $todo->is_complete = $request->is_complete == '1' ? true : false;
        $todo->save();

        //query bulder way
        // DB::table('todos')->insert([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'user_id' => auth()->user()->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        //eloquent way
        // $todo = Todo::create([
        //     'title' => ucfirst($request->title),
        //     'user_id' => auth()->user()->id,
        //     'is_complete' => '0',
        // ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully');
    }

    public function complete(Todo $todo)
    {
        $todo->is_complete = true;
        $todo->save();

        return redirect()->route('todo.index')->with('success', 'Todo marked as completed');
    }

    public function incomplete(Todo $todo)
    {
        $todo->is_complete = false;
    $todo->save();

    return redirect()->route('todo.index')->with('success', 'Todo marked as incomplete');
    }

    public function edit(Todo $todo)
    {
        if (auth()->user()->id == $todo->user_id) {
            return view('todo.edit', compact('todo'));
        } else {
            return redirect()->route('todo.index')->with('error', 'You are not authorized to edit this todo');
        }
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
        ]);

        //practical
        // $todo->title = $request->title;
        // $todo->save();

        //eloquent way
        $todo->update([
            'title' => ucfirst($request->title),
        ]);
        return redirect()->route('todo.index')->with('success', 'Todo updated successfully');
    }

    public function destroy(Todo $todo)
    {
        if (auth()->user()->id == $todo->user_id) {
            $todo->delete();
            return redirect()->route('todo.index')->with('success', 'Todo deleted successfully');
        } else {
            return redirect()->route('todo.index')->with('error', 'You are not authorized to delete this todo');
        }
    }

    public function destroyCompleted()
    {
        // get all todos for current user where is_completed is true
        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($todosCompleted as $todo) {
            $todo->delete();
        }
        return redirect()->route('todo.index')->with('success', 'All completed todos deleted successfully');
    }
}
