@extends('layouts.front.front')
@section('content')

<main>
    <section id="bichar">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site__title-box pt-2">
                        <h2 class="site__title">
                            <span class="text-capitalize">{{ $category->name }}</span>
                        </h2>
                    </div>
                </div>
            </div>
            @if($category->slug == 'news' || $category->slug == 'opinion' || $category->slug == 'images' || $category->slug == 'press-release')
            <div class="row">
                @foreach($news as $data)
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

                @endforeach

            </div>
            @endif
            @if($category->slug == 'videos')
            <div class="container">
            <div class="row">
                @foreach($news as $allvideo)
                        @if($allvideo->youtube_video_link!=null)
                <div class="col-md-4 mb-2">
                    <div class="card w-100">
                        
                            <div class="video-wrapper">
                                <iframe class="video-playlist__small" src="https://www.youtube.com/embed/{{@$allvideo->youtubeVideo($allvideo->youtube_video_link)}}" width="400" height="400" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        <a href="{{route('newsInner', $allvideo->slug)}}">
                            <h5 style="text-align:center;" class="card-title">{{$allvideo->title}}</h5>
                        </a>
                       
                    </div>
                </div>
                @endif

                @endforeach
            </div>
        </div>


            <div class="row">
                @foreach($news as $allvideo)
                @if($allvideo->facebook_video_link)
                <div class="col-md-4 mb-2">
                    <div class="card w-100">
                            <div class="video-wrapper">

                                <iframe src="https://www.facebook.com/plugins/video.php?height=300&href={{$allvideo->facebook_video_link}}&show_text=false&width=400&t=0" width="400" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>

                            </div>
                        <a href="{{route('newsInner', $allvideo->slug)}}">
                            <h5 style="text-align:center;" class="card-title">{{$allvideo->title}}</h5>
                        </a>
                        
                    </div>
                </div>
                @endif
                @endforeach
            </div>


            <div class="row">
                @foreach($news as $allvideo)
                    @if($allvideo->tiktok_video_link)
                    <div class="col-md-4 mb-2">
                        <div class="card w-100">
                            <div class="video-wrapper">
                                <blockquote class="tiktok-embed" cite="{{$allvideo->tiktokVideo($allvideo->tiktok_video_link).'video/'.$allvideo->getTiktokUrl($allvideo->tiktok_video_link)}}" data-video-id="{{$allvideo->getTiktokUrl($allvideo->tiktok_video_link)}}" style="max-width: 200px;min-width: 300px;max-height:fit-content">
                                    <section> </section>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>

                            </div>
                            <a href="{{route('newsInner', $allvideo->slug)}}">
                                <h5 style="text-align:center;" class="card-title">{{$allvideo->title}}</h5>
                            </a> 
                        </div>
                    </div>
                    @endif 
                @endforeach


                </div>
                @endif
            </div>
        </div>
    </section>
</main>

@endsection