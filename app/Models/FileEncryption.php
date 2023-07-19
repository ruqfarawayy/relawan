<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class FileEncryption extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'file_encryption';

    protected $fillable = [
        'file_name', 'file_path', 'file_size', 'encryption_key', 'information', 'status'
    ];
}
