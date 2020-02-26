<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Entities\Options\School;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Upload school logo.
     *
     * @param  \App\Entities\Options\School;  $school
     * @return \Illuminate\Routing\Redirector
     */
    public function uploadlogo(Request $request)
    {
        $school = School::where('key', 'school_logo')->first();

        if ($school) {
            Storage::delete('images/'.$school->value);
        }

        $logo = $request->file('search_logo')->store('images');
        $logo = str_replace('images/', '', $logo);

        $school = School::firstOrNew(['key' => 'school_logo']);
        $school->value = $logo;
        $school->save();

        flash(__('school.logo_uploaded'), 'information');

        return redirect()->back();
    }
}
