<?php

namespace App\Http\Controllers;

use App\Models\Citizens;
use App\Http\Requests\StoreCitizensRequest;
use App\Http\Requests\UpdateCitizensRequest;
use App\Models\Lga;
use App\Models\States;
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

    public function AllCitizens()
    {

        $citizens = Citizens::paginate(5);
        $wards = Wards::orderBy('name', 'ASC')->get();
        $states = States::orderBy('name', 'ASC')->get();

        return view('pages.citizens.index', compact('citizens', 'states'));
    }

    public function AddCitizens(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:citizens',
                'gender' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'ward_id' => 'required',
                'lga_id' => 'required',
                'state_id' => 'required',

            ],
            [
                'name.required' => 'Please Input Name',
                'gender.required' => 'Please Input Gender',
                'address.required' => 'Please Input Address',
                'phone.required' => 'Please Input Phone Number',
                'ward_id.required' => 'Please Input Ward',
                'lga_id.required' => 'Please Input Local Government',
                'state_id.required' => 'Please Input State',

            ]
        );


        $citizens = new Citizens();

        $citizens->name = $request->name;
        $citizens->gender = $request->gender;
        $citizens->address = $request->address;
        $citizens->phone = $request->phone;
        $citizens->ward_id = $request->ward_id;
        $citizens->state_id = $request->state_id;
        $citizens->lga_id = $request->lga_id;

        $citizens->save();


        return Redirect()->back()->with('success', 'Citizen Registered Successfully');
    }


    public function EditCitizens($id)
    {
        $lgas = Lga::orderBy('name', 'ASC')->get();
        $states = States::orderBy('name', 'ASC')->get();
        $wards = Wards::orderBy('name', 'ASC')->get();
        $edit_citizens = Citizens::findorFail($id);


        return view('pages.citizens.edit', compact('edit_citizens', 'states', 'lgas', 'wards'));
    }

    public function Delete($id)
    {
        $delete = Citizens::find($id)->delete();
        return Redirect()->back()->with('success', 'Citizen\'s Record was Deleted Successfully');
    }
}
