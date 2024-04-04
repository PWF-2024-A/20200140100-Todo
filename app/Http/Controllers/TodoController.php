<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Command\EditCommand;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->user()->id)
            ->orderBy('is_complete', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($todos);
        return view('todo.index', compact('todos'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function edit()
    {
        return view('todo.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255'
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->user_id = auth()->user()->id;
        $todo->save();

        // DB::table('todos')->insert([
        //     'title' => $request->title,
        //     'user_id' => auth()->user()->id,
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        $todo = Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully');
    }
}
