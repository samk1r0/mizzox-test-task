<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'rent_user_id');
    }

    protected $fillable = [
        'name',
        'author',
        'year_of_release',
        'publisher',
        'rent_user_id'
    ];
}
