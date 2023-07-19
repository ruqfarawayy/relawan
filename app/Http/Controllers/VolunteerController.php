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

class VolunteerController extends Controller
{
    //  /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        $volunteer = Volunteer::with(['specialties', 'occupations', 'education', 'volunteerType', 'unit'])->get();

        return view('pages.admin.volunteer.index', [
            'volunteers' => $volunteer
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function create()
    {
        $specialties = Specialty::all();
        $occupations = Occupation::all();
        $educations = Education::all();
        $volunteerTypes = VolunteerType::all();
        $units = Unit::all();
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
        $volunteers = Volunteer::findOrFail($id);
        $specialties = Specialty::all();
        $occupations = Occupation::all();
        $educations = Education::all();
        $volunteerTypes = VolunteerType::all();
        $units = Unit::all();
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


        return redirect()->route('volunteer.index')->with('update', 'Data berhasil diubah');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Models\Volunteer  $volunteer
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        Volunteer::findOrFail($id)->delete();
        return redirect()->route('volunteer.index')->with('delete', 'Data berhasil dihapus');
    }
}
