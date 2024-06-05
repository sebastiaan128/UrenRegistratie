<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\employees;

class FetchEmployees extends Command
{
    protected $signature = 'fetch:employees';
    protected $description = 'Fetch employees from ClickUp and update the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->getEmployees();
    }

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
        }
    }
}
