<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    use HasFactory;
    protected $table = "question_point";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'survey_id',
        'question_id', 
        'offered_answer',     
    ];
}
