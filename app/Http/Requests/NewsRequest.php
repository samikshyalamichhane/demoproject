<?php

namespace App\Http\Requests;

use App\Rules\FacebookLink;
use App\Rules\TiktokLink;
use App\Rules\YoutubeLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' =>'required|exists:categories,id',
            // 'description' => Rule::requiredIf('category_id',1),
            'title' => 'required|max:500',
            'description' => ['required_if:category_id,1'],
            'description' => ['required_if:category_id,2'],
            'short_description' => ['required_if:category_id,1'],
            'short_description' => ['required_if:category_id,2'],
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg|max:5000',
            'youtube_video_link' => ['nullable','url', new YoutubeLink],
            'facebook_video_link' =>  ['nullable','url', new FacebookLink],
            'tiktok_video_link' => ['nullable','url', new TiktokLink],
            'video' => 'nullable|mimes:webm,mp4|max:5000',
            // 'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/webm,video/mp4|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'category_id.numeric' => 'Invalid category value.',
            'short_description.required_if:category_id' => 'ssddd',
            'description.required_if:category_id' => 'ssddd',
        ];
    }
}
