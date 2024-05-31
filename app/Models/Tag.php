<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    protected $fillable = ['tag'];
    public $timestamps = true;
    use HasFactory;
}
