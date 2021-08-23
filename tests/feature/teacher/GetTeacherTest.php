<?php

use App\Models\Teacher;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;

class GetTeacherTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeGetATeacher()
    {
        #cria no banco de dados
        $teacher = Teacher::factory()->create();
        $this->json('GET', 'api/teachers')->assertResponseStatus(Response::HTTP_OK);
        $this->seeJson(["name"=>$teacher->name]);

    }
     


}
