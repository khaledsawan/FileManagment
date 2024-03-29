<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\File;
use App\Models\User;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        $groups= $user->groups;


        return view('groups.index', compact('groups'));
    }

    public function config(Group $group)
    {
        return view('groups.config', compact('group'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        // Validate the incoming request using StoreGroupRequest

        $group = new Group();
        $user=Auth::user();
        $group->fill($request->validated());

        $group->user_id_creater=$user->id;
        $group->save();
        $user->groups()->attach($group);
        return redirect()->route('groups.index')->with('success', 'Group created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {

        $group->update($request->validated());

        return redirect()->route('groups.index')->with('success', 'Group updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }

    public function addUser(Group $group, Request $request)
    {
        $email=$request->email;
        $user= User::where('email',$email)->first();
        if($user!=null)
        $user->groups()->attach($group);
        return redirect()->route('groups.index')->with('success', 'Group deleted successfully');
    }

}
