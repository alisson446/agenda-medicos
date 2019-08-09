<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\acl;
use App\Services\aclService;

class AclController extends Controller
{
    public function saveACL (Request $request)
    {
        $acl = new aclService();
        $res = $acl->getFind($request->get('page'), $request->get('email'));
        if (count($res) > 0) {
            $acl->update($request->all(), $res[0]['_id']);
        } else {
            $acl->create($request->all());
        }
        return $acl->getAll();
    }

    public function getAcl (Request $request)
    {
        $acl = new aclService();
        $res = $acl->getFind($request->get('page'), $request->get('email'));
        return $res;
    }
}
