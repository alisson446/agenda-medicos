<?php
namespace App\Services;
use App\acl;
class aclService
{
    /**
     * @param null $name
     * @return mixed
     */
    public function getAll($email = null)
    {
        $get = acl::orderBy('email', 'asc');

        if ($email) {
            $get = $get->where('email', 'like', "%$email%");
        }

        return $get->get();
    }

    public function getFind($server, $email)
    {
        $get = acl::orderBy('created_at', 'asc');
        $get = $get->where('page', "$server")->where("email", "$email");
        return $get->get();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return acl::create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id)
    {
        $find = acl::find($id);
        if ($find) {
            $find->update($data);
            return $find;
        } else
            return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $find = acl::find($id);
        if ($find)
            return $find->delete();
        else
            return false;
    }

    /**
     * @param null $id
     * @return bool|acl
     */
    public function find($id = null)
    {
        $find = false;
        if ($id) {
            $find = acl::find($id);
        }

        if (!$find) {
            $find = new acl();
        }

        return $find;
    }
}
