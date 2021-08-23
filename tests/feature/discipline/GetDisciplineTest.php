<?php

use App\Models\Discipline;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetDisciplineTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeGetADiscipline()
    {
        #cria no banco de dados
        $discipline = Discipline::factory()->create();
        $this->json('GET', 'api/disciplines')->assertResponseStatus(Response::HTTP_OK);
        $this->seeJson(["discipline"=>$discipline->discipline]);

    }
     


}
