<?php

namespace App\Models;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function eventVenue() {
        return $this->belongsTo(Venue::class, 'venue_id');
    }
}
