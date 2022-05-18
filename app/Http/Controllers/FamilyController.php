<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families=Family::latest('id')->get();
        return view('family.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('family.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFamilyRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function ssd(Request $request)
    {
        $families = Family::latest('id');
        return DataTables::of($families)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('photo', function ($each) {
                return '<img src="' . $each->photo_path() . '" alt="" class="border border-1 border-white shadow-sm photo" />';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('family.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('family.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action','photo'])
        ->make(true);

    }

    public function store(StoreFamilyRequest $request)
    {
        $family=new Family();
        $family->name=$request->name;
        $family->email=$request->email;
        $family->dob=$request->dob;

        if ($request->hasFile('photo')){
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('family/'.$newName,file_get_contents($file));
            $family->photo=$newName;
        }

        $family->phone=$request->phone;
        $family->mobile=$request->mobile;
        $family->save();

        return redirect()->route('family.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Parent is successfully created']);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $family=Family::findOrFail($id);
        return view('family.edit',compact('family'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFamilyRequest  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFamilyRequest $request, $id)
    {
        $family=Family::findOrFail($id);
        $family->name=$request->name;
        $family->email=$request->email;
        $family->dob=$request->dob;

        if ($request->hasFile('photo')){
            Storage::disk('public')->delete('family/'.$family->photo);
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('family/'.$newName,file_get_contents($file));
            $family->photo=$newName;
        }

        $family->phone=$request->phone;
        $family->mobile=$request->mobile;
        $family->update();

        return redirect()->route('family.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Parent is successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $family=Family::findOrFail($id);
        Storage::disk('public')->delete('family/'.$family->photo);
        return $family->delete();

    }
}
