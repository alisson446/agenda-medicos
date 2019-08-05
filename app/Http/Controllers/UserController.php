<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\aclService;
use App\Services\UserService;
use App\User;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function login(Request $request)
    {
        return view("login", [
            'email' => $request->get("email")
        ]);
    }

    public function makeLogin(Request $request)
    {
        $email = $request->get("email");
        $password = $request->get("password");
        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            return redirect("/");
        } else {
            return redirect()->route("login", ["email" => $email]);
        }
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route("login");

    }

    public function index(Request $request)
    {
        $redirect = $request->get('redirect');
        if (isset($redirect)) {
            $redirect = $redirect == "server" ? "painel" : $redirect;
            return redirect()->route($redirect, []);
        }

        return view("user.index");
    }

    public function getUsers()
    {
        return $this->userService->getAll();
    }

    public function getLogeUser ()
    {
        return Auth::user()->email;
    }

    public function makeAdd(Request $request)
    {
        $id = $request->get("id");

        if ($id) {
            $this->userService->update($request->all(),$id);
        } else {
            $this->userService->create($request->all());
        }

        return $this->userService->getAll();
    }

    public function delete($id)
    {
        $this->userService->delete($id);
    }

}
