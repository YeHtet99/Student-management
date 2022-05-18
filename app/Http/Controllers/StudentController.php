<?php

namespace App\Http\Controllers;



use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students=Student::latest('id')->get();
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ssd(Request $request)
    {
        $students = Student::latest('id');
        return DataTables::of($students)
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

                $edit = '<a href="'.route('student.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('student.show', $each->id) . '" class="btn mr-1 btn-secondary btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['action','photo'])
            ->make(true);

    }

    public function store(StoreStudentRequest $request)
    {
        $student=new Student();
        $student->name=$request->name;
        $student->email=$request->email;
        $student->dob=$request->dob;
        if ($request->hasFile('photo')){
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('student/'.$newName,file_get_contents($file));
            $student->photo=$newName;
        }
        $student->family_id=$request->family_id;
        $student->phone=$request->phone;
        $student->mobile=$request->mobile;
        $student->dateofjoin=$request->dateofjoin;
        $student->save();

        return redirect()->route('student.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Student is successfully created']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::findOrFail($id);
        return view('student.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $student=Student::findOrFail($id);
        $student->name=$request->name;
        $student->email=$request->email;
        $student->dob=$request->dob;

        if ($request->hasFile('photo')){
            Storage::disk('public')->delete('student/'.$student->photo);
            $file=$request->file('photo');
            $newName="photo_".uniqid().".".$file->getClientOriginalExtension();
            Storage::disk('public')->put('student/'.$newName,file_get_contents($file));
            $student->photo=$newName;
        }

        $student->phone=$request->phone;
        $student->mobile=$request->mobile;
        $student->dateofjoin=$request->dateofjoin;
        $student->update();

        return redirect()->route('student.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Student is successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::findOrFail($id);
        Storage::disk('public')->delete('student/'.$student->photo);
        return $student->delete();
    }
}
