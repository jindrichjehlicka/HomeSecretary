<?php

namespace HomeSecretary\Http\Controllers;

use Carbon\Carbon;
use HomeSecretary\Task;
use HomeSecretary\TaskList;
use Illuminate\Http\Request;
use HomeSecretary\Http\Requests\StoreTask;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $tasks = Task::with('taskList')
            ->where('user_id', $userId)
            ->limit(6)
            ->get();

        $assignedTasks = Task::with('taskList')
            ->where('user_id', '!=', $userId)
            ->whereHas('taskList', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->limit(6)->get();

        return view('tasks.index')->with(['tasks' => $tasks, 'assignedTasks' => $assignedTasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        try {
            $task = new Task();
            $task->name = $request->name;
            $task->description = $request->description;
            $task->latitude = $request->latitude;
            $task->longitude = $request->longitude;
            $task->deadline = Carbon::parse("$request->deadlineTime $request->deadlineDate");
            $task->user_id = auth()->user()->id;
            $task->save();

            foreach ($request->tasksList as $taskName) {
                $taskList = new TaskList();
                $taskList->name = $taskName;
                $taskList->task_id = $task->id;
                $taskList->user_id = $request->assigned_to;
                $taskList->save();
            }

//            TODO: change to return view
            return response(['success' => true, 'message' => 'Occasion created!']);
        } catch (\Exception $exception) {
            //  todo: return response
            dump($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \HomeSecretary\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show')->with(['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \HomeSecretary\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \HomeSecretary\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \HomeSecretary\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
