<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "books";
    protected $guarded = [
        'id'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['keyword'] ?? false, function($query, $keyword) {
            return $query
                ->where('title', 'like', '%'.$keyword.'%')
                ->orWhere('authors', 'like', '%'.$keyword.'%')
                ->orWhere('publisher', 'like', '%'.$keyword.'%')
                ->orWhere('description', 'like', '%'.$keyword.'%');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public function record()
    {
        return $this->hasMany(Record::class);
    }
}
