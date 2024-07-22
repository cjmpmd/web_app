<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use DateTime;
use id;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ATSController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth']);
    }
    public function evaluate(Request $request)
    {

        \dd($request);
        return \view('prompt.ats');
    }
    public function index(Request $request)
    {
        $all_vehicles = VehicleType::all();


        $vehicle_type = $all_vehicles->groupBy('vehicle_type')->map->count()->toArray();
        $dates = $all_vehicles->pluck('date_stolen');
        arsort($vehicle_type);
        $vehicle_type = collect($vehicle_type);
        $groupedDates = [];
        $bydate = [];
        foreach ($dates as $dateString) {
            $dateObj = new DateTime($dateString); // Convert to DateTime object
            $year = $dateObj->format('Y'); // Extract year

            // Add to group or initialize new group
            $groupedDates[$year][] = $dateObj;
            \array_push($bydate, $dateObj);
        }
        $bydate = collect($bydate);
        $date = $bydate->groupBy(function ($date) {
            return $date->format('Y');
        });

        
        // For each year, group by month and count entries
        $groupedByYearAndMonth = $date->map(function ($dates, $year) {
            return $dates->groupBy(function ($date) {
                return $date->format('m');
            })->map(function ($datesInMonth, $month) {
                return $datesInMonth->count();
            })->sortKeys(); // Sort the month keys here
        });
        
        // \dd(
        //     $date,
        //     $groupedByYearAndMonth,
        //     $vehicle_type
        // );
        // "vehicle_type" => "Trailer"
        // "make_id" => 623
        // "model_year" => 2021
        // "vehicle_desc" => "BST2021D"
        // "color" => "Silver"
        // "date_stolen" => "2021-11-05"
        // "location_id" => "102"
        return view('dashboard', \compact([
            'all_vehicles',
            'vehicle_type',
            'groupedByYearAndMonth',
        ]));
    }
    public function store(Request $request)
    {
    }
    public function show(Request $request, $id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
