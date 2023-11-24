<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'source',
        'owner',
        'created_by'
    ];

    /**
     * Get the owner info for the lead.
     */
    public function ownerUser()
    {
        return $this->belongsTo(User::class,'owner_id');
    }

    /**
     * Get creator user info for the lead.
     */
    public function creatorUser()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
