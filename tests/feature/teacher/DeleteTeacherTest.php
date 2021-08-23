<?php

use App\Models\Teacher;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;


class DeleteTeacherTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @test
     * @return void
     */
    public function itMustBeDeleteATeacher()
    {

        #cria no banco de dados
        $teacher = Teacher::factory()->create();
        $this->json('DELETE', 'api/teachers/'. $teacher->id)->assertResponseStatus(Response::HTTP_OK);

        # checa se for salvo no banco
        $this->assertNull(Teacher::where('name', $teacher->name)->first());
    }
  
}
