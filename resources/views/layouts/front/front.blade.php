<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Hamro Dristi is a news portal website">
    <meta name="keywords" content="Hamro Dristi, nepali khabar" />
    <meta name="author" content="Hamro Dristi">
    <title>Drishti Sanchar</title>
    <link rel="icon" type="image/png" href="{{Storage::url($setting->favicon)}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('front/style.css')}}">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=624ac1918183fa001adbd0b7&product=inline-share-buttons" async="async"></script>
    @stack('ogtags')
</head>

<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=524853582566764&autoLogAppEvents=1" nonce="Sw9kEytf"></script>
<!-- header -->
    <header id="header" class="my-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo d-none d-lg-block">
                        <a href="/">
                            <img src="{{Storage::url($setting->logo)}}" alt="logo" class="img-fluid">
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="top-Ad d-none d-lg-block">
                        <div class="login d-flex justify-content-end">
                            <a href="#" target="_blank" class="">
                                <img src="{{Storage::url($setting->header_ad)}}" alt="topAd" class="img-fluid">
                            </a>
                        </div>
                        <div>
                            <p style="text-align:center;" ><strong><i>Platfrom idea & concept is the copyright of percept media production Pvt.Ltd.</i></strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->

    <!-- Navbar -->
    <section id="hamroNavbar" class="sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="index.html" class="d-lg-none navbar-brand__img">
                    <img src="http://drishtisanchar.com/images/new-logo.png" alt="logo" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a href="{{route('home')}}" class="nav-link"><i class="fa fa-home"></i> Home</a></li>
                        <li class="nav-item"><a href="{{route('newsByCategory','news')}}" class="nav-link">News</a></li>
                        <li class="nav-item"><a href="{{route('newsByCategory','opinion')}}" class="nav-link">Opinions</a></li>
                        <li class="nav-item"><a href="{{route('newsByCategory','images')}}" class="nav-link">Images</a></li>
                        <li class="nav-item"><a href="{{route('newsByCategory','videos')}}" class="nav-link">Videos</a></li>
                        <li class="nav-item"><a href="{{route('newsByCategory','press-release')}}" class="nav-link">Press Release</a></li>
                    </ul>
                    <div class="wt-header-right star_fm">
                        <form action="{{route('searchNews')}}">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" placeholder="Search Here" value="{{ request()->title ?? null }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary mr-2" type="submit">Search!</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <a href="#guideline" class="btn btn-sm btn-success mr-2" data-toggle="modal">Guideline</a>

                    <div class="sideNav ml-md-0 ml-2 mb-md-0 mb-3">
                        @if(!auth()->check())
                        <a href="{{route('customer.login-form')}}" class="btn btn-danger">Login </a>
                        <a href="{{route('customer.register-form')}}" class="btn btn-danger">Signup </a>
                        @elseif(!auth()->user()->is_admin)
                        <a href="{{route('news.create')}}" class="btn btn-danger">Add News </a>
                        @endif

                    </div>
                </div>
            </div>
        </nav>
    </section>
    <!-- Navbar end -->
    <!-- Modal -->
    <div id="guideline" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                <iframe id="Geeks3" width="450" height="350" src="https://www.youtube.com/embed/{{$setting->youtubeVideo($setting->guideline_video_link)}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                           
                    <!-- <iframe id="Geeks3" width="450" height="350" src="https://www.youtube.com/embed/{{$setting->youtubeVideo($setting->youtube_video_link)}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <!-- footer start -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="site__title-box">
                        <h2 class="site__title justify-content-center">Contact</h2>
                        <div class="heading-divider"></div>
                    </div>
                    <p class="footername__List-title"> Percept Media Production Pvt.Ltd. </p>
                    <p class="footername__List-small">Chabahil 7, Kathmandu, Nepal</p>
                    <p class="footername__List-title">Information Department Registration No:</p>
                    <p class="footername__List-small">3133/078/79</p>
                    <div class="mb-3">
                        <p class="footername__List-title">For News</p>
                        <a class="footername__List-small" href="telto: 01-4562090,9841440365">01-4562090 ,9841440365</a>
                    </div>
                    <div class="mb-3">
                        <p class="footername__List-title">For Advertisment</p>
                        <a class="footername__List-small" href="telto: 9851182365">9851182365</a>
                    </div>
                    <p class="footername__List-title">E-mail</p>
                    <a class="footername__List-small">info@drishtisanchar.com</a><br>
                    <a class="footername__List-small">perceptmediapro@gmail.com</a>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="site__title-box">
                        <h2 class="site__title justify-content-center">Our Team</h2>
                        <div class="heading-divider"></div>
                    </div>

                    <div class="row">
                        <div class="team-items col-sm-12 col-md-4">
                            <div class="team-item">
                                <span class="post-title">Director</span>
                                <span class="post-name">Sushma Suwal</span>
                            </div>
                            <div class="team-item">
                                <span class="post-title">Editor</span>
                                <span class="post-name">Bishwo jyoti Baniya</span>
                            </div>
                            <div class="team-item">
                                <span class="post-title">News Coordinator</span>
                                <span class="post-name">Dipendra Nepali</span>
                            </div>
                            <div class="team-item">
                                <span class="post-title">Advisory</span>
                                <span class="post-name">Babita Lama</span>
                            </div>
                        </div>
                        <div class="team-items col-sm-12 col-md-4">
                            <div class="team-item">
                                <span class="post-title">Correspondent</span>
                                <span class="post-name">Dashi Ram Tharu</span>
                                <span class="post-name">Khagendra Thapa </span>
                                <span class="post-name">Ayushma Aryal</span>
                                <span class="post-name">Karishma Rawal</span>

                            </div>
                            <div class="team-item">
                                <span class="post-title">Infographics</span>
                                <span class="post-name">Ranjit Thapa Magar</span>
                                <span class="post-name">Ashal Subba</span>
                            </div>
                            <div class="team-item">
                                <span class="post-title">Photo Journalist</span>
                                <span class="post-name">Aasha K.C.</span>
                                        <span class="post-name">Pukar Man Pradhan </span>
                                        <span class="post-name">Ngwang Sherpa </span>
                                        
                            </div>
                        </div>
                        <div class="team-items col-sm-12 col-md-4">
                            <div class="team-item">
                                <span class="post-title">Management</span>
                                <span class="post-name">Madhukar Rajbhandari</span>
                            </div>

                            <div class="team-item">
                                <span class="post-title">Marketing</span>
                                <span class="post-name">Vaskar Rajbhandari</span>
                            </div>
                            <div class="team-item">
                                <span class="post-title">Desk</span>
                                <span class="post-name">Anita Karki</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="site__title-box">
                        <h2 class="site__title justify-content-center">Social Media</h2>
                        <div class="heading-divider"></div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <ul class="footer-menu">
                                <li class="mb-3">
                                    <a href="/">Home</a>
                                </li>
                                <li><a href="http://drishtisanchar.com/gallery">Photo Story</a></li>
                            </ul>
                        </div>
                        <div class="col-8">
                            <div class="social-icons">
                                <ul class="footer-social-icons">
                                    <li><a href="https://facebook.com">
                                            <i class="fa fa-facebook-square mr-2" aria-hidden="true"></i>
                                            Facebook</a></li>
                                    <li><a href="https://twitter.com">
                                            <i class="fa fa-twitter-square mr-2" aria-hidden="true"></i>
                                            Twitter</a></li>
                                    <li><a href="https://youtube.com">
                                            <i class="fa fa-youtube-square mr-2" aria-hidden="true"></i>
                                            Youtube</a></li>
                                    <li><a href="https://instagram.com">
                                            <i class="fa fa-instagram mr-2" aria-hidden="true"></i>
                                            Instagram</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col social--links">
                    <div class="heading-divider"></div>
                    <div class="top__Social-Link text-center">
                        <a href="#">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                        <a href="#">
                            <i class="fa fa-youtube-play" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <section class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-footer__Copyright">
                        <p>All Right Reserved with Percept Media Production Pvt.Ltd.</p>
                        <p>Developed By: Web House Nepal</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var url = $("#Geeks3").attr('src');
            $("#guideline").on('hide.bs.modal', function() {
                $("#Geeks3").attr('src', '');
            });
            $("#guideline").on('show.bs.modal', function() {
                $("#Geeks3").attr('src', url);
            });
        });
    </script>
</body>

</html>