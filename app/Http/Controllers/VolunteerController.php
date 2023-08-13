<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\VolunteerRequest;
use App\Models\Education;
use App\Models\Occupation;
use App\Models\Specialty;
use App\Models\Unit;
use App\Models\Volunteer;
use App\Models\VolunteerType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    //  /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        $isAdmin = Auth::user()->role == 'admin';
        $query = Volunteer::with(['specialties', 'occupations', 'education', 'volunteerType', 'unit']);


        if (!$isAdmin) {
            $userId = auth()->user()->id;
            $unitId = Unit::where('user_id', $userId)->get('id')->toArray();
            $query->where('unit_id', $unitId);
        }

        $volunteers = $query->get();
        return view('pages.admin.volunteer.index', [
            'volunteers' => $volunteers
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function create()
    {
        $isAdmin = Auth::user()->role == 'admin';
        $specialties = Specialty::all();
        $occupations = Occupation::all();
        $educations = Education::all();
        $volunteerTypes = VolunteerType::all();
        $units = Unit::all();
        if(!$isAdmin) {
            $userId = auth()->user()->id;
            $units = Unit::where('user_id', $userId)->get();
        }
        return view('pages.admin.volunteer.create',[
            'specialties'=> $specialties,
            'occupations' => $occupations,
            'educations' => $educations,
            'volunteerTypes' => $volunteerTypes,
            'units' => $units
        ]);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    public function store(VolunteerRequest $request)
    {
        if ($request->hasFile('photo')){
            $data = $request->all();
            $data['photo'] = $request->file('photo')->store(
                'assets/gallery', 'public'
            );
            Volunteer::create($data);
            return redirect()->route('volunteer.index')->with('create', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('volunteer.index')->with('create', 'Gagal Upload');
        }

    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Volunteer  $volunteer
    //  * @return \Illuminate\Http\Response
    //  */
    public function show(Volunteer $volunteer)
    {
        //
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Models\Volunteer  $volunteer
    //  * @return \Illuminate\Http\Response
    //  */
    public function edit($id)
    {
        $isAdmin = Auth::user()->role == 'admin';
        $volunteers = Volunteer::findOrFail($id);
        $specialties = Specialty::all();
        $occupations = Occupation::all();
        $educations = Education::all();
        $volunteerTypes = VolunteerType::all();
        $units = Unit::all();
        if(!$isAdmin) {
            $userId = auth()->user()->id;
            $units = Unit::where('user_id', $userId)->get();
        }
        return view('pages.admin.volunteer.edit',[
            'volunteers' => $volunteers,
            'specialties'=> $specialties,
            'occupations' => $occupations,
            'educations' => $educations,
            'volunteerTypes' => $volunteerTypes,
            'units' => $units
        ]);
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Models\Volunteer  $volunteer
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(VolunteerRequest $request, $id)
    {
        $data = $request->all();
        $volunteer = Volunteer::findOrfail($id);
        // dd($volunteer);
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('assets/gallery', 'public');
            $data['photo'] = $photo;
        }
        $volunteer->update($data);


        return redirect()->route('volunteer.index')->with('success', 'Data berhasil diubah');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Volunteer  $volunteer
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        $item = Volunteer::findOrFail($id);
        $item->delete();
        return redirect()->route('volunteer.index')->with('delete', 'Data berhasil dihapus');
    }
}
