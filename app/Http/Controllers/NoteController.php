<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function show($id)
    {
        $user = Auth::user();
        if(!is_null($user)) {
            $note = Note::where('user_id', $user->id)->where('id', $id)->first();
            if(!is_null($note)){
                return response()->json([
                    'data' => $note
                ]);
            }
            else {
                return response()->json([
                    'data' => []
                ]);
            }
        }else {
            return response()->json([
                'message' => "Un-authothorized user"
            ]);
        }
    }

    /**
     * @return NoteResourceCollection
     */
    public function index()
    {
        $user = Auth::user();
        if(!is_null($user)) {
            $notes = Note::where('user_id', $user->id)->get();
            if(count($notes) > 0) {
                return response()->json([
                    'data' => $notes
                ]);
            } else {
                return response()->json([
                    'data' => []
                ]);
            }
        } else {
            return response()->json([
                'message' => "Un-authothorized user"
            ]);
        }
    }

    /**
     * @param Request $request
     * @return NoteResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if(!is_null($user)) {
            $validator = Validator::make($request->all(),[
                'note_title' => 'required',
                'note_text' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'validator_errors' => $validator->errors()
                ]);
            }
            $inputs = $request->all();
            $inputs['user_id'] = $user->id;
            $note = Note::create($inputs);
            if(!is_null($note)) {
                return response()->json([
                    'error' => false,
                    'data' => $note
                ]);
            }
            else {
                return response()->json([
                    'error' => false,
                    'message' => "Note not created"
                ]);
            }
            
        } else {
            return response()->json([
                'message' => "Un-authothorized user"
            ]);
        }
    }

    public function update(Request $request, Note $note)
    {
        $user = Auth::user();
        if(!is_null($user)){
            $validator = Validator::make($request->all(), [
                'note_title' => 'required',
                'note_text' => 'required'
            ]);
            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'validators_error' => $validator->errors()
                ]);
            }
            //$note = Note::where('id', $id);
            $note->update($request->all());
            return response()->json([
                'error' => false,
                'message' => "Note updated succesfully",
                'data' => $note
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Un-Authorized user"
            ]);
        }
    }


    public function destroy(Note $note)
    {
        $user = Auth::user();
        if(!is_null($user)) {
            $note = Note::where('id', $note->id)->where('user_id', $user->id)->delete();
            return response()->json([
                'error' => false,
                'message' => "Success! Note deleted"
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => "Un-Authorized user"
            ]);
        }
        $note->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ], 200)
        ->header('Content-Type', 'application/json');

    }
}
