<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'students_id',
        'period',
        'week_commencing',
        'complete'
    ];

    public function students() {
        return $this->belongsTo(Students::class);
    }
}
