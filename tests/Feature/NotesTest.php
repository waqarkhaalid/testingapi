<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotesTest extends TestCase
{
    use DatabaseMigrations;
    
        /** @test */

     public function a_user_can_read_all_the_notes()
    {
        //Given we have note in the database
        $note = factory('App\Note')->create();

        //When user visit the notes page
        $response = $this->get('/api/get-notes');
        
        //He should be able to read the task
        $response->assertSee($note->name);
    }


}