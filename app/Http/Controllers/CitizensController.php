<?php

namespace App\Http\Controllers;

use App\Models\Citizens;
use App\Http\Requests\StoreCitizensRequest;
use App\Http\Requests\UpdateCitizensRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CitizensController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllCat()
    {

        // $categories = Category::all();  latest()->get() - to order by the latest  Eloquent

        $citizens = Citizens::paginate(5); // paginate


        return view('pages.citizen', compact('citizens'));
    }

    public function AddCat(Request $request)
    {
        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',

            ],
            [
                'category_name.required' => 'Please Input Category Name',
                'category_name.max' => 'Category Name Must be Less than 255 Characters',

            ]
        );

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);


        $category = new Citizens();

        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();


        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }


    // public function EditCat($id)
    // {
    //     //Eloquent
    //     // $categories = Category::find($id);

    //     // Query
    //     $categories = DB::table('categories')->where('id', $id)->first();

    //     return view('admin.category.edit', compact('categories'));
    // }

    // public function UpdateCat(Request $request, $id)
    // {
    //     // Eloquent
    //     // $update = Category::find($id)->update([
    //     //     'category_name' => $request->category_name,
    //     //     'user_id' => Auth::user()->id
    //     // ]);

    //     // Query Builder
    //     $data = array();
    //     $data['category_name'] = $request->category_name;
    //     $data['user_id'] = Auth::user()->id;
    //     DB::table('categories')->where('id', $id)->update($data);

    //     return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    // }

    // public function PDelete($id)
    // {
    //     $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
    //     return Redirect()->back()->with('success', 'Category Restore Successfully');
    // }
}
