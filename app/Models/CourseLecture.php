<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLecture extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function notes() {
    return $this->hasMany(Note::class);
}
public function course() {
    return $this->belongsTo(Course::class);
}
  public function counselingRequests() {
        return $this->hasMany(CounselingRequest::class, 'lecture_id');
    }
}
