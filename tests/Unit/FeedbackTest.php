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
        $response = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(1, Feedback::count(), "No new feedback added");
    }

    public function testShortName()
    {
        $reaponse = $this->post('/send_feedback', [
            'name' => 't',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), 0,  "New short name feedback added");
    }

    public function testLongName()
    {
        $reaponse = $this->post('/send_feedback', [
            'name' => 'testwaytootestwaytootestwaytootestwaytootestwaytootestwaytootestwaytoolong',
            'email' => 'unit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), 0,  "New Long name feedback added");
    }

    public function testBadEmail()
    {
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(Feedback::count(), 0,  "New bad email feedback added");
    }

    public function testShortComment()
    {
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => 'T'
        ]);

        $this->assertEquals(Feedback::count(), 0,  "New short comment feedback added");
    }

    public function testLongComment()
    {
        $comment = 'testwaytootestwaytootestwaytootestwaytootestwaytootestwaytootestwaytoolong';
        $reaponse = $this->post('/send_feedback', [
            'name' => 'validName',
            'email' => 'unit@testin',
            'comments' => $comment.$comment.$comment.$comment.$comment.$comment
        ]);

        $this->assertEquals(Feedback::count(), 0,  "New long comment feedback added");
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


        //should not add to db
        $reaponse = $this->post('/send_feedback', [
            'name' => 'testing',
            'email' => 'multiunit@testing.com',
            'comments' => 'This is a unit test'
        ]);

        $this->assertEquals(2, Feedback::count(), "Third email feedback added");
    }
}
