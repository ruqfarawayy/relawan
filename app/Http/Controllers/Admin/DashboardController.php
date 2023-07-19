<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $totalVolunteer = Volunteer::count();
        $totalUnit = Unit::count();
        $totalKsr = Volunteer::where('volunteer_type_id', 1)->get()->count();
        $totalTsr = Volunteer::where('volunteer_type_id', 2)->get()->count();
        return view('pages.admin.dashboard', compact('totalVolunteer', 'totalUnit', 'totalKsr', 'totalTsr'));
    }
}
