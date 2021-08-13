<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */

    public function userLogin()
    {
        return view('Frontend.pages.login');
    }

        /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    // Display the User registration view.
    public function userRegister()
    {
        return view('Frontend.pages.register');
    }

    // Register New User
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Rules\Password::defaults()],
            'phone' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        $notification = array(
            'message' => 'User Register Successfully',
            'alert-type' => 'success'
        );

        // Toastr Alert
        return back()->with($notification);
    }

    public function check(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $notification = array(
            'message' => 'You are login Successfully',
            'alert-type' => 'success'
        );
        // return redirect()->intended(RouteServiceProvider::HOME);
        return redirect('/redirects')->with($notification);
    }

    public function myAccount()
    {
        return view('Frontend.pages.my-account', [
            'orders' => Order::where('user_id', Auth::id())->simplepaginate(10),
            'wishlist' => Wishlist::get(),
        ]);
    }

    public function userOrder($id)
    {
        return view('Frontend.pages.user-order', [
            'orders' => Order::where('id', $id)->first(),
        ]);
    }
}
