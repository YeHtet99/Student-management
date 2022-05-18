@extends('layouts.app')

@section('title')
    Edit Course
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Courses">
            <div class="breadcrumb-item"><a href="{{ route('course.index') }}">Course Lists</a></div>
            <div class="breadcrumb-item">Edit Course</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Course</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('course.update', $course->id) }}" id="editForm" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <form action="{{ route('course.store') }}" id="createForm" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf

{{--                                    <div class="form-group">--}}
{{--                                        <label>Name</label>--}}
{{--                                        <input type="text" class="form-control" value="{{$course->name}}" name="name" placeholder="Course Name">--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Grade</label>--}}
{{--                                        <select name="grade_id" id="" class="form-control">--}}
{{--                                            @foreach (\App\Models\Grade::all() as $grade)--}}
{{--                                                <option value="{{ $grade->id }} {{ $grade->id==$course->grade->id?'selected':'' }}" >{{ $grade->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label>Description</label>--}}
{{--                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$course->description}}</textarea>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{$course->name}}" name="name" placeholder="Course Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Grade</label>
                                        <select name="grade_id" id="" class="form-control">
                                            @foreach (\App\Models\Grade::all() as $grade)
                                                <option value="{{ $grade->id }} {{ $grade->id==$course->grade->id?'selected':'' }}" >{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" id="" cols="30" rows="10">{{$course->description}}</textarea>
                                    </div>


                                    <div class="text-center">
                                        <a href="{{ route('course.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                        <button class="btn btn-primary px-4">Confirm</button>
                                    </div>
                                </form>


                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCourseRequest', '#editForm') !!}
@endsection
