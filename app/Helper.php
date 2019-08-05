<?php
namespace App;

use App\Services\aclService;
use Illuminate\Support\Facades\Auth;

class Helper {

    public static function checkPage ($url)
    {
//        $url = explode("/", $url);
//        $url = array_pop($url);
//        $acl = new aclService();
//        $res = $acl->getFind($url, Auth::user()->email);
//        $permissions = [];
//        foreach ($res as $user) {
//            if ($user['permission']) {
//                $permissions[] = $user['page'];
//            }
//        }
//
//        if (Auth::user()->email == 'admin@fortics.com.br') {
//            return true;
//        }
//
//        if (in_array($url, $permissions)) {
            return true;
//        } else {
//            return false;
//        }
    }

}