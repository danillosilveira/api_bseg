<?php

namespace App\Http\Controllers;

use App\Services\EOInsuranceService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\EOInsuranceCreateRequest;
use App\Http\Requests\EOInsuranceUpdateRequest;
use App\Repositories\EOInsuranceRepository;
use App\Validators\EOInsuranceValidator;

/**
 * Class EOInsurancesController.
 *
 * @package namespace App\Http\Controllers;
 */
class EOInsurancesController extends Controller
{

    /**
     * @var EOInsuranceService
     */
    private $service;

    public function __construct(EOInsuranceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return $this->service->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EOInsuranceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EOInsuranceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
