<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'birthday',
        'avatar',
    ];

    public function courses() {
        return $this->belongsToMany(Course::class, 'customer_course', 'customer_id', 'course_id');
    }
}
