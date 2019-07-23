<?php

namespace HomeSecretary\Http\Controllers;

use Carbon\Carbon;
use HomeSecretary\Task;
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
        return view('tasks.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTask $request)
    {
        try {
            $occasion = new Task();
            $occasion->name = $request->name;
            $occasion->description = $request->description;
            $occasion->latitude = $request->latitude;
            $occasion->longitude = $request->longitude;
            $occasion->deadline = Carbon::parse("$request->deadlineTime $request->deadlineDate");
            $occasion->user_id = auth()->user()->id;
            $occasion->save();

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
     * @param  \HomeSecretary\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HomeSecretary\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HomeSecretary\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HomeSecretary\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
