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
        ->get();
        //dd($todos);
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

    public function store(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            // 'description' => 'required|string|max:255',
        ]);

        // practical
        // $todo = new Todo();
        // $todo->title = $request->title;
        // $todo->description = $request->description;
        // $todo->user_id = auth()->user()->id;
        // $todo->save();

        //query bulder way
        // DB::table('todos')->insert([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'user_id' => auth()->user()->id,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        //eloquent way
        $todo = Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully');



    }

}
