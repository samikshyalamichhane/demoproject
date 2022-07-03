@extends('layouts.master')

@section('page_title', 'Edit news')

@section('content')

<div class="container-fluid mt-3">
    <x-alert></x-alert>
    <x-validation-errors></x-validation-errors>
    <form method="post" action="{{route('news.update',$news->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-7">
                <div class="card ml-3">
                    <div class="card-header">News Edit</div>
                    <div class="card-body ">
                        <div class="col-lg-12 col-sm-12 form-group">
                            <label class="form-label">Category:</label>
                            <select name="category_id" id="category" class="form-control custom-select @error('category_id') is-invalid @enderror">
                                <option value="">Please Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id', $news->category_id) == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-none" id="title">
                            <label>Title</label>
                            <input type="text"  class="form-control" name="title" value="{{$news->title}}" placeholder="Enter Title">
                        </div>

                        <div class="form-group d-none" id="youtube_video_link">
                            <label>YouTube Video Link</label>
                            <input type="text"  class="form-control" name="youtube_video_link" value="{{$news->youtube_video_link}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="tiktok_video_link">
                            <label>Tiktok Video Link</label>
                            <input type="text" class="form-control" name="tiktok_video_link" value="{{$news->tiktok_video_link}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="facebook_video_link">
                            <label>Facebook Video Link</label>
                            <input type="text" class="form-control" name="facebook_video_link" value="{{$news->facebook_video_link}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="form-group d-none" id="short_description">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="3">{{$news->short_description}}</textarea>
                        </div>

                        <div class="form-group d-none" id="description">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description">{{$news->description}}</textarea>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-5">
            <div class="card" style="height: 30rem; width:25rem">
                <div class="card-body ">
                    

                        <div class="form-group d-none" id="upload-image">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" name="image" data-preview-el-id="image" onchange="handleUploadPreview()">
                            <div id="wrapper" class="py-2">
                                <div id="image-holder">
                                @if($news->image)
                                    <img src="{{Storage::url($news->image)}}" alt="No Image" id="image" class="rounded" style="height: 5rem; width: 5rem;">
                                    @endif
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group d-none" id="video">
                            <label for="image">Upload VideoUpload Video(Please Upload video of mp4 and webm type  and size upto 5MB.)</label>
                            <input type="file" class="form-control-file mb-2" name="video">
                            @if($news->video)
                            <video width="200" controls autoplay>
                            <source src="{{Storage::url($news->video)}}" type="video/{{pathinfo($news->video, PATHINFO_EXTENSION)}}">
                            </video>
                            @endif
                        </div>

                        <div class="form-group d-none form-check" id="publish">
                            <input type="checkbox" class="form-check-input" name="publish" id="publish" @if($news->publish) checked @endif>
                            <label class="form-check-label" for="publish">Publish</label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- <div class="card">
        <div class="card-header">News Create</div>
        <div class="card-body ">
            <form method="post" action="{{route('news.index')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea class="form-control" id="short_description" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <div id="wrapper" class="py-2">
                        <div id="image-holder">
                            <img src="https://dummyimage.com/800x800/e8e8e8/0011ff" name="pic" id="image" style="max-height: 250px;">
                        </div>
                    </div>
                    <input type="file" class="form-control-file" data-preview-el-id="image" onchange="handleUploadPreview()">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="publish">
                    <label class="form-check-label" for="publish">Publish</label>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div> -->
</div>

@endsection
@push('scripts')
<script>

    $(document).ready(function() {
        // Filter subcategory
        function filterSubcategory(selectedCategoryId) {
            let selectedCategoryIds = $("#category").val()
            if (selectedCategoryIds == 1 || selectedCategoryIds == 2 || selectedCategoryIds == 5) {
                $("#title").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").removeClass('d-none');
                $("#upload-image").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#tiktok_video_link").addClass('d-none');
                $("#facebook_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else if (selectedCategoryIds == 3) {
                $('#title').removeClass('d-none');
                $('#upload-image').removeClass('d-none');
                $("#short_description").addClass('d-none');
                $("#description").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#tiktok_video_link").addClass('d-none');
                $("#facebook_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else {
                $("#title").removeClass('d-none');
                $("#video").removeClass('d-none');
                $("#youtube_video_link").removeClass('d-none');
                $("#tiktok_video_link").removeClass('d-none');
                $("#facebook_video_link").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").addClass('d-none');
                $("#upload-image").addClass('d-none');
                $("#publish").removeClass('d-none');
            }

            console.log(selectedCategoryIds)
        }
        // On form load
        filterSubcategory({{ $news->category_id }});
    });
</script>
<script type="text/javascript">
    $(function() {


        $("#category").change(function() {
            if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 5) {
                $("#title").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").removeClass('d-none');
                $("#upload-image").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#tiktok_video_link").addClass('d-none');
                $("#facebook_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else if ($(this).val() == 3) {
                $('#title').removeClass('d-none');
                $('#upload-image').removeClass('d-none');
                $("#short_description").addClass('d-none');
                $("#description").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#tiktok_video_link").addClass('d-none');
                $("#facebook_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else {
                $("#title").removeClass('d-none');
                $("#video").removeClass('d-none');
                $("#youtube_video_link").removeClass('d-none');
                $("#tiktok_video_link").removeClass('d-none');
                $("#facebook_video_link").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").addClass('d-none');
                $("#upload-image").addClass('d-none');
                $("#publish").removeClass('d-none');
            }
        });
    });
</script>
@endpush