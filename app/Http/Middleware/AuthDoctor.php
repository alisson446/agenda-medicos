<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use App\Services\aclService;

class AuthDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
//            $page = str_replace("/", "", $request->getRequestUri());
//            if (isset(Auth::user()->email)) {
//                $email = Auth::user()->email;
//            }

//            $acl = new aclService();
//            $user_permissions = $acl->getAll($email);
//
//            $permissions = [];
//            foreach ($user_permissions as $value) {
//                if ($value->permission == true) {
//                    $permissions[] = $value->page;
//                }
//            }
//
//            if ($email != 'admin@fortics.com.br') {
//                if (count($permissions) <= 0) {
//                    return redirect()->route("login", []);
//                }else{
//                    if (!in_array($page, $permissions)) {
//                        if($page != $permissions[0]){
//                            $request->request->add(['redirect' => $permissions[0]]);
//                        }
//                    }
//                }
//            }

            session()->keep(['user_remote']);
            return $next($request);

        } else {
            return redirect()->route("login", []);
        }
    }

}