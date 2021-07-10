<?php

namespace App\Http\Controllers;

use App\Models\Profile as ModelsProfile;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use app\Models\User ;
use app\Models\Profile ;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();

        if ($user == null) {
            return Redirect()->route('register');
        }


        return view('users.profile')->with('user', $user);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'province' => 'required',
            'gender' => 'required',
            'bio' => 'required'
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->profile->province = $request->province;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;
        $user->profile->save();

        if ($request->has('password')) {
            $user->password = crypt($request->password,'rl');
            $user->profile->save();
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
