<?php

namespace HomeSecretary\Http\Controllers;

use HomeSecretary\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

  public function index()
  {
    $groups = Group::with('users')->whereHas('users')->get();

    $admins = $groups->mapWithKeys(function ($item) {
      return [$item->id => $item->users->where('id', $item->user_id)->first()];
    });

    return view('groups.index')->with(['groups' => $groups, 'admins' => $admins]);
  }

  public function create()
  {
    return view('groups.create');
  }

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

      foreach ($request->userIds as $userId) {
        $group->users()->attach($userId);
      }

      return response(['success' => true, 'message' => 'Occasion created!']);
    } catch (\Exception $exception) {
      dump($exception);
    }
  }

  public function show(Group $group)
  {
    $members = $group->users()->get();

    return view('groups.show')->with(['group' => $group, 'members' => $members]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \HomeSecretary\Group $group
   * @return \Illuminate\Http\Response
   */
  public function edit(Group $group)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \HomeSecretary\Group $group
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Group $group)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \HomeSecretary\Group $group
   * @return \Illuminate\Http\Response
   */
  public function destroy(Group $group)
  {
    //
  }
}
