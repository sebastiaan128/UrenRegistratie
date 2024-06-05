<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\Http;



class getTimeEntriesController extends Controller
{
    // refresh  time entreis table

    public function getTimeEntreis(){
        $employees = employees::all();
        $userIds = $employees->pluck('user_id')->toArray();
        $userIdsString = implode(',', $userIds);        $secretKey = getenv('SECRET_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => $secretKey
            ])->get("https://api.clickup.com/api/v2/team/9015496442/time_entries?assignee=$userIdsString&include_task_tags=true");
    
        $connection = $response->json();

    }
}
