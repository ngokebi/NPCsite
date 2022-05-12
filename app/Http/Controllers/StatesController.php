<?php

namespace App\Http\Controllers;

use App\Models\States;
use App\Http\Requests\StoreStatesRequest;
use App\Http\Requests\UpdateStatesRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StatesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function AllStates()
    {

        // $categories = Category::all();  latest()->get() - to order by the latest  Eloquent

        $states = States::paginate(10); // paginate


        return view('pages.states.index', compact('states'));
    }


    public function AddCitizens(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:states|max:255|min:3',

            ],
            [
                'name.required' => 'Please Input State Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',

            ]
        );

        $state = new States();

        $state->name = $request->name;
        $state->save();

        return Redirect()->back()->with('success', 'State Created Successfully');
    }


    public function EditCitizens($id)
    {

        $states = States::find($id);


        return view('pages.states.edit', compact('states'));
    }

    public function UpdateCitizens(Request $request, $id)
    {

        $validated = $request->validate(
            [
                'name' => 'required|max:255|min:3',

            ],
            [
                'name.required' => 'Please Input State Name',
                'name.max' => 'Category Name Must be Less than 255 Characters',
                'name.min' => 'Category Name Must be More than 3 Characters',

            ]
        );

        $update = States::find($id)->update([
            'name' => $request->name,

        ]);

        return Redirect()->route('states')->with('success', 'State Updated Successfully');
    }

    public function Delete($id)
    {
        $delete = States::find($id)->delete();
        return Redirect()->back()->with('success', 'State Deleted Successfully');
    }
}
