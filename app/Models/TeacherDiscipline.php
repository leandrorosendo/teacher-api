<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDiscipline extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'discipline_id'];

    /**
     * find Teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }


    /**
     * find Discipline
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function disciplines()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
}
