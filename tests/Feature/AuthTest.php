<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_basic_test()
    {
        $this->assertTrue(true);
    }
   public function loginTest()
   {
     $this->post('/login')->assertSeeText('');
   }
    
}
