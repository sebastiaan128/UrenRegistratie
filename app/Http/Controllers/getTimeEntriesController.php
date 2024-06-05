<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Http;
use App\Models\timeEntries;




class getTimeEntriesController extends Controller
{
    // refresh  time entreis table

    public function getTimeEntries()
    {
        $employees = Employees::all();
        $userIds = $employees->pluck('user_id')->toArray();
        $userIdsString = implode(',', $userIds);        
        $secretKey = env('SECRET_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
        ])->get("https://api.clickup.com/api/v2/team/9015496442/time_entries?assignee=$userIdsString&include_task_tags=true");

        $connection = $response->json();
        if (isset($connection['data']) && is_array($connection['data'])) {
            foreach ($connection['data'] as $entry) {
                $user = $entry['user'];
                $task = $entry['task'];
                $tags = $entry['tags'];

                $tagNames = [];
                foreach ($tags as $tag) {
                    $tagNames[] = $tag['name'];
                }
                $tagsString = implode(', ', $tagNames);

            

                TimeEntries::updateOrCreate(
                    [
                        'task_id' => $entry['id'], 
                        'user_id' => $user['id']
                    ],
                    [
                        'tag' => $tagsString,
                        'task' => $task['name'],
                        'duration' => $entry['duration'],
                        'bilable' => $entry['billable'],
                        'start_date' => $entry['start'],
                        'end_date' => $entry['end'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
            return redirect()->route('index')->with(['message' => 'Time entries fetched and stored successfully.']);
        } else {
            return redirect()->route('index')->with('error', 'Something went wrong');
        }
    }
}
