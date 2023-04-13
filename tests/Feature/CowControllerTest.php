<?php

namespace Tests\Feature;

use App\Models\Cow;
use App\Models\CowSituation;
use Database\Factories\CowFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
// use Illuminate\Database\Eloquent\Factorie

class CowControllerTest extends TestCase
{
    protected array $cowData = [
        'nome' => 'Ola, Teste',
        'nascimento' => '2023-04-01',
        'dataprimeiracria' => '2023-04-02',
        'ultimacria' => '2023-05-03',
        'litrosleite' => 37,
        'cow_situation_id' => 2
    ];


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

    public function test_shouldReturnIndexCowViewWithCowsData()
    {

        $cow = Cow::factory()->create(); //cria um registro baseado na Factory
        $response = $this->get('/cows');  //chama a rota
        //statuscode deve ser 200   //view deve ser index      //deve conter um registro model no retorno dessa view  
        $response->assertStatus(200)->assertViewIs('cows.index')->assertViewHas('cows', function ($cows) use ($cow) {
            return $cows->contains($cow);
        });
        $cow->delete(); //delete o registro criado
    }

    public function test_shouldReturnCreateCowViewWithCowSituationsData()
    {
        $situation = CowSituation::factory()->create(); //cria um registro baseado na Factory
        $response = $this->get('/cows/create');  //chama a rota
        //statuscode deve ser 200   //view deve ser index      //deve conter um registro model no retorno dessa view  
        $response->assertStatus(200)->assertViewIs('cows.create')->assertViewHas('situacoes', function ($situations) use ($situation) {
            return $situations->contains($situation);
        });
        $situation->delete(); //deleta o registro criado
    }


    public function test_shouldReturnEditCowViewWithCowDataAndCowSituationsData()
    {
        $situation = CowSituation::factory()->create();
        $cow = Cow::factory()->create();

        $response = $this->get('/cows/' . $cow->id . '/edit');

        $response->assertStatus(200)->assertViewIs('cows.edit')->assertViewHas(['cow', 'situacoes'], function ($cows, $situations) use ($cow, $situation) {
            return ($situations->contains($situation) && $cows->contains($cow));
        });
        $situation->delete();
        $cow->delete();
    }

    public function test_shouldStoreCowData()
    {
        $this->post("/cows/", $this->cowData);

        $this->assertDatabaseHas('cows', $this->cowData);

        $cows = DB::table('cows')->where($this->cowData)->get();
        foreach ($cows as $cow) {
            DB::table('cows')->delete($cow->id);
        }
    }

    public function test_shouldUpdateCowData()
    {

        $cow = Cow::factory()->create();

        $this->put("/cows/" . $cow->id, $this->cowData);

        $this->assertDatabaseHas('cows', $this->cowData);

        $cow->delete();
    }

    public function test_shouldDestroyCowData()
    {
        $cow = Cow::factory()->create();

        $this->delete("/cows/" . $cow->id);

        $this->assertDatabaseMissing('cows', $cow->toArray());
    }
}
