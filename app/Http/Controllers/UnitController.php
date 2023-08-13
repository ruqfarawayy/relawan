<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UnitController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        $unit = Unit::all();
        return view('pages.admin.unit-management.index',
    [
        'units' => $unit]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function create()
    {
            return view('pages.admin.unit-management.create');
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(Request $request)
    {
            $validated =  $request->validate([
                'name' => 'required| max:255',
                'coach' => 'required| max:255',
                'address' => 'required | max:255',
                'email' => 'required | max:255 | email | unique:users',
                'birth_date' => 'required | date'
            ]);
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'password' => bcrypt('password'),
                    'role' => 'user',
                ]);
                $validated['user_id'] = $user->id;
                Unit::create($validated);
                DB::commit();
                return redirect()->route('unit.index')
                ->with('success', 'Unit created successfully');
            } catch (\Exception $e){
                DB::rollBack();
                return redirect()->back()->withInput()->with('error', $e->getMessage());
            }
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    public function show(Unit $unit)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit(Unit $unit)
    {
            return view('pages.admin.unit-management.edit', compact('unit'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, Unit $unit)
    {
           $validated =  $request->validate([
                'name' => 'required| max:255',
                'coach' => 'required| max:255',
                'address' => 'required | max:255',
                'birth_date' => 'required | date'
            ]);
            $unit->update($validated);
            return redirect()->route('unit.index')
                ->with('success', 'Unit updated successfully');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        
            dd($id);
            // $unit->delete();
            // Unit::findOrfail($id)->delete();
            // $unit->user->delete();
            return redirect()->route('unit.index')
                ->with('success', 'Unit deleted successfully');
    }
}
