<?php

namespace App\Http\Controllers;

use App\Models\Citizens;
use App\Http\Requests\StoreCitizensRequest;
use App\Http\Requests\UpdateCitizensRequest;
use App\Models\Wards;
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
        $wards = Wards::orderBy('name', 'ASC')->get();

        return view('pages.citizens.index', compact('citizens', 'wards'));
    }

    public function AddCitizens(Request $request)
    {
        // $validated = $request->validate(
        //     [
        //         'category_name' => 'required|unique:categories|max:255',

        //     ],
        //     [
        //         'category_name.required' => 'Please Input Category Name',
        //         'category_name.max' => 'Category Name Must be Less than 255 Characters',

        //     ]
        // );


        $citizens = new Citizens();

        $citizens->name = $request->name;
        $citizens->gender = $request->gender;
        $citizens->address = $request->address;
        $citizens->phone = $request->phone;
        $citizens->ward_id = $request->ward_id;
        $citizens->save();


        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }


}
