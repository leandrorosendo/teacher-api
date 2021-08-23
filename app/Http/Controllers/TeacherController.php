<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $service;

    /**
     * TeacherController constructor. 
     *
     * @param TeacherService $service
     */
    public function __construct(TeacherService $service)
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
     * Display a teachers of the resource.
     *
     * @param    $teacher
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
        $legalAge = date("Y-m-d",strtotime(date("Y-m-d")."-18 years"));
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|digits:11|unique:teachers,cpf',
            'email' => 'required|max:255|email|unique:teachers,email',
            'birth' => 'required|date|date_format:"Y-m-d"|before_or_equal:'.$legalAge,
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
        $legalAge = date("Y-m-d",strtotime(date("Y-m-d")."-18 years"));
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|digits:11|unique:teachers,cpf,' . $id,
            'email' => 'required|max:255|email|unique:teachers,email,' . $id,
            'birth' => 'required|date|date_format:"Y-m-d"|before_or_equal:'.$legalAge,
        ]);

        return $this->service->update($request->all(), $id);

    }
}
