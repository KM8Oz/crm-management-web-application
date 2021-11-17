<?php

namespace App\Http\Controllers\Users;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response;
use Sentinel;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class TaskController extends UserController
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TaskController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;

        view()->share('type', 'task');
    }
    public function index()
    {
        $title = trans('task.todo');
        $users = $this->userRepository->getAllNew()->get()
            ->filter(function ($user) {
                return ($user->inRole('staff') || $user->inRole('admin'));
            })
            ->map(function ($user) {
                return [
                    'name' => $user->full_name .' ( '.$user->email.' )' ,
                    'id' => $user->id
                ];
            })
            ->pluck('name', 'id')->prepend(trans('task.assignee'),'');

        $user_list = $this->userRepository->getAllNew()->get()
            ->filter(function ($user) {
                return ($user->inRole('staff') || $user->inRole('admin'));
            })
            ->map(function ($user) {
                return [
                    'name' => $user->full_name,
                    'id' => $user->id
                ];
            })
            ->pluck('name', 'id')->toArray();
//        print_r($user_list);die;
//        $user_list = json_encode($user_list);

        return view('user.task.index', compact('title','users','user_list'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TaskRequest $request)
    {
        $task = new Task($request->except('_token','full_name'));
        $task->save();
        return $task->id;
    }

    /**
     * @param Driver $driver
     * @param DriverRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Task $task, Request $request)
    {
        $task->update($request->except('_method', '_token'));
    }
    /**
     * Delete the given Driver.
     *
     * @param  int $id
     * @return Redirect
     */
    public function delete(Task $task)
    {
        $task->delete();

    }

    /**
     * Ajax Data
     */
    public function data()
    {
        if(Sentinel::inRole('admin')){
            return Task::orderBy("finished", "ASC")
                ->orderBy("task_deadline", "DESC")
                ->get()
                ->map(function ($task) {
                    return [
                        'task_from' => $task->user_ids->full_name,
                        'id' => $task->id,
                        'finished' => $task->finished,
                        'task_deadline' => $task->task_deadline,
                        "task_description" => $task->task_description,
                        "text" => Sentinel::inRole('admin') ? "Assigned To:- " : "Assigned By:- ",
                    ];
                });
        }else{
            return Task::where('user_id', $this->user->id)
                ->orderBy("finished", "ASC")
                ->orderBy("task_deadline", "DESC")
                ->get()
                ->map(function ($task) {
                    return [
                        'task_from' => $task->task_from_users->full_name,
                        'id' => $task->id,
                        'finished' => $task->finished,
                        'task_deadline' => $task->task_deadline,
                        "task_description" => $task->task_description,
                        "text" => Sentinel::inRole('admin') ? "Assigned To:- " : "Assigned By:- ",
                    ];
                });
        }

    }
}