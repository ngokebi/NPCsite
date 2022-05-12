<?php

namespace App\Http\Controllers;

use App\Models\Wards;
use App\Http\Requests\StoreWardsRequest;
use App\Http\Requests\UpdateWardsRequest;
use App\Models\Lga;
use App\Models\States;
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
        $states = States::orderBy('name', 'ASC')->get();


        return view('pages.wards.index', compact('wards', 'states'));
    }


    public function AddWards(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:wards|max:255|min:3',
                'lga_id' => 'required',
                'state_id' => 'required',

            ],
            [
                'name.required' => 'Please Input Wards Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'lga_id.required' => 'Please Input Local Government Name',
                'state_id.required' => 'Please Input State',


            ]
        );

        $wards = new Wards();

        $wards->name = $request->name;
        $wards->state_id = $request->state_id;
        $wards->lga_id = $request->lga_id;
        $wards->save();

        return Redirect()->back()->with('success', 'Ward Inserted Successfully');
    }

    public function Get_Lgas($state_id)
    {
        $getlgas = Lga::where('state_id', $state_id)->orderBy('name', 'ASC')->get();

        return json_encode($getlgas);
    }

    public function Get_Wards($lga_id)
    {
        $getwards = Wards::where('lga_id', $lga_id)->orderBy('name', 'ASC')->get();

        return json_encode($getwards);
    }


    public function EditWards($id)
    {
        $lgas = Lga::orderBy('name', 'ASC')->get();
        $states = States::orderBy('name', 'ASC')->get();
        $edit_wards = Wards::find($id);


        return view('pages.wards.edit', compact('edit_wards', 'lgas', 'states'));
    }

    public function UpdateWards(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'name' => 'required|unique:wards|max:255|min:3',
                'lga_id' => 'required',
                'state_id' => 'required',

            ],
            [
                'name.required' => 'Please Input Wards Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'lga_id.required' => 'Please Input Local Government Name',
                'state_id.required' => 'Please Input State',


            ]
        );

        $update = Wards::find($id)->update([
            'name' => $request->name,
            'state_id' => $request->state_id,
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
