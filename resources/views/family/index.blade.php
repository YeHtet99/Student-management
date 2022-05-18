@extends('layouts.app')

@section('title')
    Create Parent
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Content">
            <div class="breadcrumb-item">Parent Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Content Lists</h4>
                    <a href="{{ route('family.create') }}" class="btn btn-primary">Add</a>
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
                ajax: '{{ route('family.ssd') }}',
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
                            url: `/family/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection

