<?php

namespace App\Http\Controllers;

use App\Models\ApplicationLog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreApplicationLog;
use App\Http\Requests\UpdateApplicationLog;
use App\Services\Contracts\ApplicationLogServiceContract as ApplicationLogService;
use App\Exceptions\GetDataFailedException;
use App\Exceptions\StoreDataFailedException;
use App\Exceptions\UpdateDataFailedException;

class ApplicationLogController extends Controller
{
    private $applicationLogService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(ApplicationLogService $applicationLogService)
    {
        $this->applicationLogService = $applicationLogService;
    }

    public function index()
    {
        try {
            $data = $this->applicationLogService->get();
            $response = ['error' => false, 'data'=>$data];
            return response()->json($response);
        } catch (\Throwable $th) {
            return $th;
            throw new GetDataFailedException('Get Data Failed : Undefined Error');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplicationLog $request)
    {
        try {
            $data = $request->validated();
            $this->applicationLogService->store($data);    
            $response = ['error' => false, 'message'=>'create data success !'];
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
            throw new StoreDataFailedException('Store Data Failed : Undefined Error');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApplicationLog  $applicationLog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplicationLog $request, ApplicationLog $applicationLog)
    {
        try {
            $data = $request->validated();
            $this->applicationLogService->update($data, $applicationLog->id);
            $response = ['error' => false, 'message'=>'update data success !'];
            return response()->json($response);
        } catch (\Throwable $th) {
            dd($th);
            throw new UpdateDataFailedException('Update Data Failed : Undefined Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplicationLog  $applicationLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationLog $applicationLog)
    {
        try {
            $this->applicationLogService->delete($applicationLog->id);
            $response = ['error' => false, 'message'=>'delete data success !'];
            return response()->json($response);
        } catch (\Throwable $th) {
            throw new DeleteDataFailedException('Delete Data Failed : Undefined Error');
        }
    }
}
