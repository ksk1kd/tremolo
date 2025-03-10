<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'no';
    protected $fillable = ['repository', 'id', 'name', 'is_merged'];
}
