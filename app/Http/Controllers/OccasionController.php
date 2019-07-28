<?php

namespace HomeSecretary\Http\Controllers;

use HomeSecretary\Occasion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use HomeSecretary\Http\Requests\StoreOccasion;
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
        $userId = auth()->user()->id;

        $occasions = Occasion::where('user_id', $userId)->get();

        return view('occasions.index')->with(['occasions' => $occasions]);
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
     * @param StoreOccasion $request
     * @return Response
     */
    public function store(StoreOccasion $request)
    {
        try {
            $occasion = new Occasion();
            $occasion->name = $request->name;
            $occasion->description = $request->description;
            $occasion->latitude = $request->latitude;
            $occasion->longitude = $request->longitude;
            $occasion->from_date = Carbon::parse("$request->endTime $request->endDate");
            $occasion->to_date = Carbon::parse("$request->endTime $request->endDate");
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
     * @param \HomeSecretary\Occasion $occasion
     * @return Response
     */
    public function show(Occasion $occasion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \HomeSecretary\Occasion $occasion
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
     * @param \HomeSecretary\Occasion $occasion
     * @return Response
     */
    public function update(Request $request, Occasion $occasion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \HomeSecretary\Occasion $occasion
     * @return Response
     */
    public function destroy(Occasion $occasion)
    {
        //
    }
}
