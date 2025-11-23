<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicationFinal extends Model
{
    use HasFactory;

    protected $table = 'publication_finals';
    protected $primaryKey = 'pub_final_id';
    
    protected $fillable = [
        'pub_plan_id',
        'actual_date',
        'final_desc',
        'final_file'
    ];

    protected $casts = [
        'actual_date' => 'date'
    ];

    public function publicationPlan()
    {
        return $this->belongsTo(PublicationPlan::class, 'pub_plan_id', 'pub_plan_id');
    }
}