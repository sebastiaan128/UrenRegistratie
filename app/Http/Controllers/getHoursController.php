<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

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
}
