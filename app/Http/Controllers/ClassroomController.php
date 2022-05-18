<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Course;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms=Classroom::latest('id')->get();
        return view('classroom.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function ssd(Request $request)
    {
        $classrooms = Classroom::latest('id');
        return DataTables::of($classrooms)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('grade', function ($each) {
                return $each->grade->name;
            })
            ->editColumn('teacher', function ($each) {
                return $each->teacher->name;
            })

            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('classroom.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('classroom.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function store(StoreClassroomRequest $request){
//    {
//        $classroom=new Classroom();
//        $classroom->Year=$request->Year;
//        $classroom->grade_id=$request->grade_id;
//        $classroom->section=$request->section;
//        $classroom->teacher_id=$request->teacher_id;
//       $classroom->save();
//
//        return redirect()->route('classroom.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Classroom is successfully created']);
            return $request;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom=Classroom::findOrFail($id);
        return view('classroom.edit',compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, $id)
    {
        $classroom=Classroom::findOrFail($id);
        $classroom->Year=$request->Year;
        $classroom->section=$request->section;
        $classroom->update();
        return redirect()->route('classroom.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Classroom is successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom=Classroom::findOrFail($id);
        return $classroom->delete();
    }
}
