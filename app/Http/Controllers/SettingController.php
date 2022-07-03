<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit(Setting $setting){
        // dd($setting);
        return view('admin.setting',compact('setting'));
    }

    public function update(Request $request, Setting $setting){
        // dd($setting);
        if ($request->hasFile('logo')) {
            $setting->deleteImage();
            $setting->logo = $request->file('logo')->store('public/uploads/setting');
        }
        if ($request->hasFile('header_ad')) {
            $setting->deleteImage();
            $setting->header_ad = $request->file('header_ad')->store('public/uploads/setting');
        }
        if ($request->hasFile('favicon')) {
            $setting->deleteImage();
            $setting->favicon = $request->file('favicon')->store('public/uploads/setting');
        }
        $setting->guideline_video_link = $request->guideline_video_link;
        $setting->update();
        return redirect()->back()->with('success', 'Setting Updated Successfully!');
    }
}
