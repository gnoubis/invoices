<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'customer_id',
        'sub_total',
        'date',
        'due_date',
        'reference',
        'discount',
        'number',
        'terms_and_conditions'
    ];

    public function customer(){
        return $this->belongsTo(customer::class);
    }

    public function invoice_items(){
        return $this->hasMany(invoiceItem::class);
    }
    }
