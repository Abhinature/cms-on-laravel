<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditPassword extends Model
{
    use HasFactory;
    protected $table = 'audit_password';

    protected $fillable = [
        'email',
        'status',
        'ip_address',
        'created_at',
        'updated_at',
        'logout_at'
    ];

    protected $status = [
        1 => 'fail',
        2 => 'success',
    ];
}
