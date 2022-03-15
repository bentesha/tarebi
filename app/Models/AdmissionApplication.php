<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use KirschbaumDevelopment\NovaComments\Commentable;
use KirschbaumDevelopment\NovaComments\Models\Comment;

class AdmissionApplication extends Model {

    use HasFactory, Commentable;

    protected $casts = [
        'date_of_birth' => 'date',
        'submitted_on' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user() != null ? auth()->user()->id : 0;
        });
    }

    public function admission() {
        return $this->belongsTo(Admission::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'commentable_id');
    }

    public function assessment() {
        return $this->hasOne(Assessment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
