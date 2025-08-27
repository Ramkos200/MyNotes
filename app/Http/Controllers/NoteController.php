<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\NoteBook;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        // $notes = Note::where('user_id', $user_id)->latest('updated_at')->paginate(2);


        //USING RELATIONSHIPS
        //$notes = Auth::user()->notes()->latest('updated_at')->paginate(5);
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);



        // $notes->each(function ($note) {
        //     dump($note->title);
        // });
        return view('notes.index')->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = NoteBook::where('user_id', Auth::id())->get();
        return view('notes.create')->with('notebooks', $notebooks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',

        ]);

        // $note = new Note([
        //     'uuid' => Str::uuid(),
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'text' => $request->text,
        //     'notebook_id' => $request->notebook_id
        // ]);
        //  $note->save();

        //Using Relationships
        $note = Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
            'notebook_id' => $request->notebook_id
        ]);
        return redirect()->route('notes.index')->with('success', 'Note created Successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // if ($note->user_id !== Auth::id()) abort(403);
        //using reltionship
        if (!$note->user()->is(Auth::user())) abort(403);
        //return view('notes.show',['note'=>$note]);
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== Auth::id()) abort(403);
        $notebooks = NoteBook::where('user_id', Auth::id())->get();
        return view('notes.edit')->with('note', $note)->with('notebooks', $notebooks);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) abort(403);
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);
        $note->update([
            'title' => $request->title,
            'text' => $request->text,
            'notebook_id' => $request->notebook_id
        ]);
        return to_route('notes.show', $note)->with('success', 'Note updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) abort(403);
        $note->delete();
        return to_route('notes.index', $note)->with('success', 'Note Moved to Trash sucessfully');
    }
}
