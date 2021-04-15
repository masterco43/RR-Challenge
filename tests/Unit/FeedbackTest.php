<?php

namespace Tests\Unit;

use App\Models\Feedback;
use Tests\TestCase; 
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    /**
     * tests the feedback app.
     *
     * @return void
     */

    use RefreshDatabase;

    public function testADD()
    {
        $original = Feedback::count();
        $response = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        //echo($response);

        $this->assertGreaterThan($original, Feedback::count(), "No new feedback added");
    }

    public function testShortName()
    {
        $original = Feedback::count();
        $reaponse = $this->post('/send_feedback', [
            'name' => 't',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), $original,  "New short name feedback added");
    }

    public function testLongName()
    {
        $original = Feedback::count();
        $reaponse = $this->post('/send_feedback', [
            'name' => 'testwaytootestwaytootestwaytootestwaytootestwaytootestwaytootestwaytoolong',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), $original,  "New Long name feedback added");
    }

    public function testBadEmail()
    {
        $original = Feedback::count();
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), $original,  "New bad email feedback added");
    }

    public function testShortComment()
    {
        $original = Feedback::count();
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => 'T'
        ]);

        $this->assertEquals(Feedback::count(), $original,  "New short comment feedback added");
    }

    public function testLongComment()
    {
        $comment = 'testwaytootestwaytootestwaytootestwaytootestwaytootestwaytootestwaytoolong';
        $original = Feedback::count();
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => $comment.$comment.$comment.$comment.$comment.$comment
        ]);

        $this->assertEquals(Feedback::count(), $original,  "New long comment feedback added");
    }

    public function testMultipleEmail(){
        $reaponse = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'multiunit@testing.com',
            'comments' => 'This is a unit test'
        ]);
        $reaponse = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'multiunit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        //gets count after the first valid 2 are sent in
        $original = Feedback::count();

        $reaponse = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'multiunit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals($original, Feedback::count(), "Third email feedback added");
    }
}
