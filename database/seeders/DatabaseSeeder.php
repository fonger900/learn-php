<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(CourseSeeder::class);

        // Enroll user in courses and mark some lessons as completed
        $this->enrollUserInCourses($user);
    }

    private function enrollUserInCourses(User $user): void
    {
        $courses = \App\Models\Course::all();

        foreach ($courses as $course) {
            // Enroll user in course
            $user->courses()->attach($course->id, [
                'enrolled_at' => now()->subDays(rand(1, 30)),
            ]);

            // Mark some lessons as completed (30-70% of lessons)
            $lessons = $course->lessons;
            $completionRate = rand(30, 70) / 100;
            $lessonsToComplete = $lessons->take((int) ($lessons->count() * $completionRate));

            foreach ($lessonsToComplete as $lesson) {
                $user->lessons()->attach($lesson->id, [
                    'completed_at' => now()->subDays(rand(1, 20)),
                    'updated_at' => now()->subDays(rand(1, 20)),
                ]);
            }
        }
    }
}
