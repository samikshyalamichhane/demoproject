@extends('layouts.master')

@section('page_title', 'Create news')

@section('content')

<div class="container-fluid mt-3">
    <x-alert></x-alert>
    <x-validation-errors></x-validation-errors>
    <form method="post" action="{{route('news.index')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-sm-7">
                <div class="card ml-3">
                    <div class="card-header">News Create
                        <div class="float-right">
                            <a class="btn btn-info btn-md" href="{{route('news.index')}}">News List</a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="col-lg-12 col-sm-12 form-group">
                            <label class="form-label">Category:</label>
                            <select name="category_id" id="category" class="form-control custom-select @error('category_id') is-invalid @enderror">
                                <option value="">Please Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? "selected" : "" }}>{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-sm-12 form-group d-none" id="title">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Enter Title">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="youtube_video_link">
                            <label>YouTube Video Link</label>
                            <input type="text" class="form-control" name="youtube_video_link" value="{{old('youtube_video_link')}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="tiktok_video_link">
                            <label>Tiktok Video Link</label>
                            <input type="text" class="form-control" name="tiktok_video_link" value="{{old('tiktok_video_link')}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="facebook_video_link">
                            <label>Facebook Video Link</label>
                            <input type="text" class="form-control" name="facebook_video_link" value="{{old('facebook_video_link')}}" placeholder="Enter youtube video link">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="short_description">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="3">{{old('short_description')}}</textarea>
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="description">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description">{{old('description')}}</textarea>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card" style="height: 30rem; width:25rem">
                    <div class="card-body ">
                        <div class="col-lg-12 col-sm-12 form-group d-none" id="upload-image">
                            <label for="image">Upload Image</label>
                            <input type="file" class="form-control-file" name="image" data-preview-el-id="image" onchange="handleUploadPreview()">
                            <div id="wrapper" class="py-2">
                                <div id="image-holder">
                                    <img src="" name="pic" id="image" style="max-height: 100px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group d-none" id="video">
                            <label for="image">Upload Video(Please Upload video of mp4 and webm type  and size upto 5MB.)</label>
                            <input type="file" class="form-control-file" name="video">
                        </div>

                        <div class="col-lg-12 col-sm-12 form-group form-check" id="publish">
                            <input type="checkbox" class="form-check-input" name="publish" id="publish" checked>
                            <label class="form-check-label" for="publish">Publish</label>
                        </div>
                        <div class="col-lg-12 col-sm-12 form-group">
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
        function filterSubcategory(selectedCategoryId) {
            let selectedCategoryIds = $("#category").val()
            if (selectedCategoryIds == 1 || selectedCategoryIds == 2 || selectedCategoryIds == 5  ) {
                $("#title").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").removeClass('d-none');
                $("#upload-image").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else if (selectedCategoryIds == 3) {
                $('#title').removeClass('d-none');
                $('#upload-image').removeClass('d-none');
                $("#short_description").addClass('d-none');
                $("#description").removeClass('d-none');
                $("#publish").removeClass('d-none');
                $("#youtube_video_link").addClass('d-none');
                $("#video").addClass('d-none');
            } else if (selectedCategoryIds == 4) {
                $("#title").removeClass('d-none');
                $("#video").removeClass('d-none');
                $("#youtube_video_link").removeClass('d-none');
                $("#short_description").removeClass('d-none');
                $("#description").addClass('d-none');
                $("#upload-image").addClass('d-none');
                $("#publish").removeClass('d-none');
            }

            console.log(selectedCategoryIds)
        }
        // On form load
        filterSubcategory({
            {
                old('category_id')
            }
        });
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