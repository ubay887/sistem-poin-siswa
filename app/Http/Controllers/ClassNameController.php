<?php

namespace App\Http\Controllers;

use App\ClassName;
use Illuminate\Http\Request;

class ClassNameController extends Controller
{
    /**
     * Display a listing of the className.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $editableClassName = null;
        $classNameQuery = ClassName::query();
        $classNameQuery->where('name', 'like', '%'.request('q').'%');
        $classNames = $classNameQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableClassName = ClassName::find(request('id'));
        }

        return view('class_names.index', compact('classNames', 'editableClassName'));
    }

    /**
     * Store a newly created className in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new ClassName);

        $newClassName = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newClassName['creator_id'] = auth()->id();

        ClassName::create($newClassName);

        return redirect()->route('class_names.index');
    }

    /**
     * Update the specified className in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassName  $className
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, ClassName $className)
    {
        $this->authorize('update', $className);

        $classNameData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $className->update($classNameData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('class_names.index', $routeParam);
    }

    /**
     * Remove the specified className from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassName  $className
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, ClassName $className)
    {
        $this->authorize('delete', $className);

        $request->validate(['class_name_id' => 'required']);

        if ($request->get('class_name_id') == $className->id && $className->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('class_names.index', $routeParam);
        }

        return back();
    }
}
