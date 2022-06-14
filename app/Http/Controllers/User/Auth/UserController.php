<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginFormRequest;
use App\Http\Requests\User\UserSignupFormRequest;
use App\Http\Traits\ImageTrait;
use App\Models\User\Post;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getSignup()
    {
        return view('user.userRegister');
    }

    public function userSignup(UserSignupFormRequest $request)
    {
        try {
            $profile = $this->imageUpload($request, 'profile', 'profile');
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_photo' => $profile,
            ]);
            Auth::guard('user')->login($user);
            return redirect()->route('user.Feed')->with('success', 'Signup Successfull');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary Server Error.');
        }
    }

    public function userFeed()
    {
        return view('user.userFeed');
    }

    public function userLogout()
    {
        try {
            Auth::guard('user')->logout();
            return redirect()->route('user.Login');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary Server Error.');
        }
    }

    public function userLogin(UserLoginFormRequest $request)
    {
        try {
            if (Auth::guard('user')->attempt($request->only('email', 'password'))) {
                return redirect()->route('user.Feed')->with('success', 'Login Successful');
            } else {
                return back()->with('error', 'Please Check Credentials');
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Temporary Server Error.');
        }
    }

    public function userPosts(Request $request)
    {
        $posts = Post::all()->where('user_id', Auth::guard('user')->id());
        return view('user.userPost', array('user' => Auth::guard('user')->user(), 'post' => $posts));
    }

    public function getAccount()
    {
        return view('user.userAccount', ['user' => Auth::guard('user')->user()]);
    }

    public function index()
    {
        //
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
        //
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
        //
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
}
