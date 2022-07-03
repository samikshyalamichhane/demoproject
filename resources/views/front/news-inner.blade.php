@extends('layouts.front.front')
@push('ogtags')
<meta property="og:title" content="{{$news->title}}">
<meta property="og:description" content="{{$news->short_description}}">
<meta property="og:image" content="{{Storage::url($news->image)}}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@hamrodristi">
<meta name="twitter:title" content="{{$news->title}} ">
<meta name="twitter:description" content="{{$news->short_description}}">

@endpush
@section('content')

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="">
                    <div class="wp-post-title col-12 align-items-center justify-content-between d-flex flex-wrap">
                        <h3 class="post-title featured_news detail_news_title">
                            {{$news->title}}
                        </h3>
                        <div class="sharethis-inline-share-buttons"></div>
                    </div>

                    <div class="post-date d-flex align-items-center justify-content-start px-15 col-12 p-b30">
                        <div class="postImage">
                            <img src="http://drishtisanchar.com/images/thumbnail/1648799007.jpg" alt="upload-post" class="postImage__Image">
                        </div>
                        <div class="postMeta">
                            <div class="postImage-Man">
                                <a href="#">
                                    {{$news->user->name}}
                                    @if($news->edited == 1)
                                    <span style="color: red;">(Edited By Admin)</span>
                                    @endif
                                </a>

                            </div>
                            <div class="singlePostMeta">
                                <i class="fa fa-clock-o"></i>
                                <strong>
                                    {{$calendar->NEP_DATE_TIME($news->created_at)}}
                                </strong>
                            </div>
                        </div>
                    </div>
                    @if($news->category->slug == 'news' || $news->category->slug == 'opinion' || $news->category->slug == 'images' || $news->category->slug == 'press-release')
                    <div class="col-md-8 col-sm-12 mt-3 p-lr0 ">
                        <div class="wt-img-effect zoom-slow">
                            <a href=""><img src="{{Storage::url($news->image)}}" alt="" class="img-fluid"></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3 p-lr5">
                        <div class="wt-post-info  bg-white nb">
                            <div class="wt-post-title detail_news_summary">
                                {!!$news->description!!}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    
                    @if($news->category->slug == 'videos')
                    <div class="row nt">
                        @if($news->youtube_video_link)
                        <div class="col-md-6 col-sm-12 p-lr0 ">
                            <div class="newtitle">
                                <h3>You Tube</h3>
                            </div>
                            <div class="nb">
                                <div class="video-wrapper">
                                    <iframe class="video-playlist__small" src="https://www.youtube.com/embed/{{$news->youtubeVideo($news->youtube_video_link)}}" width="400" height="400" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($news->video)
                        <div class="col-md-6 col-sm-12 p-lr0 ">
                            <div class="newtitle">
                                <h3>Upload videos</h3>
                            </div>
                            <div class="nb">
                                <div class="video-wrapper">
                                    <video width="350" height="400" controls autoplay>
                                        <source src="{{Storage::url($news->video)}}" type="video/{{pathinfo($news->video, PATHINFO_EXTENSION)}}">
                                    </video>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row nt">
                        @if($news->facebook_video_link)
                        <div class="col-md-6 col-sm-12 p-lr5 p-t10">
                            <div class="newtitle">
                                <h3>Facebook</h3>
                            </div>
                            <div class="wt-post-info  bg-white nb">

                                <div class="video-wrapper">
                                    <iframe src="https://www.facebook.com/plugins/video.php?height=300&href={{$news->facebook_video_link}}&show_text=false&width=400&t=0" width="400" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
                                </div>


                            </div>
                        </div>
                        @endif
                        @if($news->tiktok_video_link)
                        <div class="col-md-6 col-sm-12 p-lr5 p-t10">
                            <div class="newtitle">
                                <h3>TikTok</h3>
                            </div>
                            <div class="wt-post-info  bg-white nb">

                                <div class="video-wrapper">
                                    <div class="">
                                        <blockquote class="tiktok-embed" cite="{{$news->tiktokVideo($news->tiktok_video_link).'video/'.$news->getTiktokUrl($news->tiktok_video_link)}}" data-video-id="{{$news->getTiktokUrl($news->tiktok_video_link)}}" style="max-width: 200px;min-width: 300px;max-height:fit-content">
                                            <section> </section>
                                        </blockquote>
                                    </div>
                                    <script async src="https://www.tiktok.com/embed.js"></script>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                </div>
                <div class="mt-4 sharethis-inline-share-buttons"></div>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                <!-- <div class="fb-like" data-href="{{Request::url()}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div> -->
                <div class="fb-comments" data-href="{{Request::url()}}" data-width="" data-numposts="10"></div>

            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="site__title-box my-3">
                            <h2 class="site__title">
                                <span>ताजा अपडेट</span>
                            </h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <ul class="trending_news">
                            @foreach($latestNews as $data)
                            @if($data->category->slug == 'news' || $data->category->slug == 'opinion' || $data->category->slug == 'images')
                            <li>
                                <a href="{{route('newsInner', $data->slug)}}">
                                    <div class="trend_image">
                                        <img src="{{Storage::url($data->image)}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="trend_title">
                                        <div class="p-lr5">
                                            <h4 class="m-t5 trending_news_title font_weight">
                                                {{ $data->title }}
                                            </h4>
                                        </div>
                                        <div class="post-date p-t0 p-lr5">
                                            <span class="fa fa-clock-o"></span> <strong>
                                                {{$calendar->ENG_TO_NEP_TIME($data->created_at)}}
                                            </strong>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endif
                            @if($data->category->slug == 'videos')
                            <li>
                                <a href="{{route('newsInner', $data->slug)}}">
                                    <div class="video-wrapper">
                                        <iframe class="video-playlist__small" src="https://www.youtube.com/embed/{{$data->youtubeVideo($data->youtube_video_link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    <div class="trend_title">
                                        <div class="p-lr5">
                                            <h4 class="m-t5 trending_news_title font_weight">
                                                {{ $data->title }}
                                            </h4>
                                        </div>
                                        <div class="post-date p-t0 p-lr5">
                                            <span class="fa fa-clock-o"></span> <strong>
                                                {{$calendar->ENG_TO_NEP_TIME($data->created_at)}}
                                            </strong>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <div class="site__title-box my-3">
                        <h2 class="site__title">
                            <span>सम्बन्धित समाचारहरु</span>
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>

                @foreach($relatedNews as $data)
                @if($data->category->slug == 'news' || $data->category->slug == 'opinion' || $data->category->slug == 'images')
                <div class="col-lg-3 col-sm-6 col-xs-12 p-lr5 p-t10">
                    <div class="wt-post-media wt-img-effect relatedPostCard zoom-slow">
                        <a href="{{route('newsInner', $data->slug)}}"><img src="{{Storage::url($data->image)}}" alt=""></a>
                    </div>
                    <div class="post-date p-t5">
                        <span class="reporter_name">
                            <span class="fa fa-user"></span>
                            {{$data->user->name}}
                        </span>
                        <span class="fa fa-clock-o"></span> <strong>
                            {{$calendar->NEP_DATE_TIME($data->created_at)}}
                        </strong>
                    </div>
                    <div class="wt-post-info  bg-white">
                        <div class="wt-post-title eco_news ">
                            <h3 class="post-title economics_news">
                                <a href="{{route('newsInner', $data->slug)}}">
                                    {{ $data->title }}
                                </a>
                            </h3>

                        </div>
                    </div>
                </div>
                @endif
                @if($data->category->slug == 'videos')
                <div class="col-lg-3 col-sm-6 col-xs-12 p-lr5 p-t10">
                    <div class="wt-post-media wt-img-effect relatedPostCard zoom-slow">
                        <iframe class="video-playlist__small" src="https://www.youtube.com/embed/{{$data->youtubeVideo($data->youtube_video_link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="post-date p-t5">
                        <span class="reporter_name">
                            <span class="fa fa-user"></span>
                            {{$data->user->name}}
                        </span>
                        <span class="fa fa-clock-o"></span> <strong>
                            {{$calendar->NEP_DATE_TIME($data->created_at)}}
                        </strong>
                    </div>
                    <div class="wt-post-info  bg-white">
                        <div class="wt-post-title eco_news ">
                            <h3 class="post-title economics_news">
                                <a href="{{route('newsInner', $data->slug)}}">
                                    {{ $data->title }}
                                </a>
                            </h3>

                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>
</main>

@endsection
@push('scripts')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=624ac3d703795c001aadaf1d&product=sop' async='async'></script>
@endpush