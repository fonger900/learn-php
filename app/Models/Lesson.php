<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    protected $fillable = ['module_id', 'title', 'slug', 'content', 'video_url', 'order'];

    use HasFactory;

    public function module(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function getContentAttribute(?string $value): string
    {
        $path = resource_path("markdown/courses/{$this->module->course->slug}/{$this->slug}.md");

        return file_exists($path) ? file_get_contents($path) : ($value ?? '');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lesson_user')
            ->withPivot('completed_at')
            ->withTimestamps();
    }
}
