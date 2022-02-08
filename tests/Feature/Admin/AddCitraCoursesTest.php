<?php

namespace Tests\Feature\Admin;

use App\Models\Citra;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddCitraCoursesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TestCase: Add Citra Courses
     * TestCase ID: TC-012-001
     * Input: courseCredit = 0
     * Expected Result: courseCredit Error
     *
     * @return void
     */
    public function test_tc_012_001()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => 0,
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citra');
        $response->assertSessionHasErrors('courseCredit');
    }

    /**
     * TestCase: Add Citra Courses
     * TestCase ID: TC-012-002
     * Input: courseCredit = 1
     * Expected Result: Success
     *
     * @return void
     */
    public function test_tc_012_002()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '1',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citra');
        $response->assertSessionHas('success');
    }

    /**
     * TestCase: Add Citra Courses
     * TestCase ID: TC-012-003
     * Input: courseCredit = 3
     * Expected Result: Success
     *
     * @return void
     */
    public function test_tc_012_003()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '3',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citra');
        $response->assertSessionHas('success');
    }

    /**
     * TestCase: Add Citra Courses
     * TestCase ID: TC-012-004
     * Input: courseCredit = 4
     * Expected Result: courseCredit Error
     *
     * @return void
     */
    public function test_tc_012_004()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => 4,
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citra');
        $response->assertSessionHasErrors('courseCredit');
    }

    /**
     * TestCase: Add Citra Courses
     * TestCase ID: TC-012-005
     * Input: courseCredit = 10
     * Expected Result: courseCredit Error
     *
     * @return void
     */
    public function test_tc_012_005()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => 10,
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/citra');
        $response->assertSessionHasErrors('courseCredit');
    }

    /*
    public function test_tcon_012_002()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->from('/citra')->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '2',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    public function test_tcon_012_003()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '6',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }

    public function test_tcon_012_004()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '3',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    public function test_tcon_012_005()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '10',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }

    public function test_tcon_012_006()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '0',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }

    public function test_tcon_012_007()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '1',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    public function test_tcon_012_008()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '3',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    public function test_tcon_012_009()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '4',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }

    public function test_tcon_012_010()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();
        $citra = Citra::factory()->make();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => $citra->courseCode,
            'courseName' => $citra->courseName,
            'courseCategory' => $citra->courseCategory,
            'courseAvailability' => $citra->courseAvailability,
            'courseCredit' => '10',
            'descriptions' => $citra->descriptions
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }

    public function test_tcon_012_014()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => 'LMCA15145',
            'courseName' => 'PENGURUSAN KEWANGAN',
            'courseCategory' => 'C4',
            'courseAvailability' => '20',
            'courseCredit' => '2',
            'descriptions' => 'Course that help student manage financial'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    public function test_tcon_012_015()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => 'LMCA1402',
            'courseName' => 'PENGURUSAN KEWANGAN',
            'courseCategory' => 'C4',
            'courseAvailability' => '20',
            'courseCredit' => '2',
            'descriptions' => 'Course that help student manage financial'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCode');
    }

    public function test_tcon_012_016()
    {
        $user = User::where('role', 'admin')->inRandomOrder()->first();

        $response = $this->actingAs($user)->post('/citra', [
            'courseCode' => 'LMCA1514',
            'courseName' => 'PENGURUSAN KEWANGAN',
            'courseCategory' => 'C4',
            'courseAvailability' => '20',
            'courseCredit' => '0',
            'descriptions' => 'Course that help student manage financial'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('courseCredit');
    }
    */
}
