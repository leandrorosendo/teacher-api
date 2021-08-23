<?php

namespace App\Http\Controllers;

use App\Services\TeacherDisciplineService;
use Illuminate\Http\Request;

class TeacherDisciplineController extends Controller
{
    private $service;

    /**
     * TeacherDisciplineController constructor. 
     *
     * @param TeacherDisciplineService $service
     */
    public function __construct(TeacherDisciplineService $service)
    {
        $this->service = $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return  $this->service->destroy($id);
    }

    /**
     * Display a teacherDiscipline of the resource.
     *
     * @param    $TeacherDiscipline
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return  $this->service->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'teacher_id' => 'required|integer|unique:teacher_disciplines|exists:teachers,id',
            'discipline_id' => 'required|integer|exists:disciplines,id'
        ]);

        return  $this->service->save($request->all());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\TestRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'teacher_id' => 'required|integer|exists:teachers,id|unique:teacher_disciplines,id,' . $id,
            'discipline_id' => 'required|integer|exists:disciplines,id'
        ]);

        return $this->service->update($request->all(), $id);
    }
}
