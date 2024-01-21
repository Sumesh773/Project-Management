<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationUser extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   // In your DesignationUser model
public function designation()
{
    return $this->belongsTo(Designation::class, 'designation_id');
}

}
