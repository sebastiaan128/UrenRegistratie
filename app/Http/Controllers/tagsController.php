<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tag;
use App\Models\employees;
use App\Models\timeEntries;

class TagsController extends Controller
{
    public function index()
{
    $tags = Tag::all();
    $employees = employees::all();
    $time_entries = timeEntries::all();

    return view('index', [
        'message' => 'Tags fetched and stored successfully.',
        'tags' => $tags,
        'employees' => $employees,
        'time_entries' => $time_entries,
    ]);
}

    //// refresh  tags table
    public function refreshTagsData(){
        $secretKey = getenv('SECRET_KEY');
        $TEAM_ID = getenv('TEAM_ID');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
        ])->get("https://api.clickup.com/api/v2/team/{$TEAM_ID}/time_entries/tags?");

        $connection = $response->json();
        if (isset($connection['data']) && is_array($connection['data'])) {
            foreach ($connection['data'] as $item) {
                Tag::updateOrCreate(
                    ['tag' => $item['name'] ,'team_id'=> $item['team_id'] ],
                    ['created_at' => now(), 'updated_at' => now()]
                );
            }
            $tags = Tag::all();
            return redirect()->route('index')->with(['message' => 'Tags fetched and stored successfully.']);
        } else {
            return redirect()->route('index')->with('error', 'Something went wrong');
        }

}
}
