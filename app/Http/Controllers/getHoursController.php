<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\employees;
use App\Models\timeEntries;


class getHoursController extends Controller
{
    public function getHours(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $tag = $request->tag;
        if ($start_date && $end_date) {
              $query = timeEntries::where('start_date', '>=', $start_date)
                ->where('end_date', '<=', $end_date);
                if ($tag) {
                    $query->where('tag', 'LIKE', '%' . $tag . '%');
                }
        
                $timeEntries = $query->get();
                if (!$timeEntries->isEmpty()) {
                    //return response()->json($timeEntries);
                //     $pdf = PDF::loadView('pdf.timeEntries', [
                //    'timeEntries' => $timeEntries
                //     ]);
                return view('pdf.timeEntries',[
                    'timeEntries' => $timeEntries
                ]);
    
                //    return $pdf->download('urenregistratie.pdf');

                }else {
                    return redirect()->back()->with('error',' Er is niet op deze datums voor deze klant gewerkt.');
                }
        

        } else {

            return redirect()->back()->with('error',' Selecteer eerst een datum en een tag.');
        }


    
        
        // $secretKey = getenv('SECRET_KEY');
        // $TEAM_ID = getenv('TEAM_ID');
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Authorization' => $secretKey
        // ])->get("https://api.clickup.com/api/v2/team/{$TEAM_ID}/time_entries/tags?");

        // $connection = $response->json();
        // if (isset($connection['data']) && is_array($connection['data'])) {
        //     $tags = $connection['data'];

        //     $pdf = PDF::loadView('tags_pdf', [
        //         'tags' => $tags
        //     ]);

        //     return $pdf->download('urenregistratie.pdf');
        // } else {
        //     return view('index', ['error' => 'Something went wrong']);
        // }
    }

    // Refresh Employees table
    public function getEmployees()
    {
        $secretKey = getenv('SECRET_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
        ])->get("https://api.clickup.com/api/v2/team");

        $connection = $response->json();
        if (isset($connection['teams']) && is_array($connection['teams'])) {
            foreach ($connection['teams'] as $team) {
                if (isset($team['members']) && is_array($team['members'])) {
                    foreach ($team['members'] as $member) {
                        $user = $member['user'];
                        employees::updateOrCreate(
                            ['user_id' => $user['id']],
                            [
                                'username' => $user['username'],
                                'email' => $user['email'],
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        );
                    }
                }
            }
            return redirect()->route('index')->with(['message' => 'Tags fetched and stored successfully.']);
        } else {
            return redirect()->route('index')->with('error', 'Something went wrong');
        }
    }
}

