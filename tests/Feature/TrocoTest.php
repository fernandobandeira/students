<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\PaymentsController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrocoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testeTroco()
    {
        $troco = PaymentsController::calcula_troco(10, 15);
        $this->assertEquals([0, 0, 0, 1, 0, 0, 0, 0, 0], $troco); 

        $troco = PaymentsController::calcula_troco(182.4, 200);
        $this->assertEquals([0, 0, 1, 1, 2, 1, 1, 0, 0], $troco);

        $troco = PaymentsController::calcula_troco(285.32, 290);
        $this->assertEquals([0, 0, 0, 0, 4, 1, 1, 1, 3], $troco);      
        
        $troco = PaymentsController::calcula_troco(10, 10);
        $this->assertEquals(false, $troco);    
    }
}
