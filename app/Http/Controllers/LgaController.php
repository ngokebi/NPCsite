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
use NunoMaduro\Collision\Adapters\Phpunit\State;

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
                'state_id' => 'required'

            ],
            [
                'name.required' => 'Please Input Local Governmnet Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'state_id.required' => 'Please Input State Name',


            ]
        );

        $lgas = new Lga();

        $lgas->name = $request->name;
        $lgas->state_id = $request->state_id;
        $lgas->save();

        return Redirect()->back()->with('success', 'Local Government Created Successfully');
    }


    public function EditLgas($id)
    {
        $states = States::orderBy('name', 'ASC')->get();
        $edit_lgas = Lga::find($id);


        return view('pages.lgas.edit', compact('edit_lgas', 'states'));
    }

    public function UpdateLgas(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'name' => 'required|max:255|min:3',
                'state_id' => 'required'

            ],
            [
                'name.required' => 'Please Input Local Governmnet Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',
                'state_id.required' => 'Please Input State Name',


            ]
        );

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
