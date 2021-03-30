<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
class NotesController extends Controller
{

    public function index()
    {

        //filter note
        if ($search = \Request::get('q'))
        {
            $notes = Note::where(function ($query) use ($search)
            {
                $query->where('name', 'LIKE', "%$search%");
            })->paginate(20);
        }
        else
        {
            //notes list
            $notes = Note::latest()->paginate(5);
        }

        return ['success' => true, 'data' => $notes];

    }



    public function store(Request $request)
    {

        //Validate first

        $this->validate($request, [
            'name' => 'required|string|max:255', 
            'description' => 'required',

        ]);


        //Create the Note
        $note = new Note;
        $note->name = strip_tags($request->name);
        $note->description = $request->description;
        $note->note_id = $request->note_id;
        $note->save();

        //return note response
        return $response = ['success' => true, 'message' => 'note created'];

    }



    public function update(Request $request, $id)
    {

        $note = Note::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191'
        ]);


        $note->name = $request['name'];
        $note->save();
        
        return ['success' => true, 'message' => 'note updated'];
    }


        public function mark_note(Request $request, $id)
    {

        $note = Note::findOrFail($id);

        $this->validate($request, [
            'user_id' => 'required'
        ]);


        $note->user_id = $request->user_id;
        $note->save();
        
        return ['success' => true, 'message' => 'note updated'];
    }

    public function destroy($id)
    {

        $note = Note::findOrFail($id);
        // delete the user
        $note->delete();

        return ['success' => true, 'message' => 'note deleted'];
    }

}

