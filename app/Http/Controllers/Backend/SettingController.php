<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("can:update-setting")->only("index");
    }
    public function index()
    {
        $setting = Setting::first();
        // dd($setting);
        return view('backend.pages.website.setting', compact('setting'));
    }

    public function update(Request $request, string $id)
    {
        $setting = Setting::first();

        $request->validate([
            'site_name' => 'required|string|max:255',
        ]);

        $fields = [
            'site_name', 'site_title', 'address', 'address2', 'phone', 'email',
            'footer_text', 'newslatter_text', 'facebook', 'twitter', 'instagram',
            'youtube', 'linkedin', 'pinterest', 'google_map', 'meta_title',
            'headline', 'meta_description', 'meta_keywords', 'terms_and_conditions',
            'privacy_policy'
        ];

        foreach($fields as $field) {
            $setting->$field = $request->$field;
        }

        //favicon
        if ($request->hasFile('favicon')) {
            if ($setting->favicon && file_exists(public_path('uploads/' . $setting->favicon))) {
                @unlink(public_path('uploads/' . $setting->favicon));
            }
            $image = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $filename);
            $setting->favicon = $filename;
        }

        //logo
        if ($request->hasFile('logo')) {
            if ($setting->logo && file_exists(public_path('uploads/' . $setting->logo))) {
                @unlink(public_path('uploads/' . $setting->logo));
            }
            $image = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/'), $filename);
            $setting->logo = $filename;
        }

        $setting->save();
        toast('Settings updated successfully!', 'success');
        return redirect()->route('settings.index');
    }
}
