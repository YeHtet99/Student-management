@extends('layouts.app')

@section('title')
    Create Student
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Student">
            <div class="breadcrumb-item">Student Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Student Lists</h4>
                    <a href="{{ route('student.create') }}" class="btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="dataTable">
                        <thead>
                        <tr>
                            <th class="no-sort"></th>
                            <th class="no-sort">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Phone No</th>
                            <th>Mobile</th>
                            <th>Date of Join</th>
                            <th class="no-sort">Control</th>
                            <th class="hidden no-sort">Created_at</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('student.ssd') }}',
                columns: [
                    {
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'photo',
                        name: 'photo'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'dob',
                        name: 'dob',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                    },
                    {
                        data: 'dateofjoin',
                        name: 'dateofjoin',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                ],
            });
            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();
                var id = $(this).data("id");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/student/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection

