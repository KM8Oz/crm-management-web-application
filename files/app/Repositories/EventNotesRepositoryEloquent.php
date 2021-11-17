<?php namespace App\Repositories;

use App\Models\Event;
use App\Models\EventNotes;
use App\Models\User;
use Sentinel;

class EventNotesRepositoryEloquent implements EventNotesRepository
{
    /**
     * @var Event
     */
    private $model;
    /**
     * LeadRepositoryEloquent constructor.
     * @param Event $model
     */
    public function __construct(EventNotes $model)
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
        $event_data = new EventNotes();
        $id = $event_data->create($data)->id;
        return $id;
    }

}