@extends('layouts.master')

@section('page_title', 'Users List')

@section('content')

<div class="container-fluid mt-3">
    <div class="page-content fade-in-up">
        <div class="card">
            <div class="card-header">Users List</div>
            <div class="card-body ">
                <table id="users-table" class="table table-striped table-responsive-sm table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <!-- <th>Phone Number</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <td class="text-capitalize"> {{$user->name}} </td>
                            <td> {{$user->email}} </td>
                            <!-- <td> {{$user->phone_number}} </td> -->
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                No Records Found!!
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        $('#users-table').DataTable({
            pageLength: 25,
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1, -2]
            }]
        });
    });
</script>
@endpush