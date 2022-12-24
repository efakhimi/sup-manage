<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'user_id',
        'category_id',
        'start_date',
    ];
    
    public function customer(){

        return $this->belongsTo(Customer::class);
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function user(){

        return $this->belongsTo(User::class);
    }
}
