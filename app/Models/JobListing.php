<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import the trait
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use HasFactory, SoftDeletes; // 2. Use the trait here

    protected $fillable = [
        'title',
        'company',
        'location',
        'type',
        'salary_range',
        'description',
        'apply_url',
        'is_active',
        'expires_at',
    ];
}
