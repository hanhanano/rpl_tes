<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicationPlan extends Model
{
    use HasFactory;

    protected $table = 'publication_plans';
    protected $primaryKey = 'pub_plan_id';
    
    protected $fillable = [
        'publication_id',
        'plan_name',
        'plan_date',
        'plan_desc',
        'plan_file'
    ];

    protected $casts = [
        'plan_date' => 'date'
    ];

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id', 'publication_id');
    }

    public function publicationFinal()
    {
        return $this->hasOne(PublicationFinal::class, 'pub_plan_id', 'pub_plan_id');
    }
}