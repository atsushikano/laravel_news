<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;

class GalleryController extends Controller
{
    public function PhotoGallery()
    {
        $photo = DB::table('photos')->orderBy('id', 'desc')->paginate(5);
        return view('backend.gallery.photos', compact('photo'));
    }

    public function AddPhoto()
    {
        return view('backend.gallery.createphoto');
    }

    public function StorePhoto(Request $request)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $image = $request->photo;
        if ($image) {
            $image_one = uniqid() . '.' . $image->getclientOriginalExtension();
            Image::make($image)->resize(500, 300)->save('image/photogallery/' . $image_one);
            $data['photo'] = 'image/photogallery/' . $image_one;
            DB::table('photos')->insert($data);

            $notification = array(
                'message' => 'Photo Inserted Successfully',
                'alert-type' => 'success'
            );


            return Redirect()->route('photo.gallery')->with($notification);
        } else {
            return Redirect()->back();
        } // End Condition
    } // End Method

    public function EditPhoto($id)
    {
        $photo = DB::table('photos')->where('id', $id)->first();
        return view('backend.gallery.editphoto', compact('photo'));
    }

    public function UpdatePhoto(Request $request, $id)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['type'] = $request->type;
        $image = $request->photo;
        $oldimage = $request->oldphoto;

        if ($image) {
            $image_one = uniqid() . '.' . $image->getclientOriginalExtension();
            Image::make($image)->resize(500, 300)->save('image/photogallery/' . $image_one);
            $data['photo'] = 'image/photogallery/' . $image_one;
            DB::table('photos')->where('id', $id)->update($data);
            unlink($oldimage);

            $notification = array(
                'message' => 'Photo Updated Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route('photo.gallery')->with($notification);
        } else {

            $data['photo'] = $oldimage;
            DB::table('photos')->where('id', $id)->update($data);

            $notification = array(
                'message' => 'Photo Updated Successfully',
                'alert-type' => 'info'
            );

            return Redirect()->route('photo.gallery')->with($notification);
        } // End Condition
    } // End Method

    public function DeletePhoto($id)
    {
        $photo = DB::table('photos')->where('id', $id)->first();
        unlink($photo->photo);

        $notification = array(
            'message' => 'Photo Deleted Successfully',
            'alert-type' => 'success'
        );

        DB::table('photos')->where('id', $id)->delete();

        return Redirect()->route('photo.gallery')->with($notification);
    }

    public function VideoGallery()
    {
        $video = DB::table('videos')->orderBy('id', 'desc')->paginate(5);
        return view('backend.gallery.videos', compact('video'));
    }

    public function AddVideo()
    {
        return view('backend.gallery.createvideo');
    }

    public function StoreVideo(Request $request)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['embed_code'] = $request->embed_code;
        $data['type'] = $request->type;
        DB::table('videos')->insert($data);

        $notification = array(
            'message' => 'Photo Inserted Successfully',
            'alert-type' => 'info'
        );

        return Redirect()->route('video.gallery')->with($notification);
    }

    public function EditVideo($id)
    {
        $video = DB::table('videos')->where('id', $id)->first();
        return view('backend.gallery.editvideo', compact('video'));
    }

    public function UpdateVideo(Request $request, $id)
    {
        $data = array();
        $data['title'] = $request->title;
        $data['embed_code'] = $request->embed_code;
        $data['type'] = $request->type;
        DB::table('videos')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Photo Updated Successfully',
            'alert-type' => 'info'
        );

        return Redirect()->route('video.gallery')->with($notification);
    }

    public function DeleteVideo($id)
    {
        DB::table('videos')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Video Deleted Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('video.gallery')->with($notification);
    }
}
