<?php

use App\Models\Discipline;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Str;

class SaveDisciplineTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeSaveADiscipline()
    {
      
        #cria no banco de dados
        $discipline = Discipline::factory()->make();
        $this->json('POST', 'api/disciplines', $discipline->toArray())->assertResponseStatus(Response::HTTP_OK);

        # checa se for salvo no banco
        $this->assertEquals($discipline->discipline,Discipline::where('discipline', $discipline->discipline)->first()->discipline);

    }
        /**
     *  @test
     * @return void
     */
    public function itMustBeSaveADisciplinewithValidators()
    {
      
        #tenta criar no banco de dados sem parametros.
        $discipline = Discipline::factory()->make()->toArray();
        $this->json('POST', 'api/disciplines', [])->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline"=>["The discipline field is required."]]);

        $discipline['discipline'] = Str::random(300);
        $this->json('POST', 'api/disciplines', $discipline)->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline"=>["The discipline may not be greater than 255 characters."]]);

        
        $discipline['discipline'] = true;
        $this->json('POST', 'api/disciplines', $discipline)->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline"=>["The discipline must be a string."]]);

        # checa se for salvo no banco
        $this->assertNull(Discipline::where('discipline', $discipline)->first());

    }

         /**
     *  @test
     * @return void
     */
    public function itMustBeSaveADisciplinewithUniqueValue()
    {
      
        #tenta criar no banco de dados sem parametros.
        $discipline = Discipline::factory()->create()->toArray();

        $this->json('POST', 'api/disciplines', $discipline)->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["discipline"=>["The discipline has already been taken."]]);

    }



}
