<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\returnSelf;

class SubDistrictController extends Controller
{
    public function Index()
    {
        $subdistrict = DB::table('subdistricts')
            ->join('districts', 'subdistricts.district_id', 'districts.id')
            ->select('subdistricts.*', 'districts.district_en')
            ->orderBy('id', 'desc')->paginate(3);
        return view('backend/subdistrict/index', compact('subdistrict'));
    }

    public function AddSubSubDistrict()
    {
        $district = DB::table('districts')->get();
        return view('backend/subdistrict/create', compact('district'));
    }

    public function StoreSubDistrict(Request $request)
    {
        // Validated
        $request->validate([
            'subdistrict_en' => 'required|unique:subdistricts|max:255',
            'subdistrict_jp' => 'required|unique:subdistricts|max:255',
        ]);

        // dataset
        $data = array();
        $data['subdistrict_en'] = $request->subdistrict_en;
        $data['subdistrict_jp'] = $request->subdistrict_jp;
        $data['district_id'] = $request->district_id;

        DB::table('subdistricts')->insert($data);

        $notification = array(
            'message' => 'SubDistrict Inserted Successfully',
            'alert-type' => 'error'
        );

        // ridrect
        return Redirect()->route('subdistricts')->with($notification);
    }

    public function EditSubDistrict($id)
    {
        $subdistrict = DB::table('subdistricts')->where('id', $id)->first();
        return view('backend/subdistrict/edit', compact('subdistrict'));
    }

    public function UpdateSubDistrict(Request $request, $id)
    {
        $data = array();
        $data['subdistrict_en'] = $request->subdistrict_en;
        $data['subdistrict_jp'] = $request->subdistrict_jp;

        DB::table('subdistricts')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'SubDistrict Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('subdistricts')->with($notification);
    }

    public function DeleteSubDistrict($id)
    {
        DB::table('subdistricts')->where('id', $id)->delete();

        $notification = array(
            'message' => 'SubDistrict Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('subdistricts')->with($notification);
    }
}