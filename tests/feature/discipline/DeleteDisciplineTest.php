<?php

use App\Models\Discipline;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class DeleteDisciplineTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeDeleteADiscipline()
    {

        #cria no banco de dados
        $discipline = Discipline::factory()->create();
        $this->json('DELETE', 'api/disciplines/'. $discipline->id)->assertResponseStatus(Response::HTTP_OK);

        # checa se for salvo no banco
        $this->assertNull(Discipline::where('discipline', $discipline->discipline)->first());
    }
  
}
