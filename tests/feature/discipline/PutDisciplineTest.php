<?php

use App\Models\Discipline;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Str;

class PutDisciplineTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeUpdateADiscipline()
    {

        #cria no banco de dados
        $discipline = Discipline::factory()->create();
        $discipline->discipline = 'Testando';
        $this->json('PUT', 'api/disciplines/'. $discipline->id, $discipline->toArray())->assertResponseStatus(Response::HTTP_OK);

        # checa se for salvo no banco
        $this->assertEquals($discipline->discipline, Discipline::where('discipline', $discipline->discipline)->first()->discipline);
    }
    /**
     *  @test
     * @return void
     */
    public function itMustBeUpdateADisciplinewithValidators()
    {

        #tenta criar no banco de dados sem parametros.
        $discipline = Discipline::factory()->create();
        $discipline->discipline = '';
        $this->json('PUT', 'api/disciplines/'. $discipline->id, $discipline->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline" => ["The discipline field is required."]]);

        $discipline->discipline = Str::random(300);
        $this->json('PUT', 'api/disciplines/'. $discipline->id, $discipline->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline" => ["The discipline may not be greater than 255 characters."]]);


        $discipline->discipline = true;
        $this->json('PUT', 'api/disciplines/'. $discipline->id, $discipline->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline" => ["The discipline must be a string."]]);

        # checa se for salvo no banco
        $this->assertNull(Discipline::where('discipline', $discipline)->first());
    }

    /**
     *  @test
     * @return void
     */
    public function itMustBeUpdateADisciplinewithUniqueValue()
    {

        #tenta criar no banco de dados registro duplicado.
        $discipline = Discipline::factory()->create();
        $discipline2 = Discipline::factory()->create();

        $discipline2->discipline = $discipline->discipline;

        $this->json('PUT', 'api/disciplines/'. $discipline2->id, $discipline2->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline" => ["The discipline has already been taken."]]);
    }
}
