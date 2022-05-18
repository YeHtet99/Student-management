<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Teacher;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers=Teacher::latest('id')->get();
        return view('teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ssd(Request $request)
    {
        $teachers = Teacher::latest('id');
        return DataTables::of($teachers)
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

                $edit = '<a href="'.route('teacher.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('teacher.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action','photo'])
            ->make(true);

    }


    public function store(StoreTeacherRequest $request)
    {
        $teacher=new Teacher();
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->dob=$request->dob;

        if ($request->hasFile('photo')){
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('teacher/'.$newName,file_get_contents($file));
            $teacher->photo=$newName;
        }

        $teacher->phone=$request->phone;
        $teacher->mobile=$request->mobile;
        $teacher->save();

        return redirect()->route('teacher.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Teacher is successfully created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher=Teacher::findOrFail($id);
        return view('teacher.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTeacherRequest  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, $id)
    {
        $teacher=Teacher::findOrFail($id);
        $teacher->name=$request->name;
        $teacher->email=$request->email;
        $teacher->dob=$request->dob;

        if ($request->hasFile('photo')){
            Storage::disk('public')->delete('teacher/'.$teacher->photo);
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('teacher/'.$newName,file_get_contents($file));
            $teacher->photo=$newName;
        }

        $teacher->phone=$request->phone;
        $teacher->mobile=$request->mobile;
        $teacher->update();

        return redirect()->route('teacher.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Teacher is successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher=Teacher::findOrFail($id);
        Storage::disk('public')->delete('teacher/'.$teacher->photo);
        return $teacher->delete();
    }
}
