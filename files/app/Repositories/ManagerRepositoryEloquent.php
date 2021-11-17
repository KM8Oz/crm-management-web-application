<?php namespace App\Repositories;

use App\Models\Managers;
use App\Models\User;
use Sentinel;

class ManagerRepositoryEloquent implements ManagerRepository
{
    /**
     * @var Managers
     */
    private $model;
    /**
     * LeadRepositoryEloquent constructor.
     * @param Managers $model
     */
    public function __construct(Managers $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $models = $this->model;
        return $models;
    }

    public function store(array $data)
    {
//        $user = User::find(Sentinel::getUser()->id);
//        $event = $user->leads()->create($data);
        return null;
    }
}