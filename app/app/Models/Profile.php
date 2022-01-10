<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\TestFixture\InterfaceWithSemiReservedMethodName;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'image',
        'background',
        'name',
        'biography'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
