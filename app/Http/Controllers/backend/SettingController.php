<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use GuzzleHttp\RedirectMiddleware;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function SocialSetting()
    {
        $social = DB::table('socials')->first();
        return view('backend.setting.social', compact('social'));
    }

    public function SocialUpdate(Request $request, $id)
    {
        $data = array();
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;

        DB::table('socials')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Social Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('social.setting')->with($notification);
    }

    public function SeoSetting()
    {
        $seo = DB::table('seos')->first();
        return view('backend.setting.seo', compact('seo'));
    }

    public function SeoUpdate(Request $request, $id)
    {
        $data = array();
        $data['meta_author'] = $request->meta_author;
        $data['meta_title'] = $request->meta_title;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_analytics'] = $request->alexa_analytics;

        DB::table('seos')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Seo Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('seo.setting')->with($notification);
    }

    public function LivetvSetting()
    {
        $livetv = DB::table('livetvs')->first();
        return view('backend.setting.livetv', compact('livetv'));
    }

    public function LivetvUpdate(Request $request, $id)
    {
        $data = array();
        $data['embed_code'] = $request->embed_code;
        $data['status'] = $request->status;
        DB::table('livetvs')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Livetv Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('livetv.setting')->with($notification);
    }

    public function NoticeSetting()
    {
        $notice = DB::table('notices')->first();
        return view('backend.setting.notice', compact('notice'));
    }

    public function NoticeUpdate(Request $request, $id)
    {
        $data = array();
        $data['notice'] = $request->notice;
        $data['status'] = $request->status;
        DB::table('notices')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Notice Setting Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('notice.setting')->with($notification);
    }


    public function ActiveNoticeSetting(Request $request, $id)
    {
        DB::table('notices')->where('id', $id)->update(['status' => 1]);

        $notification = array(
            'message' => 'Notice Active Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function DeActiveNoticeSetting(Request $request, $id)
    {
        DB::table('notices')->where('id', $id)->update(['status' => 0]);

        $notification = array(
            'message' => 'Notice Setting Updated Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function WebsiteSetting()
    {
        $website = DB::table('websites')->orderBy('id', 'desc')->paginate(5);
        return view('backend.website.index', compact('website'));
    }

    public function AddWebsiteSetting()
    {
        return view('backend.website.create');
    }

    public function StoreWebsite(Request $request)
    {
        $data = array();
        $data['website_name'] = $request->website_name;
        $data['website_link'] = $request->website_link;

        DB::table('websites')->insert($data);

        $notification = array(
            'message' => 'Add Website Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.website')->with($notification);
    }

    public function EditWebsite($id)
    {
        $website = DB::table('websites')->where('id', $id)->first();
        return view('backend.website.edit', compact('website'));
    }

    public function UpdateWebsite(Request $request, $id)
    {
        $data = array();
        $data['website_name'] = $request->website_name;
        $data['website_link'] = $request->website_link;

        DB::table('websites')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Website Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.website')->with($notification);
    }

    public function DeleteWebsite($id)
    {
        DB::table('websites')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Website Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.website')->with($notification);
    }
}
