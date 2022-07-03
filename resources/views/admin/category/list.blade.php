@extends('layouts.master')

@section('page_title', 'Edit password')

@section('content')

<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">Category List</div>
        <div class="card-body ">
            <table class="table table-striped table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <th>{{$loop->iteration}}</th>
                        <td class="text-capitalize"> {{$category->name}} </td>
                        <td>{{$category->slug}}</td>
                        <td><div style="display:inline-block; width:100px" class="badge {{ $category->publish==1 ? 'bg-primary' : 'badge-danger' }} text-capitalize">
                            {{ $category->publish == 1 ? 'Published' : 'Not Published' }}
                        </div></td>
                    </tr>
                    @empty
                    <tr>
                        <td>
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