<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Show the form for creating a new school.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new School);
        $school = School::first();

        return view('schools.page', compact('school'));
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new School);

        $newSchool = $request->validate([
            'name'        => 'required|max:60',
            'address'     => 'required|max:255',
            'district'    => 'required|max:60',
            'province'    => 'required|max:60',
            'pos'         => 'nullable|max:5',
            'phone'       => 'nullable|max:12',
            'email'       => 'nullable|max:60',
            'web'         => 'nullable|max:60',
            'description' => 'nullable|max:255',
        ]);

        $newSchool['creator_id'] = auth()->id();

        $school = School::create($newSchool);

        flash(__('school.created'), 'success');

        return redirect()->route('schools.create');
    }

    /**
     * Update a newly created school in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, School $school)
    {
        $this->authorize('update', $school);

        $dataSchool = $request->validate([
            'name'        => 'required|max:60',
            'address'     => 'required|max:255',
            'district'    => 'required|max:60',
            'province'    => 'required|max:60',
            'pos'         => 'nullable|max:5',
            'phone'       => 'nullable|max:12',
            'email'       => 'nullable|max:60',
            'web'         => 'nullable|max:60',
            'description' => 'nullable|max:255',
        ]);
        $school->update($dataSchool);

        flash(__('school.updated'), 'information');

        return redirect()->route('schools.create');
    }

    /**
     * Remove the specified school from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, School $school)
    {
        $this->authorize('delete', $school);

        if ($school->logo) {
            Storage::delete('images/'.$school->logo);
        }

        request()->validate([
            'school_id' => 'required',
        ]);

        if (request('school_id') == $school->id && $school->delete()) {

            flash(__('school.deleted'), 'error');

            return redirect()->route('schools.create');
        }

        return back();
    }

    /**
     * Upload school logo.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Routing\Redirector
     */
    public function uploadlogo(Request $request, School $school)
    {
        $this->authorize('update', $school);

        if ($school->logo) {
            Storage::delete('images/'.$school->logo);
        }
        $logo = $request->file('search_logo')->store('images');
        $logo = str_replace('images/', '', $logo);
        $school->update(['logo' => $logo]);

        flash(__('school.logo_uploaded'), 'information');

        return redirect()->back();
    }

    /**
     * Delete school logo.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Routing\Redirector
     */
    public function destroylogo(Request $request, School $school)
    {
        if ($school->logo) {
            Storage::delete('images/'.$school->logo);
        }
        $school->update(['logo' => null]);

        flash(__('school.logo_deleted'), 'error');

        return redirect()->back();
    }
}
