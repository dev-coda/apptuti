<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'date'
    ];

    const HOLIDAY = 1;
    const SATURDAY = 2;

    protected $casts = [
        'date' => 'date',
    ];

    public function getTypeAttribute()
    {
        return $this->type_id === self::HOLIDAY ? 'Festivo' : 'Sábado';
    }

    public function getDayAttribute()
    {
        //array of days of week spanish
        $days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        return $days[$this->date->dayOfWeek];

    }

}