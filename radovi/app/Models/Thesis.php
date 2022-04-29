<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title_cro',
    //     'title_eng',
    //     'description',
    //     'study_type',
    //     'created_by_user_id'
    // ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applied_users()
    {
        return $this->belongsToMany(User::class, "thesis_users");
    }

}
