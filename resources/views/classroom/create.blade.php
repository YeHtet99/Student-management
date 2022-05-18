@extends('layouts.app')

@section('title')
    Create Classroom
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Classroom">
            <div class="breadcrumb-item"><a href="{{ route('classroom.index') }}">Classroom lists</a></div>
            <div class="breadcrumb-item">Add Classroom</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Classroom</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('classroom.store') }}" id="createForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control" name="Year" placeholder="Classroom Year">
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
                                <label>Section</label>
                                <input type="text" class="form-control" name="section">
                            </div>
                            <div class="form-group">
                                <label for="">Teacher</label>
                                <select name="teacher_id" id="" class="form-control">
                                    @foreach (\App\Models\Teacher::all() as $teacher)
                                        <option value="{{ $teacher->id }} {{ $teacher->id==old('teacher_id')?'selected':'' }}" >{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('classroom.index') }}" class="btn btn-danger mr-2">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreClassroomRequest', '#createForm') !!}
    <script>

    </script>
@endsection
