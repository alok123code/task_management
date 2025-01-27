<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    //
    use HasFactory, SoftDeletes;  

    protected $fillable = [
        'name',
        'phone_no',
        'assigned_by',
    ];

    /**
     * Define the relationship to the User model (assigned_by).
     * This means each member is assigned to a user.
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');  
    }

}
