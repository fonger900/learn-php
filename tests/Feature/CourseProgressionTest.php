<?php

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;

test('user can browse courses', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();

    $response = $this->actingAs($user)->get('/courses');

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) => $page
            ->component('Courses/Index')
            ->has('courses', 1)
    );
});

test('user can view course overview', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    $module = Module::factory()->for($course)->create();
    $lesson = Lesson::factory()->for($module)->create();

    $response = $this->actingAs($user)->get(route('courses.show', $course));

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) => $page
            ->component('Courses/Show')
            ->where('course.id', $course->id)
            ->has('course.modules', 1)
    );
});

test('user can view lesson', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    $module = Module::factory()->for($course)->create();
    $lesson = Lesson::factory()->for($module)->create();

    $response = $this->actingAs($user)->get(route('lessons.show', [$course, $lesson]));

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) => $page
            ->component('Lessons/Show')
            ->where('lesson.id', $lesson->id)
    );
});

test('user can complete lesson', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    $module = Module::factory()->for($course)->create();
    $lesson = Lesson::factory()->for($module)->create();

    $response = $this->withoutMiddleware()->actingAs($user)->post(route('lessons.complete', $lesson));

    $response->assertRedirect();
    $this->assertDatabaseHas('lesson_user', [
        'user_id' => $user->id,
        'lesson_id' => $lesson->id,
    ]);
});
