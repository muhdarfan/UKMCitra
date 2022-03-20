<?php

namespace Tests\Unit;

use App\Models\Citra;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_student_dashboard()
    {
        $user = User::where('role', 'student')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/home');

        $response->assertSee('Recommended Courses');
    }

    public function test_security_student_application()
    {
        $user = User::where('role', 'student')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/myApplication');

        $response->assertSee('My Application');
    }

    public function test_security_student_courses()
    {
        $user = User::where('role', 'student')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/citras');

        $response->assertSee('Citra Courses');
    }

    public function test_security_student_feedback()
    {
        $user = User::where('role', 'student')->inRandomOrder()->first();

        $response = $this->actingAs($user)->get('/feedback_form');

        $response->assertSee('Feedback');
    }

    public function test_security_student_submit_application()
    {
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'abcdefghik'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citras');
        $response->assertSessionHasAll([
            'data' => [
                'type' => 'success',
                'message' => 'Your application has been submitted.'
            ]
        ]);
    }

    public function test_security_others_cannot_submit_application()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'abcdefghik'
        ]);

        $this->assertEquals(401, $response->getStatusCode());
    }
}
