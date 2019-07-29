<?php

namespace HomeSecretary\Http\Controllers;

use HomeSecretary\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

//        $groups = Group::where('user_id', $userId)->get();

//        return view('occasions.index')->with();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $userId = auth()->user()->id;
            $group = new Group();
            $group->name = $request->name;
            $group->description = $request->description;
            $group->user_id = $userId;
            $group->save();
            $group->users()->attach($userId);
            
            foreach($request->userIds as $userId){
                $group->users()->attach($userId);
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
     * @param  \HomeSecretary\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \HomeSecretary\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \HomeSecretary\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \HomeSecretary\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
