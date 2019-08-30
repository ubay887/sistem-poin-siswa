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

        $newUserData = $request->validate([
            'name'     => 'required|min:5|max:60',
            'email'    => 'required|email|unique:users,email',
            'password' => 'nullable|between:8,15',
        ]);

        $newUserData['name'] = ucwords(strtolower($newUserData['name']));
        $password = $newUserData['password'] ?: 'defaultpassword';
        $newUserData['password'] = bcrypt($password);

        $user = User::create($newUserData);

        flash(__('user.created'), 'success');

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

        $UserData = $request->validate([
            'name'     => 'required|min:5|max:60',
            'email'    => 'required|email|unique:users,email',
            'password' => 'nullable|between:8,15',
        ]);
        $UserData['name'] = ucwords(strtolower($UserData['name']));
        if ($UserData['password'] == null) {
            unset($UserData['password']);
        } else {
            $UserData['password'] = bcrypt($UserData['password']);
        }
        $user->update($UserData);

        flash(__('user.updated'), 'information');

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

        if (auth()->user()->id != $user->id) {
            if ($request->get('user_id') == $user->id && $user->delete()) {

                flash(__('user.deleted'), 'error');

                return redirect()->route('users.index');
            }
        } else {

            flash(__('user.undeleted'), 'warning');

            return back();
        }

    }
}
