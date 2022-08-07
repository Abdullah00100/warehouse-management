<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentRecource;
use App\Models\Department;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\ 
     */
    public function index()
    {
        return  $this->success(DepartmentRecource::collection(Department::all()), 200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $department = Department::create($request->all());

        return $this->success(new DepartmentRecource($department), 200, 'Added Department successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($department)
    {
        try {
            $department = Department::find($department);
            
            return $this->success(new DepartmentRecource($department), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Department of this id cannot be found', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($department)
    {
        try {
            $department = Department::find($department);
            
            return $this->success(new DepartmentRecource($department), 200);
        } catch (Exception $ex) {
            return $this->error(['id not founde'], 'The Department of this id cannot be found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $department)
    {
        $department = Department::find($department);
        if ($department) {
            $department->update($request->all());
            return $this->success(new DepartmentRecource($department), 200, 'Department updated successfully');
        } else {
            return $this->error('id not founde', 'The Department of this id cannot be found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($department)
    {
        $department = Department::find($department);
        if ($department) {
            $department->delete();
            return $this->responseDelete();
        } else {
            return $this->error('id not founde', 'The Department of this id cannot be found', 404);
        }
    }
}
