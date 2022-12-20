<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        'cid',
        'contract_no',
        'start_date',
        'end_date',
        'status',
    ];

    public function customer(){

        return $this->belongsTo(Customer::class, 'cid', 'id');
    }

}
