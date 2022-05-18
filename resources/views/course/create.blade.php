@extends('layouts.app')

@section('title')
    Create Course
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Course">
            <div class="breadcrumb-item"><a href="{{ route('course.index') }}">Course lists</a></div>
            <div class="breadcrumb-item">Add Course</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Course</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('course.store') }}" id="createForm" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Course Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Grade</label>
                                    <select name="grade_id" id="" class="form-control">
                                        @foreach (\App\Models\Grade::all() as $grade)
                                            <option value="{{ $grade->id }} {{ $grade->id==old('grade_id')?'selected':'' }}" >{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>


                            <div class="text-center">
                                <a href="{{ route('course.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                <button class="btn btn-primary px-4">Confirm</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\StoreCourseRequest', '#createForm') !!}
    <script>

    </script>
@endsection
