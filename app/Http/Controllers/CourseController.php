<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course=Course::latest('id')->get();
        return view('course.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ssd(Request $request)
    {
        $courses = Course::latest('id');
        return DataTables::of($courses)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('grade', function ($each) {
                return $each->grade->name;
            })

            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('course.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('course.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function store(StoreCourseRequest $request)
    {
        $course=new Course();
        $course->name=$request->name;
        $course->grade_id=$request->grade_id;
        $course->description=$request->description;
        $course->save();
        return redirect()->route('course.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Course is successfully created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course=Course::findOrFail($id);
        return view('course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $course=Course::findOrFail($id);
        $course->name=$request->name;

        $course->description=$request->description;
        $course->update();
        return redirect()->route('course.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Course is successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course=Course::findOrFail($id);
        return $course->delete();
    }
}
