<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userQuery = User::query();
        $userQuery->where('name', 'like', '%'.request('q').'%');
        $users = $userQuery->paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new User);

        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        $newUser = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newUser['creator_id'] = auth()->id();

        $user = User::create($newUser);

        return redirect()->route('users.show', $user);
    }

    /**
     * Display the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $userData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $user->update($userData);

        return redirect()->route('users.show', $user);
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, User $user)
    {
        $this->authorize('delete', $user);

        $request->validate(['user_id' => 'required']);

        if ($request->get('user_id') == $user->id && $user->delete()) {
            return redirect()->route('users.index');
        }

        return back();
    }
}
