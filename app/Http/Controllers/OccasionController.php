<?php

namespace App\Http\Controllers;

use App\Occasion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OccasionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('occasions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('occasions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
//        Validates User Input
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'startDate' => 'required|date',
            'startTime' => 'required|date_format:H:i',
            'endDate' => 'required|date',
            'endTime' => 'required|date_format:H:i',
        ]);

        try {
            $occasion = new Occasion();
            $occasion->name = $request->name;
            $occasion->description = $request->description;
            $occasion->from_date = Carbon::parse("$request->endTime $request->endDate");
            $occasion->to_date = Carbon::parse("$request->endTime $request->endDate");
            $occasion->user_id = auth()->user()->id;
            $occasion->save();

            return response(['success' => true, 'message' => 'Occasion created!']);
        } catch (\Exception $exception) {
            //  todo: return response
            dump($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Occasion $occasion
     * @return Response
     */
    public function show(Occasion $occasion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Occasion $occasion
     * @return Response
     */
    public function edit(Occasion $occasion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Occasion $occasion
     * @return Response
     */
    public function update(Request $request, Occasion $occasion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Occasion $occasion
     * @return Response
     */
    public function destroy(Occasion $occasion)
    {
        //
    }
}
