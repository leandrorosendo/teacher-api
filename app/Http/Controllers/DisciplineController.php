<?php

namespace App\Http\Controllers;

use App\Services\DisciplineService;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    private $service;

    /**
     * DisciplineController constructor. 
     *
     * @param DisciplineService $service
     */
    public function __construct(DisciplineService $service)
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
     * Display a discipline of the resource.
     *
     * @param    $discipline
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
            'discipline' => 'required|string|max:255|unique:disciplines,discipline'
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
            'discipline' => 'required|string|max:255|unique:disciplines,discipline,' . $id,
        ]);

        return $this->service->update($request->all(), $id);
    }
}
