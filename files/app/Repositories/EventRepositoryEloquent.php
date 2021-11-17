<?php namespace App\Repositories;

use App\Models\Event;
use App\Models\User;
use Sentinel;

class EventRepositoryEloquent implements EventRepository
{
    /**
     * @var Event
     */
    private $model;
    /**
     * LeadRepositoryEloquent constructor.
     * @param Event $model
     */
    public function __construct(Event $model)
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
        $event_data = new Event();
        $id = $event_data->create($data)->id;
        return $id;
    }

//    public function getAllForCustomer($company_id)
//    {
//        return $this->model->where('customer_id', $company_id);
//    }
//
//    public function getAllForUser($customer_id)
//    {
//        $models = $this->model->whereHas('user', function ($q) use ($customer_id) {
//            $q->where('customer_id', $customer_id);
//        });
//        return $models;
//    }
}