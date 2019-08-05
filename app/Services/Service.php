<?php

namespace App\Services;

class Service
{
    private $modelService;

    public function __construct($modelService)
    {
        $this->modelService = $modelService;
    }

    /**
     * @param string $query
     * @param bool $paginate
     * @param string $orderBy
     * @return mixed
     */
    public function getAll($query = null, $paginate = false,$orderBy = 'name')
    {
        $get = $this->modelService::orderBy($orderBy, 'asc');

        $limit = 10;

        if ($query) {
            if (is_array($query))
                $get = $get->where($orderBy,'like',"%$query%");
            else
                $get = $get->whereRaw($query);
        }

        // Consulta se existe paginação
        if ($paginate) {
            return $get->simplePaginate($limit);
        }
        // Retorna sem paginação
        else {
            return $get->get();
        }

    }

    /**
     * Busca todos por uma condição
     * @param array $by
     * @param bool $paginate
     * @return mixed
     */
    public function getAllBy(array $by, $paginate = false)
    {
        $limit = 10;
        $get = $this->modelService::whereRaw($by);

        if (!$paginate) {
            return $get->get();
        } else {
            // Retorna com paginação
            return $get->simplePaginate($limit);
        }

    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if(isset($data['password']))
            $data['password'] = bcrypt($data['password']);

        return $this->modelService::create($data);
    }

    /**
     * @param array $data
     * @param $id
     * @return bool
     */
    public function update(array $data, $id, $userClass = false)
    {
        if(isset($data['password']))
            $data['password'] = bcrypt($data['password']);

        $find = $this->modelService::find($id);
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
        $find = $this->modelService::find($id);
        if ($find)
            return $find->delete();
        else
            return false;
    }


    /**
     * @param null $id
     * @return bool
     */
    public function find($id = null)
    {
        $find = false;
        if ($id) {
            $find = $this->modelService::find($id);
        }

        if (!$find) {
            $find = new $this->modelService();
        }

        return $find;
    }

    /**
     * Consulta primeiro valor com condição
     * @param array $by
     */
    public function first(array $by)
    {
        return $this->modelService::whereRaw($by)->first();
    }

}