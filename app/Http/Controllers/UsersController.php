<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Models\User;
use Hash;
class UsersController extends Controller
{

    public function index()
    {

        //filter user
        if ($search = \Request::get('q'))
        {
            $users = User::where(function ($query) use ($search)
            {
                $query->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%");
            })->paginate(20);
        }
        else
        {
            //user list
            $users = User::latest()->paginate(5);
        }

        return $response = ['success' => true, 'data' => $users];

    }



    public function store(Request $request)
    {

        //Validate first

        $validator = $this->validate($request, [
            'name' => 'required|string|max:191', 
            'email' => 'unique:users,email', 'max:255', 
            'password' => 'required|min:8',

        ]);

        

        //Create the user
        $generatedPassword = Str::random(10);
        $user = new User;
        $user->name = strip_tags($request->name);
        $user->email = strip_tags($request->email);
        $user->password = Hash::make($generatedPassword);
        $user->save();

        //return user response
        return $response = ['success' => true, 'message' => 'user created'];

    }



    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $validator = $this->validate($request, [
            'name' => 'required|string|max:191'
        ]);

        $user->name = $request->name;
        $user->save();

        return ['success' => true, 'message' => 'user updated'];
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);
        // delete the user
        $user->delete();

        return ['success' => true, 'message' => 'user deleted'];
    }


        public function login(Request $request)
    {

            $validator = $this->validate($request, [
            'email' => 'required'
            'password' => 'required'
            ]);


         if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
             $user = Auth::user(); 
             $success['name'] =  $user->name;
             $success['email'] =  $user->email;
             return ['success' => true, 'message' => 'User login successfully.', 'data' => $success];

         } 
        else{ 
             return ['success' => false, 'message' => 'invalid email/password.'];

        } 
    }

}

