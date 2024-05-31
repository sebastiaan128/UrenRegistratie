<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tag;


class tagsController extends Controller
{

    public function index()
    {
        $secretKey = getenv('SECRET_KEY');
        $TEAM_ID = getenv('TEAM_ID');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
        ])->get("https://api.clickup.com/api/v2/team/{$TEAM_ID}/time_entries/tags?");

        $connection = $response->json();

        // Check if 'data' key exists and is an array
        if (isset($connection['data']) && is_array($connection['data'])) {
            foreach ($connection['data'] as $item) {
                // Controleer of de tag al bestaat, zo niet, maak een nieuwe aan
                Tag::updateOrCreate(
                    ['tag' => $item['name']],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }

            return response()->json(['message' => 'Tags fetched and stored successfully.']);
        } else {
            return response()->json(['error' => 'Data key not found or is not an array'], 400);
        }
    }
    
}
