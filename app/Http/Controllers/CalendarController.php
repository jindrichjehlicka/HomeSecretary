<?php

namespace HomeSecretary\Http\Controllers;

use Carbon\Carbon;
use HomeSecretary\Calendar;
use HomeSecretary\Occasion;
use HomeSecretary\Task;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function index()
    {
        $userId = auth()->user()->id;
        $occasions = Occasion::where('user_id', $userId)
            ->get();


        $tasks = Task::where('user_id', $userId)
            ->orWhereHas('taskList', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->get();

        return response()->json([
            'tasks' => $tasks,
            'occasions' => $occasions
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \HomeSecretary\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function show(Calendar $calendar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \HomeSecretary\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendar $calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \HomeSecretary\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendar $calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \HomeSecretary\Calendar $calendar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendar $calendar)
    {
        //
    }
}
