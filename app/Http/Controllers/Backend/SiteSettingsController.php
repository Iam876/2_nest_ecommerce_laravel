<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SiteSetting\siteSetting;
use App\Models\Seo\SeoSettings;
use Intervention\Image\Facades\Image;

class SiteSettingsController extends Controller
{
    public function CompanySiteSettings()
    {
        $CompanySettings = siteSetting::where('id', 1)->first();
        return view('backend.siteSettings.companySite', compact('CompanySettings'));
    }
    public function CompanyUpdate(Request $request)
    {
        $request->validate([
            'LogoUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        if ($request->hasFile('LogoUpload')) {
            $image = $request->file('LogoUpload');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(671, 206)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;

            $oldImage = siteSetting::findOrFail(1);
            $thumbnail = public_path($oldImage->logo);
            if (file_exists($thumbnail)) {
                @unlink($thumbnail);
            }
        }


        siteSetting::where('id', 1)->update([
            'logo'  => $save_url,
            'short_desc'    => $request->short_desc,
            'message'   => $request->offerMessage,
            'open_hours'    => $request->OpenHours,
            'active_days'   => $request->OpenDays,
            'support_phone' => $request->supportContact,
            'phone_one' => $request->Contact_second,
            'email' => $request->email,
            'company_address'   => $request->address,
            'facebook'  => $request->Facebook,
            'twitter'   => $request->Twitter,
            'youtube'   => $request->Youtube,
            'instagram' => $request->Instagram,
            'pinterest' => $request->Pinterest,
            'copyright' => $request->Copyright,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Site Settings Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AdminSiteSettings()
    {
    }
    public function VendorSiteSettings()
    {
    }
    public function seoSettings()
    {
        $seo = SeoSettings::findOrFail(1);
        return view('backend.seo.seoSettings', compact('seo'));
    }
    public function seoSettingsUpdate(Request $request)
    {
        $seo = SeoSettings::findOrFail(1);
        $seo->update([
            'meta_title'  => $request->meta_title,
            'meta_author'  => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);
        $notification = array(
            'message' => 'Site Seo Settings Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}