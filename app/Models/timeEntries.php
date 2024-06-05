<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeEntries extends Model
{
    protected $table = 'time_entries';
    protected $primaryKey = 'id';
    protected $fillable = ['tag', 'task_id', 'user_id', 'task', 'duration', 'bilable', 'start_date', 'end_date'];
    public $timestamps = true;
    use HasFactory;
}
