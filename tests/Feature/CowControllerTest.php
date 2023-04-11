<?php

namespace Tests\Feature;

use App\Models\Cow;
use Database\Factories\CowFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// use Illuminate\Database\Eloquent\Factorie

class CowControllerTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_shouldRedirectToCowsIndexPage()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    /**
     * Deve retornar uma view com dados de vacas
     */

    public function test_shouldReturnIndexCowViewAndData()
    {

        $cow = Cow::factory()->create(); //cria um registro baseado na Factory
        $response = $this->get('/cows');  //chama a rota
                  //statuscode deve ser 200   //view deve ser index      //deve conter um registro model no retorno dessa view  
        $response->assertStatus(200)->assertViewIs('cows.index')->assertViewHas('cows', function ($cows) use ($cow) {
            return $cows->contains($cow);
        });
        $cow->delete();
    }
}
