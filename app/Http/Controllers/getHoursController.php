<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\employees;


class getHoursController extends Controller
{
    public function getHours(Request $request)
    {
        $secretKey = getenv('SECRET_KEY');
        $TEAM_ID = getenv('TEAM_ID');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
        ])->get("https://api.clickup.com/api/v2/team/{$TEAM_ID}/time_entries/tags?");

        $connection = $response->json();
        if (isset($connection['data']) && is_array($connection['data'])) {
            $tags = $connection['data'];

            $pdf = PDF::loadView('tags_pdf', [
                'tags' => $tags
            ]);

            return $pdf->download('urenregistratie.pdf');
        } else {
            return view('index', ['error' => 'Something went wrong']);
        }
    }
    // refresh  Employees table
    public function getEmployees(){
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
            // Uncomment the following lines if you want to fetch and return tags, and send success message
            // $tags = Tag::all();
            // return view('index', ['message' => 'Employees fetched and stored successfully.', 'tags' => $tags]);
        } else {
            // Uncomment the following line if you want to send an error message
            // return view('index', ['error' => 'Something went wrong']);
        }
    }
    
}
