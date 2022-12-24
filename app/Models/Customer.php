<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cname',
        'ctell',
        'caddress',
        'techname',
        'techtell',
        'status',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
    public function requests()
    {
        return $this->hasMany(SupportRequest::class);
    }
}
