@extends('layouts.master')

@section('page_title', 'News List')

@section('content')

<div class="container-fluid mt-3">
    <div class="card">
        <div class="card-header">News View</div>
        <div class="card-body ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">News</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Title</th>
                        <td class="text-capitalize">{{$news->title}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Slug</th>
                        <td>{{$news->slug}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Posted By</th>
                        <td class="text-capitalize">{{$news->user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Category</th>
                        <td class="text-capitalize">{{$news->category->name}}</td>
                    </tr>
                    <tr>
                        <th scope="row">You Tube Video Link </th>
                        <td class="text-capitalize">{{$news->youtube_video_link}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Short Description</th>
                        <td class="text-capitalize">{!!$news->short_description!!}</td>

                    </tr>
                    <tr>
                        <th scope="row">Description</th>
                        <td class="text-capitalize">{!!$news->description!!}</td>
                    </tr>
                    <tr>
                        <th scope="row">Image</th>
                        <td> <img src="{{Storage::url($news->image)}}" alt="{{ $news->title }}" class="rounded" style="height: 3rem;"> </td>
                    </tr>
                    <!-- <tr>
                        <th scope="row">Video</th>
                        <td>
                            
                            <video width="320" height="240" controls>
                                <source src="{{Storage::url($news->video)}}" type="video/mp4">
                            </video>
                        </td>
                    </tr> -->
                    <tr>
                        <th scope="row">Publish</th>
                        <td>
                            <div style="display:inline-block; width:75px" class="badge {{ $news->publish==1 ? 'bg-primary' : 'badge-danger' }} text-capitalize">
                                {{ $news->publish == 1 ? 'Published' : 'Not Published' }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection