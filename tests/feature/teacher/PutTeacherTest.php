<?php

use App\Models\Teacher;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Str;

class PutTeacherTest extends TestCase
{
    use DatabaseMigrations;
    /**
     *  @
     * @return void
     */
    public function itMustBeUpdateATeacher()
    {

        #cria no banco de dados
        $teacher = Teacher::factory()->create();
        $teacher->name = 'Testando';
        $this->json('PUT', 'api/teachers/' . $teacher->id, $teacher->toArray())->assertResponseStatus(Response::HTTP_OK);

        # checa se for salvo no banco
        $this->assertEquals($teacher->name, Teacher::where('name', $teacher->name)->first()->teacher);
    }
    /**
     *  @test
     * @return void
     */
    public function itMustBeUpdateATeacherwithValidators()
    {
        $legalAge = date("Y-m-d", strtotime(date("Y-m-d") . "-18 years"));

        #tenta criar no banco de dados sem parametros.
        $teacher = Teacher::factory()->create();
        $teacher->name ="";
        $teacher->cpf ="";
        $teacher->email ="";
        $teacher->birth ="";
        $this->json('PUT', 'api/teachers/'. $teacher->id, $teacher->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["name" => ["The name field is required."]]);
        $this->seeJsonContains(["cpf" => ["The cpf field is required."]]);
        $this->seeJsonContains(["email" => ["The email field is required."]]);
        $this->seeJsonContains(["birth" => ["The birth field is required."]]);


        $teacher->name = Str::random(300);
        $teacher->cpf = Str::random(12);
        $teacher->email = Str::random(300);
        $teacher->birth = Str::random(300);
        $this->json('PUT', 'api/teachers/'. $teacher->id, $teacher->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["name" => ["The name may not be greater than 255 characters."]]);
        $this->seeJsonContains(["cpf" => ["The cpf must be 11 digits."]]);
        $this->seeJsonContains(["email" => ["The email may not be greater than 255 characters.", "The email must be a valid email address."]]);
        $this->seeJsonContains(["birth" => ["The birth is not a valid date.", "The birth does not match the format Y-m-d.", "The birth must be a date before or equal to " . $legalAge . "."]]);


        $teacher->name = true;
        $this->json('PUT', 'api/teachers/'. $teacher->id, $teacher->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["name" => ["The name must be a string."]]);

        $teacher->cpf = true;
        $this->json('PUT', 'api/teachers/'. $teacher->id, $teacher->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["cpf" => ["The cpf must be 11 digits.", "The cpf must be a string."]]);

    }

    /**
     *  @test
     * @return void
     */
    public function itMustBeUpdateATeacherwithUniqueValue()
    {
        #tenta criar no banco de dados registro duplicado.
        $teacher = Teacher::factory()->create();
        $teacher2 = Teacher::factory()->create();

        $teacher2->cpf = $teacher->cpf;
        $teacher2->email = $teacher->email;

        $this->json('PUT', 'api/teachers/' . $teacher2->id, $teacher2->toArray())->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->seeJsonContains(["cpf" => ["The cpf has already been taken."]]);
        $this->seeJsonContains(["email" => ["The email has already been taken."]]);
    }
}
