<?php

namespace App\Models;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'descripcion',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i:s');
    }
}
