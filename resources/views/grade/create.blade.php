@extends('layouts.app')

@section('title')
    Create Grade
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Grades">
            <div class="breadcrumb-item"><a href="{{ route('grade.index') }}">Grade lists</a></div>
            <div class="breadcrumb-item">Add Grade</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Grade</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('grade.store') }}" id="createForm" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Grade Name">
                                </div>

                            <div class="text-center">
                                <a href="{{ route('grade.index') }}" class="btn btn-danger mr-2">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreGradeRequest', '#createForm') !!}
    <script>

    </script>
@endsection
