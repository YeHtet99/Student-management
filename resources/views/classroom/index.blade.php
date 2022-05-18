@extends('layouts.app')

@section('title')
    Create Classroom
@endsection
@section('content')
    <section class="section">
        <x-bread-crumb title="Teachers">
            <div class="breadcrumb-item">Classroom Lists</div>
        </x-bread-crumb>
    </section>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Teacher Lists</h4>
                    <a href="{{ route('classroom.create') }}" class="btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover dt-responsive no-wrap w-100" id="dataTable">
                        <thead>
                        <tr>
                            <th class="no-sort"></th>
                            <th>Year</th>
                            <th>Grade</th>
                            <th>Section</th>
                            <th>Teacher</th>
                            <th class="no-sort">Control</th>
                            <th class="no-sort">Created_at</th>
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
                ajax: '{{ route('classroom.ssd') }}',
                columns: [
                    {
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'year',
                        name: 'year'
                    },
                    {
                        data: 'grade',
                        name: 'grade'
                    },
                    {
                        data: 'section',
                        name: 'section'
                    },
                    {
                        data: 'teacher',
                        name: 'teacher'
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
                            url: `/classroom/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection

