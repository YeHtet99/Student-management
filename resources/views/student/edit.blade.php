@extends('layouts.app')

@section('title')
    Edit Student
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Student">
            <div class="breadcrumb-item"><a href="{{ route('student.index') }}">Student Lists</a></div>
            <div class="breadcrumb-item">Edit Student</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Student</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.update', $student->id) }}" id="editForm" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <form action="{{ route('student.store') }}" id="createForm" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" value="{{$student->name}}" name="name" placeholder="Student Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{{$student->email}}" placeholder="parent@gmail.com">
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" name="dob" value="{{ $student->dob }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Photo</label>
                                            <input type="file" class="form-control" name="photo" accept="image/jpeg,image/png,image/jpg">
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{{$student->phone}}" placeholder="Phone No">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" name="mobile" value="{{$student->mobile}}" placeholder="Mobile No">
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Date of Join</label>
                                            <input type="date" class="form-control" name="dateofjoin" value="{{$student->dateofjoin}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Parent</label>
                                            <select name="family_id" id="" class="form-control @error('family_id') is-invalid @enderror">
                                                @foreach (App\Models\Family::all() as $family)
                                                    <option value="{{ $family->id }} {{ $family->id==$student->family->id?'selected':'' }}">{{ $family->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="{{ route('student.index') }}" class="btn btn-danger mr-2">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateStudentRequest', '#editForm') !!}
@endsection
