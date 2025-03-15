<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_Details extends Model
{
    use HasFactory;
    protected $table = 'sales__details';
    protected $primaryKey = 'sales_details_id';
}
