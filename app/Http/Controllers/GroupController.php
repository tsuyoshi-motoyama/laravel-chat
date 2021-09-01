<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Http\Requests\GroupPost;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('groups.create', [
            'users' => $users,
        ]);
    }

    /**
     * @param Group
     */
    public function store(GroupPost $request)
    {
        $group = Group::createGroupFromGrooupPost($request);
        return redirect()->route('groups.show', ['group' => $group->id]);
    }

    /**
     * @param Group $group
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Group $group)
    {
        if (!Auth::user()->belongsToGroup($group->id)) {
            return redirect('/');
        }

        return view('groups.show', [
            'group' => $group,
            'groupMessages' => $group->messages
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('groups.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/groups/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('dashboard');
    }
}
