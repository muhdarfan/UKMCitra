<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_admin_dashboard()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertSee('Weekly Recap Report');
    }

    public function test_security_admin_announcement()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/announcement');

        $response->assertSee('Announcements');
    }

    public function test_security_admin_citra_list()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/citra');

        $response->assertSee('Citra Courses');
    }

    public function test_security_admin_feedback()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/feedback');

        $response->assertSee('Feedback List');
    }

    public function test_security_admin_users()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/users');

        $response->assertSee('User Lists');
    }

    public function test_security_admin_cannot_access_lecturer_dashboard()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertDontSeeText('Summary Report');
    }

    public function test_security_admin_cannot_access_student_dashboard()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertDontSeeText('Recommended Courses');
    }
}
