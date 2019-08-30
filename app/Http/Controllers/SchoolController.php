<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function page()
    {
        return view('schools.page');
    }

    public function save(Request $request)
    {
        $request->validate([

            'school_name'     => 'required|max:60',
            'school_address'  => 'required|max:255',
            'school_district' => 'required|max:60',
            'school_province' => 'required|max:60',
            'school_pos'      => 'nullable|max:5',
            'school_phone'    => 'nullable|max:12',
            'school_email'    => 'nullable|max:60',
            'school_web'      => 'nullable|max:60',
        ]);

        $school = School::firstOrNew(['key' => 'school_name']);
        $school->value = $request->get('school_name');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_address']);
        $school->value = $request->get('school_address');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_district']);
        $school->value = $request->get('school_district');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_province']);
        $school->value = $request->get('school_province');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_pos']);
        $school->value = $request->get('school_pos');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_phone']);
        $school->value = $request->get('school_phone');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_email']);
        $school->value = $request->get('school_email');
        $school->save();

        $school = School::firstOrNew(['key' => 'school_web']);
        $school->value = $request->get('school_web');
        $school->save();

        flash(__('school.updated'), 'success');

        return redirect()->route('schools.page');
    }

    // /**
    //  * Show the form for creating a new school.
    //  *
    //  * @return \Illuminate\View\View
    //  */
    // public function create()
    // {
    //     $this->authorize('create', new School);
    //     $school = School::first();

    //     return view('schools.page', compact('school'));
    // }

    // /**
    //  * Store a newly created company in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Routing\Redirector
    //  */
    // public function store(Request $request)
    // {
    //     $this->authorize('create', new School);

    //     $newSchool = $request->validate([
    //         'name'        => 'required|max:60',
    //         'address'     => 'required|max:255',
    //         'district'    => 'required|max:60',
    //         'province'    => 'required|max:60',
    //         'pos'         => 'nullable|max:5',
    //         'phone'       => 'nullable|max:12',
    //         'email'       => 'nullable|max:60',
    //         'web'         => 'nullable|max:60',
    //         'description' => 'nullable|max:255',
    //     ]);

    //     $newSchool['creator_id'] = auth()->id();

    //     $school = School::create($newSchool);

    //     flash(__('school.created'), 'success');

    //     return redirect()->route('schools.create');
    // }

    // /**
    //  * Update a newly created school in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\School  $school
    //  * @return \Illuminate\Routing\Redirector
    //  */
    // public function update(Request $request, School $school)
    // {
    //     $this->authorize('update', $school);

    //     $dataSchool = $request->validate([
    //         'name'        => 'required|max:60',
    //         'address'     => 'required|max:255',
    //         'district'    => 'required|max:60',
    //         'province'    => 'required|max:60',
    //         'pos'         => 'nullable|max:5',
    //         'phone'       => 'nullable|max:12',
    //         'email'       => 'nullable|max:60',
    //         'web'         => 'nullable|max:60',
    //         'description' => 'nullable|max:255',
    //     ]);
    //     $school->update($dataSchool);

    //     flash(__('school.updated'), 'information');

    //     return redirect()->route('schools.create');
    // }

    // /**
    //  * Remove the specified school from storage.
    //  *
    //  * @param  \App\School  $school
    //  * @return \Illuminate\Routing\Redirector
    //  */
    // public function destroy(Request $request, School $school)
    // {
    //     $this->authorize('delete', $school);

    //     if ($school->logo) {
    //         Storage::delete('images/'.$school->logo);
    //     }

    //     request()->validate([
    //         'school_id' => 'required',
    //     ]);

    //     if (request('school_id') == $school->id && $school->delete()) {

    //         flash(__('school.deleted'), 'error');

    //         return redirect()->route('schools.create');
    //     }

    //     return back();
    // }

    // /**
    //  * Upload school logo.
    //  *
    //  * @param  \App\School  $school
    //  * @return \Illuminate\Routing\Redirector
    //  */
    // public function uploadlogo(Request $request, School $school)
    // {
    //     $this->authorize('update', $school);

    //     if ($school->logo) {
    //         Storage::delete('images/'.$school->logo);
    //     }
    //     $logo = $request->file('search_logo')->store('images');
    //     $logo = str_replace('images/', '', $logo);
    //     $school->update(['logo' => $logo]);

    //     flash(__('school.logo_uploaded'), 'information');

    //     return redirect()->back();
    // }

    // /**
    //  * Delete school logo.
    //  *
    //  * @param  \App\School  $school
    //  * @return \Illuminate\Routing\Redirector
    //  */
    // public function destroylogo(Request $request, School $school)
    // {
    //     if ($school->logo) {
    //         Storage::delete('images/'.$school->logo);
    //     }
    //     $school->update(['logo' => null]);

    //     flash(__('school.logo_deleted'), 'error');

    //     return redirect()->back();
    // }
}
