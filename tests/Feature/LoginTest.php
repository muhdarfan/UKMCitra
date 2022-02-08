<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-001
     * Input: matric_number = None (0 character)
     * Expected Result: matric_number Error
     *
     * @return void
     */
    public function test_tc_001_001()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => '',
            'password' => ''
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }


    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-002
     * Input: matric_number = 3 characters
     * Expected Result: matric_number Error
     *
     * @return void
     */
    public function test_tc_001_002()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'K12',
            'password' => 'password'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-003
     * Input: matric_number = 4 characters
     * Expected Result: Success (Redirected to /home)
     *
     * @return void
     */
    public function test_tc_001_003()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A123',
            'password' => 'IniPasswordSaya'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/home');
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-004
     * Input: matric_number = 7 characters
     * Expected Result: Success (Redirected to /home)
     *
     * @return void
     */
    public function test_tc_001_004()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/home');
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-005
     * Input: matric_number = 8 characters
     * Expected Result: matric_number Error
     *
     * @return void
     */
    public function test_tc_001_005()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A1234567',
            'password' => 'IniPasswordSaya'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-006
     * Input: password = None (0 character)
     * Expected Result: password Error
     *
     * @return void
     */
    public function test_tc_001_006()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => ''
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-007
     * Input: password = 7 characters
     * Expected Result: password Error
     *
     * @return void
     */
    public function test_tc_001_007()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => '1234567'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-008
     * Input: password = 8 characters
     * Expected Result: Success (Redirected to /home)
     *
     * @return void
     */
    public function test_tc_001_008()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/home');
    }

    /**
     * TestCase: Authenticate Users
     * TestCase ID: TC-001-009
     * Input: password = 33 characters
     * Expected Result: password Error
     *
     * @return void
     */
    public function test_tc_001_009()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'morethan_32 characters_123456789ab'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /*
    public function test_tcon_001_001()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_002()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'K12',
            'password' => 'password'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_003()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A1234567',
            'password' => 'password'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_004()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_005()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => '1234567'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_tcon_001_006()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'morethan_32 characters_123456789ab'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_tcon_001_007()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_008()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'drowssap'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_009()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => '',
            'password' => ''
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_010()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A123',
            'password' => 'IniPasswordSaya'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_011()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_012()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A12',
            'password' => 'password'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_013()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A1234567',
            'password' => 'password'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('matric_no');
        $this->assertGuest();
    }

    public function test_tcon_001_014()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'A1234',
            'password' => ''
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_tcon_001_015()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'password'
        ]);

        $response->assertRedirect('/home');
    }

    public function test_tcon_001_016()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => '1234567'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function test_tcon_001_017()
    {
        $response = $this->from('/login')->post('/login', [
            'matric_no' => 'D174652',
            'password' => 'morethan_32 characters_123456789ab'
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }
    */
}
