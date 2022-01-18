<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function Index()
    {
        $category = DB::table('categories')->orderBy('id', 'desc')->paginate(3);
        return view('backend.category.index', compact('category'));
    }

    public function AddCategory()
    {
        return view('backend.category.create');
    }

    public function StoreCategory(Request $request)
    {
        $request->validate([
            'category_en' => 'required|unique:categories|max:255',
            'category_jp' => 'required|unique:categories|max:255',
        ]);

        $data = array();
        $data['category_en'] = $request->category_en;
        $data['category_jp'] = $request->category_jp;

        DB::table('categories')->insert($data);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('categories')->with($notification);
    }


    public function EditCategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('backend.category.edit', compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
        $data = array();
        $data['category_en'] = $request->category_en;
        $data['category_jp'] = $request->category_jp;

        DB::table('categories')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('categories')->with($notification);
    }

    public function DeleteCategory($id)
    {
        DB::table('categories')->where('id', $id)->delete();

        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('categories')->with($notification);
    }
}