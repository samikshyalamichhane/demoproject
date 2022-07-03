@extends('layouts.master')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Users: {{$users_count}}</h5>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="stats">
                        <a href="{{route('users.index')}}" target="_blank" style="color:white">
                            <i class="fas fa-sync-alt text-white"></i>
                            <span> Go to Users List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total News: {{$news_count}}</h5>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="stats">
                        <a href="{{route('news.index')}}" target="_blank" style="color:white">
                            <i class="fas fa-sync-alt text-white"></i>
                            <span> Go to News List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total Today's News: {{$today_news_count}}</h5>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="stats">
                        <a href="{{route('news.getTodayNews')}}" target="_blank" style="color:white">
                            <i class="fas fa-sync-alt text-white"></i>
                            <span> Go to News List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection