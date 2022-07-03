@extends('layouts.front.front')
@section('content')

<main>
    <section id="bichar">
        @foreach($categories as $category)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site__title-box pt-2">
                        <h2 class="site__title">
                            <span>{{ucfirst($category->name)}}</span>
                            <a href="{{route('newsByCategory',$category->slug)}}" class="categoryTitleNav">
                                <span class="right__title">See All <i class="verticalThreeDots fa fa-bars"></i></span>
                            </a>
                        </h2>
                    </div>
                </div>
            </div>

            @if($category->slug == 'news' || $category->slug == 'opinion' || $category->slug == 'images' || $category->slug == 'press-release')
            <div class="row">
                @foreach($category->news()->published()->latest()->take(8)->get() as $data)
                <div class="col-md-3 mb-3">
                    <div class="card w-100">
                        <a href="{{route('newsInner', $data->slug)}}">
                            @if($data->image)
                            <img src="{{Storage::url($data->image)}}" class="img-fluid" alt="{{$data->title}}">
                            @endif
                        </a>
                        <div class="card-body">
                            <a href="{{route('newsInner', $data->slug)}}">
                                <h5 class="card-title">{{$data->title}}</h5>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @if($category->slug == 'videos')
            <div class="row">
                @foreach($category->news()->published()->latest()->take(8)->get() as $data)
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
                @endforeach
            </div>
            @endif
        </div>
        @endforeach

    </section>
</main>

@endsection