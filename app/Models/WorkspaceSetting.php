<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workspace_name',
        'student_id_prefix',
        'gpa_scale',
        'academic_term',
        'data_integrity',
        'audit_telemetry',
    ];

    protected $casts = [
        'gpa_scale' => 'float',
        'data_integrity' => 'boolean',
        'audit_telemetry' => 'boolean',
    ];
}