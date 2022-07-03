@extends('layouts.front.front')
@section('content')

<main>
    <section id="bichar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site__title-box pt-2">
                        <h2 class="site__title">
                            <span class="text-capitalize"></span>
                        </h2>
                    </div>
                </div>
            </div>
            
            <div class="row">

                @foreach($searchedNews as $data)
                @if($data->category->slug == 'news' || $data->category->slug == 'opinion' || $data->category->slug == 'images' || $data->category->slug == 'press-release')

                <div class="col-md-3 mb-3">
                    <div class="card w-100">
                        <a href="{{route('newsInner', $data->slug)}}">
                            <img src="{{Storage::url($data->image)}}" class="img-fluid" alt="{{$data->title}}">
                        </a>
                        <div class="card-body">
                            <a href="{{route('newsInner', $data->slug)}}">
                                <h5 class="card-title">{{$data->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                @elseif($data->category->slug == 'videos')
                @if($data->youtube_video_link)
                <div class="col-md-3 mb-3">
                    <div class="card w-100">
                        <div class="col-md-4 mb-3">
                            <div class="video-wrapper">
                                <iframe class="video-playlist__small" src="https://www.youtube.com/embed/{{$data->youtubeVideo($data->youtube_video_link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{route('newsInner', $data->slug)}}">
                                <h5 class="card-title">{{$data->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                @elseif($data->video)
                <div class="col-md-3 mb-3">
                    <div class="card w-100">
                        <div class="col-md-4 mb-3 ml-3">
                            <div class="video-wrapper">
                                <video width="400" controls autoplay>
                                    <source src="{{Storage::url($data->video)}}" type="video/{{pathinfo($data->video, PATHINFO_EXTENSION)}}">
                                </video>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{route('newsInner', $data->slug)}}">
                                <h5 class="card-title">{{$data->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @endif
                @endforeach

            </div>
            <div class="d-flex justify-content-center">
                {!! $searchedNews->appends(request()->input())->links() !!}
            </div>
            
        </div>
    </section>
</main>

@endsection
@push('scripts')
<style>
        .pagination{
            float: right;
            margin-top: 10px;
        }
</style>
@endpush