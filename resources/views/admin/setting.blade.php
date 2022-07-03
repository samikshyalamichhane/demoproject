@extends('layouts.master')

@section('page_title', 'Edit Setting')

@section('content')

<div class="container-fluid mt-3">
    <x-alert></x-alert>
    <x-validation-errors></x-validation-errors>
    <div class="card">
        <div class="card-header">Settings</div>
        <div class="card-body ">
            <form method="post" action="{{route('settings.update',$setting)}}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row">
                <div class="form-group col-6">
                    <label for="image">Upload Logo</label>
                    <div id="wrapper" class="py-2">
                        <div id="image-holder">
                            @if($setting->logo)
                            <img src="{{Storage::url($setting->logo)}}" alt="Image" id="image" class="rounded" style="height: 5rem; width: 5rem;">
                            @else
                            <img src="https://dummyimage.com/800x800/e8e8e8/0011ff" name="logo" id="image" style="max-height: 250px;">
                            @endif                        
                        </div>
                    </div>
                    
                    <input type="file" name="logo" class="form-control-file" data-preview-el-id="image" onchange="handleUploadPreview()">
                </div>
                <div class="form-group col-6">
                    <label for="image">Upload favicon</label>
                    <div id="wrapper" class="py-2">
                        <div id="image-holder">
                            @if($setting->favicon)
                            <img src="{{Storage::url($setting->favicon)}}" alt="Image" id="image" class="rounded" style="height: 5rem; width: 5rem;">
                            @else
                            <img src="https://dummyimage.com/800x800/e8e8e8/0011ff" name="favicon" id="image" style="max-height: 250px;">
                            @endif                        
                        </div>
                    </div>
                    
                    <input type="file" name="favicon" class="form-control-file" data-preview-el-id="image" onchange="handleUploadPreview()">
                </div>
                <div class="form-group col-6">
                    <label for="image">Upload header_ad</label>
                    <div id="wrapper" class="py-2">
                        <div id="image-holder">
                            @if($setting->header_ad)
                            <img src="{{Storage::url($setting->header_ad)}}" alt="Image" id="image" class="rounded" style="height: 5rem; width: 5rem;">
                            @else
                            <img src="https://dummyimage.com/800x800/e8e8e8/0011ff" name="header_ad" id="image" style="max-height: 250px;">
                            @endif                        
                        </div>
                    </div>
                    
                    <input type="file" name="header_ad" class="form-control-file" data-preview-el-id="image" onchange="handleUploadPreview()">
                </div>

                <div class=" col-6 form-group" id="guideline_video_link">
                            <label>Guideline Video Link</label>
                            <input type="text" class="form-control" name="guideline_video_link" value="{{$setting->guideline_video_link}}" placeholder="Enter Guideline video link">
                        </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection