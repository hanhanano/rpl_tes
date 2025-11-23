<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';
    protected $primaryKey = 'publication_id';
    public $incrementing = true;
    protected $keyType = 'string';
    
    protected $fillable = [
        'publication_report',
        'publication_name',
        'publication_pic',
        'fk_user_id',
        'slug_publication',
        'is_monthly',
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug_publication)) {
                $model->slug_publication = (string) Str::uuid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug_publication';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'id');
    }

    public function stepsPlans()
    {
        return $this->hasMany(StepsPlan::class, 'publication_id', 'publication_id');
    }

    // Relasi ke publication plans (SISTEM BARU)
    public function publicationPlans()
    {
        return $this->hasMany(PublicationPlan::class, 'publication_id', 'publication_id')
                    ->orderBy('plan_date');
    }
}