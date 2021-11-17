<?php namespace App\Repositories;

use App\Models\EventBooking;
use Sentinel;

class BookingRepositoryEloquent implements BookingRepository
{
    /**
     * @var EventBooking
     */
    private $model;
    /**
     * LeadRepositoryEloquent constructor.
     * @param EventBooking $model
     */
    public function __construct(EventBooking $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
//	    $user = User::find(Sentinel::getUser()->id);
        $models = $this->model;
//	        ->whereHas('user', function ($q) use ($user) {
//            $q->where(function ($query) use ($user) {
//                $query
//                    ->orWhere('id', $user->parent->id)
//                    ->orWhere('users.user_id', $user->parent->id);
//            });
//        });

        return $models;
    }

    public function store(array $data)
    {
        $booking = new EventBooking();
        $id = $booking->create($data)->id;
        return $id;
    }
}