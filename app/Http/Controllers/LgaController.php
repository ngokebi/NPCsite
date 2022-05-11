<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Http\Requests\StoreLGAsRequest;
use App\Http\Requests\UpdateLGAsRequest;
use App\Models\States;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LgaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllLgas()
    {

        $lgas = Lga::paginate(10); // paginate
        $states = States::orderBy('name', 'ASC')->get();

        return view('pages.lgas.index', compact('lgas', 'states'));
    }


    public function AddLgas(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:lgas|max:255|min:3',
                'state_id' => 'required|unique:lgas'

            ],
            [
                'name.required' => 'Please Input State Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'state_id.required' => 'Please Input State Name',


            ]
        );

        $lgas = new Lga();

        $lgas->name = $request->name;
        $lgas->state_id = $request->state_id;
        $lgas->save();

        return Redirect()->back()->with('success', 'Local Government Inserted Successfully');
    }

    // public function Get_Lgas($state_id)
    // {
    //     $subcat = LGAs::where('state_id', $state_id)->orderBy('name', 'ASC')->get();

    //     return json_encode($subcat);
    // }

    public function EditLgas($id)
    {

        $lgas = Lga::find($id);


        return view('pages.lgas.edit', compact('lgas'));
    }

    public function UpdateLgas(Request $request, $id)
    {

        $update = Lga::find($id)->update([
            'name' => $request->name,
            'state_id' => $request->state_id

        ]);

        return Redirect()->route('lgas')->with('success', 'Local Government Updated Successfully');
    }

    public function Delete($id)
    {
        $delete = Lga::find($id)->delete();
        return Redirect()->back()->with('success', 'Local Government Deleted Successfully');
    }
}
