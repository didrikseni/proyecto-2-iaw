<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(json_encode(User::select('name', 'email', 'avatar')->orderBy('name', 'asc')->get()), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(json_encode(User::select('name', 'email', 'avatar')->where('id', $id)->get()), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id', $id)->first();
        if ($request->get('password') != '') {
            return $this->updatePassword();
        } elseif ($request->get('avatar') != null) {
            return $this->updateAvatar();
        } else {
            return $this->updateConfig();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updatePassword() {
        try {
            request()->validate([
                'current_password' => ['required', new MatchOldPassword],
                'password' => 'required|string|min:8',
                'password_confirmation' => 'same:password'
            ]);
            User::find(Auth::id())->update(['password' => Hash::make(request()->password)]);
            Auth::logout();
            return response("Successfully changed password", 200);
        } catch (ValidationException $exception) {
            return response("Error changing the password", 406);
        }
    }

    public function updateAvatar() {
        try {
            request()->validate(['avatar' => 'required|file|size:256']);
            $temp = file_get_contents(request()->file('avatar'));
            $user = auth()->user();
            $user->avatar = base64_encode($temp);
            $user->save();
            return response("Successfully changed avatar", 200);
        } catch (ValidationException $exception) {
            return response("Error changing the avatar", 406);
        }
    }

    public function updateConfig() {
        try {
            $user = Auth::user();
            if (request()->get('name') != "") {
                request()->validate(['name' => 'required|min:3|max:50']);
                $user->name = request()->get('name');
            }
            if (request()->get('email') != "") {
                request()->validate(['name' => 'required|email']);
                $user->email = request()->get('email');
            }
            $user->save();
            return response("Successfully changed configuration", 200);
        } catch (ValidationException $exception) {
            return response("Error changing the configuration", 406);
        }
    }
}
