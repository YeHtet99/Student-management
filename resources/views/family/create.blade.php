@extends('layouts.app')

@section('title')
    Create Parent
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('family.index') }}">Parent lists</a></div>
            <div class="breadcrumb-item">Add Parent</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Parent</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('family.store') }}" id="createForm" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Parent Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="parent@gmail.com">
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="dob">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Photo</label>
                                    <input type="file" class="form-control" name="photo" accept="image/jpeg,image/png,image/jpg">
                                </div>
                            </div>
                            <div class="form-row mb-2">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Phone No">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Mobile No">
                                </div>
                            </div>


                            <div class="text-center">
                                <a href="{{ route('family.index') }}" class="btn btn-danger mr-2">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\StoreFamilyRequest', '#createForm') !!}
    <script>

    </script>
@endsection
