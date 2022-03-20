<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LecturerPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_lecturer_dashboard()
    {
        $user = User::where('role', 'lecturer')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertSee('Summary Report');
    }

    public function test_security_lecturer_application()
    {
        $user = User::where('role', 'lecturer')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/application');

        $response->assertSee('Application List');
    }

    public function test_security_lecturer_courses()
    {
        $user = User::where('role', 'lecturer')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/mycitra');

        $response->assertSee('My Courses');
    }

    public function test_security_lecturer_cannot_access_admin_dashboard()
    {
        $user = User::where('role', 'lecturer')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertDontSeeText('Weekly Recap Report');
    }

    public function test_security_lecturer_cannot_access_student_dashboard()
    {
        $user = User::where('role', 'lecturer')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertDontSeeText('Recommended Courses');
    }
}
