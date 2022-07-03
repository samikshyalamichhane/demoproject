@extends('layouts.master')

@section('page_title', 'News List')

@push('styles')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">News List
            @can('news-create')
            <div class="float-right">
                <a class="btn btn-info btn-md" href="{{route('news.create')}}">Add News</a>
            </div>
            @endcan
        </div>
        <div class="card-body ">
            <table id="news-table" class="table table-striped table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Posted By</th>
                        <th>Category</th>
                        @if(auth()->user()->is_admin)
                        <th>Verified</th>
                        @endif
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $new)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td class="text-capitalize"> {{$new->title}} </td>
                        <td>
                            <img src="{{Storage::url($new->image)}}" alt="{{ $new->title }}" class="rounded" style="height: 3rem;">
                        </td>
                        <td class="text-capitalize"> {{$new->user->name}} </td>
                        <td class="text-capitalize"> {{$new->category->name}} </td>
                        @if(auth()->user()->is_admin)
                        <td>
                        <input type="checkbox" id="toggle-event" data-toggle="toggle" class="newsVerifyStatus btn btn-success btn-sm" rel="{{$new->id}}" data-on="Verify" data-off="Unverify" data-onstyle="success" data-offstyle="danger" data-size="mini" @if($new->is_verified == 1) checked @endif>
                        </td>
                        <td>
                        <input type="checkbox" id="toggle-event" data-toggle="toggle" class="newsStatus btn btn-success btn-sm" rel="{{$new->id}}" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="mini" @if($new->publish == 1) checked @endif>
                        </td>
                        @endif
                        @if(!auth()->user()->is_admin)
                        <td>
                            <div style="display:inline-block; width:75px" class="badge {{ $new->publish==1 ? 'bg-primary' : 'badge-danger' }} text-capitalize">
                                {{ $new->publish == 1 ? 'Published' : 'Not Published' }}
                            </div>
                        </td>
                        @endif
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{ route('news.show', $new->id) }}" class="btn btn-success btn-sm border-0"><i class="fa fa-eye"></i> View</a>
                                <div class="mx-2"></div>
                                <a href="{{ route('news.edit', $new->id) }}" class="btn btn-primary btn-sm border-0"><i class="fa fa-edit"></i> Edit</a>
                                <div class="mx-2"></div>
                                <form action="{{ route('news.destroy', $new->id) }}" class="js-delete-news-form form-inline d-inline" method="post" class="d-inline">
                                    @csrf()
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm border-0">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('#news-table').DataTable({
            pageLength: 25,
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [-1, -2]
            }]
        });
        $(document).ready(function() {
            // Confirm before delete
            $('.js-delete-news-form').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You Want to delete this News??`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                    if (result.value) {
                        e.target.submit();
                    } else {
                        $(this).find('button[type="submit"]').prop('disabled', false);
                    }
                })
            });
        });
    });
</script>
<script>
    function FailedResponseFromDatabase(message) {
        html_error = "";
        $.each(message, function(index, message) {
            html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> ' + message + '</p>';
        });
        Swal.fire({
            icon: 'warning',
            type: 'error',
            title: 'Oops...',
            html: html_error,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }

    function DataSuccessInDatabase(message) {
        Swal.fire({
            icon: 'success',
            // position: 'top-end',
            type: 'success',
            title: 'Done',
            html: message,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }
</script>
<script>
    $(function() {
        $('.newsStatus').change(function() {
            var news_id = $(this).attr('rel');
            if ($(this).prop("checked") == true) {
                $.ajax({
                    method: "POST",
                    url: '/api/news/' + news_id + '/publish',
                    data: {
                        _method: "put"
                    },
                    success: function(response) {
                        if (response.status == 'false') {
                            FailedResponseFromDatabase(response.message);
                        }
                        if (response.status == 'true') {
                            DataSuccessInDatabase(response.message);
                        }
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: '/api/news/' + news_id + '/unpublish',
                    data: {
                        _method: "delete"
                    },
                    success: function(response) {
                        if (response.status == 'false') {
                            FailedResponseFromDatabase(response.message);
                        }
                        if (response.status == 'true') {
                            DataSuccessInDatabase(response.message);
                        }
                    }
                });
            }
        })
    })
</script>
<script>
    $(function() {
        $('.newsVerifyStatus').change(function() {
            var news_id = $(this).attr('rel');
            if ($(this).prop("checked") == true) {
                $.ajax({
                    method: "POST",
                    url: '/api/news/' + news_id + '/verify',
                    data: {
                        _method: "put"
                    },
                    success: function(response) {
                        if (response.status == 'false') {
                            FailedResponseFromDatabase(response.message);
                        }
                        if (response.status == 'true') {
                            DataSuccessInDatabase(response.message);
                        }
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: '/api/news/' + news_id + '/unverify',
                    data: {
                        _method: "delete"
                    },
                    success: function(response) {
                        if (response.status == 'false') {
                            FailedResponseFromDatabase(response.message);
                        }
                        if (response.status == 'true') {
                            DataSuccessInDatabase(response.message);
                        }
                    }
                });
            }
        })
    })
</script>
@endpush