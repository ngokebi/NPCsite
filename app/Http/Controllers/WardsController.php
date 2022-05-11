<?php

namespace App\Http\Controllers;

use App\Models\Wards;
use App\Http\Requests\StoreWardsRequest;
use App\Http\Requests\UpdateWardsRequest;
use App\Models\Lga;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WardsController extends Controller
{


    public function AllWards()
    {

        $wards = Wards::paginate(10); // paginate
        $lgas = Lga::orderBy('name', 'ASC')->get();

        return view('pages.wards.index', compact('wards', 'lgas'));
    }


    public function AddWards(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:wards|max:255|min:3',
                'lga_id' => 'required|unique:lgas'

            ],
            [
                'name.required' => 'Please Input Wards Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'lga_id.required' => 'Please Input Local Government Name',


            ]
        );

        $wards = new Wards();

        $wards->name = $request->name;
        $wards->lga_id = $request->lga_id;
        $wards->save();

        return Redirect()->back()->with('success', 'Ward Inserted Successfully');
    }

    public function EditWards($id)
    {

        $wards = wards::find($id);


        return view('pages.wards.edit', compact('wards'));
    }

    public function UpdateWards(Request $request, $id)
    {

        $update = Wards::find($id)->update([
            'name' => $request->name,
            'lga_id' => $request->lga_id

        ]);

        return Redirect()->route('wards')->with('success', 'Ward Updated Successfully');
    }

    public function Delete($id)
    {
        $delete = Wards::find($id)->delete();
        return Redirect()->back()->with('success', 'Ward Deleted Successfully');
    }
}
