<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lecture_id', 'note'];
    public function user() {
    return $this->belongsTo(User::class);
}

public function lecture() {
    return $this->belongsTo(CourseLecture::class, 'lecture_id');
}

}
