<?php

namespace Tests\Feature\Student;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GiveFeedbackTest extends TestCase
{
    use RefreshDatabase;

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-001
     * Input: feedback = None (0 character)
     * Expected Result: feedback Error
     *
     * @return void
     */
    public function test_tc_007_001()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => ''
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('feedback');
    }

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-002
     * Input: feedback = 9 characters
     * Expected Result: feedback Error
     *
     * @return void
     */
    public function test_tc_007_002()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => 'abcdefghi'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('feedback');
    }

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-003
     * Input: feedback = 10 characters
     * Output: Success
     *
     * @return void
     */
    public function test_tc_007_003()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => 'abcdefghij'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-004
     * Input: feedback = 256 characters
     * Output: Success
     *
     * @return void
     */
    public function test_tc_007_004()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat a eros. Sed efficitur a metus vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus. Sed efficitur at metus.'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHas('success');
    }

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-005
     * Input: feedback = 257 characters
     * Output: feedback Error
     *
     * @return void
     */
    public function test_tc_007_005()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat at eros. Sed efficitur a metus vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus. Sed efficitur at metus.'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('feedback');
    }

    /**
     * TestCase: Give Feedback
     * TestCase ID: TC-007-006
     * Input: feedback = 300 characters
     * Output: feedback Error
     *
     * @return void
     */
    public function test_tc_007_006()
    {
        $user = User::find('A123');

        $response = $this->actingAs($user)->from('/feedback_form')->post('/feedback_form', [
            'feedback' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget tempor dolor. Vestibulum augue arcu, sagittis id congue nec, placerat at eros. Sed efficitur a metus vehicula. Vivamus non nulla posuere, interdum nulla nec, rhoncus eros. Sed efficitur a metus vehicula. placerat. Please consider it.'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertSessionHasErrors('feedback');
    }
}
