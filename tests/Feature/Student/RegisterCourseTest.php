<?php

namespace Tests\Feature\Student;

use App\Models\Citra;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterCourseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-001
     * Input: reason = 0 character
     * Expected Result: reason Error
     *
     * @return void
     */
    public function test_tc_002_001()
    {
        $user = User::find('A123');
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => ''
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citras');
        $response->assertSessionHasErrors('reason');
    }

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-002
     * Input: reason = 9 characters
     * Expected Result: reason Error
     *
     * @return void
     */
    public function test_tc_002_002()
    {
        $user = User::find('A123');
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'abcdefghi'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citras');
        $response->assertSessionHasErrors('reason');
    }

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-003
     * Input: reason = 10 characters
     * Expected Result: Success
     *
     * @return void
     */
    public function test_tc_002_003()
    {
        $user = User::find('A123');
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

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-004
     * Input: reason = 128 characters
     * Expected Result: Success
     *
     * @return void
     */
    public function test_tc_002_004()
    {
        $user = User::find('A123');
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec..'
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

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-005
     * Input: reason = 129 characters
     * Expected Result: reason Error
     *
     * @return void
     */
    public function test_tc_002_005()
    {
        $user = User::find('A123');
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue neck..'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citras');
        $response->assertSessionHasErrors('reason');
    }

    /**
     * TestCase: Register Courses
     * TestCase ID: TC-002-006
     * Input: reason = 256 characters
     * Expected Result: reason Error
     *
     * @return void
     */
    public function test_tc_002_006()
    {
        $user = User::find('A123');
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->from('/citras')->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat at eros. Sed efficitur a metus vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus eros. Please consider..'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citras');
        $response->assertSessionHasErrors('reason');
    }


    /*
    public function test_tcon_002_001()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'hello'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }

    public function test_tcon_002_002()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat at eros. Sed efficitur a metus ac vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus eros. I hope that you will accept my application.'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }

    public function test_tcon_002_003()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'I would like to experience something new.'
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasAll([
            'data' => [
                'type' => 'success',
                'message' => 'Your application has been submitted.'
            ]
        ]);
    }

    public function test_tcon_002_004()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => '',
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }

    public function test_tcon_002_005()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'abcdefghi'
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }

    public function test_tcon_002_006()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'abcdefghik'
        ], ['Referer' => '/myApplication']);

        //$this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasAll([
            'data' => [
                'type' => 'success',
                'message' => 'Your application has been submitted.'
            ]
        ]);
    }

    public function test_tcon_002_007()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec..'
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasAll([
            'data' => [
                'type' => 'success',
                'message' => 'Your application has been submitted.'
            ]
        ]);
    }

    public function test_tcon_002_008()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue neck..'
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }

    public function test_tcon_002_009()
    {
//        $user = User::find('A123');
        $user = User::where('role', 'student')->inRandomOrder()->first();
        $citra = Citra::inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/myApplication', [
            'courseCode' => $citra->courseCode,
            'reason' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat at eros. Sed efficitur a metus vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus eros. Please consider..'
        ], ['Referer' => '/myApplication']);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('reason');
    }
    */
}
