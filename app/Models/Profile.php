<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio', 
        'kelamin', 
        'umur', 
        'foto_profile'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
