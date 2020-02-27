<?php

namespace App\Http\Controllers\References;

use Illuminate\Http\Request;
use App\Entities\Options\Option;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OptionController extends Controller
{
    public function page()
    {
        return view('options.page');
    }

    public function save(Request $request)
    {
        $request->validate([

            'option_name'     => 'required|max:60',
            'option_address'  => 'required|max:255',
            'option_district' => 'required|max:60',
            'option_province' => 'required|max:60',
            'option_pos'      => 'nullable|max:5',
            'option_phone'    => 'nullable|max:12',
            'option_email'    => 'nullable|max:60',
            'option_web'      => 'nullable|max:60',
        ]);

        $option = Option::firstOrNew(['key' => 'option_name']);
        $option->value = $request->get('option_name');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_address']);
        $option->value = $request->get('option_address');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_district']);
        $option->value = $request->get('option_district');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_province']);
        $option->value = $request->get('option_province');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_pos']);
        $option->value = $request->get('option_pos');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_phone']);
        $option->value = $request->get('option_phone');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_email']);
        $option->value = $request->get('option_email');
        $option->save();

        $option = Option::firstOrNew(['key' => 'option_web']);
        $option->value = $request->get('option_web');
        $option->save();

        flash(__('option.updated'), 'success');

        return redirect()->route('options.page');
    }

    /**
     * Upload option logo.
     *
     * @param  \App\Entities\Options\Option;  $option
     * @return \Illuminate\Routing\Redirector
     */
    public function uploadlogo(Request $request)
    {
        $option = Option::where('key', 'option_logo')->first();

        if ($option) {
            Storage::delete('images/'.$option->value);
        }

        $logo = $request->file('search_logo')->store('images');
        $logo = str_replace('images/', '', $logo);

        $option = Option::firstOrNew(['key' => 'option_logo']);
        $option->value = $logo;
        $option->save();

        flash(__('option.logo_uploaded'), 'information');

        return redirect()->back();
    }
}
