<?php
/**
 * Created by PhpStorm.
 * User: guabirabadev
 * Date: 05/03/2018
 * Time: 11:53
 */

namespace App\Services;


use App\Repositories\InsuranceTypeRepository;
use App\Validators\InsuranceTypeValidator;
use Dotenv\Exception\ValidationException;

class InsuranceTypeService
{
    /**
     * @var InsuranceTypeRepository
     */
    private $repository;
    /**
     * @var InsuranceTypeValidator
     */
    private $validator;
    /**
     * @var ClientService
     */
    private $clientService;
    /**
     * @var CoverageService
     */

    private $coverageService;
    /**
     * @var NotificationService
     */
    private $notificationService;

    public function __construct(InsuranceTypeRepository $repository,
                                InsuranceTypeValidator $validator,
                                ClientService $clientService,
                                CoverageService $coverageService,
                                NotificationService $notificationService)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->clientService = $clientService;
        $this->coverageService = $coverageService;
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        return $this->repository->all();
    }
    
    public function paginated()
    {
        return $this->repository->paginate(5);
    }

    public function save(array $data)
    {
        return $this->repository->create($data);
    }

    public function store(array $data)
    {
        try
        {
            $is_client = $this->clientService->his_client($data['cpf'])->toArray();

            if (count($is_client) == 0) {
                $store_customer = $this->clientService->store_from_upload_policy($data)->toArray();
                $data['client_id'] = $store_customer['id'];
            } else {
                foreach ($is_client as $item) {
                    $existin_client_id_is = $item['id'];
                    $data['client_id'] = $existin_client_id_is;
                }
            }

            //save the policy data
            $save = $this->repository->create($data);


            //save the coverage
            for ($i = 0; $i < count($data['coverageArray']); ++$i) {
                $this->coverageService->store($data['coverageArray'][$i], $save['id']);
            }

            $this->notificationService->notify_apolice_availability($data);
            return [
                'code' => 200,
                'action' => $save,
                'message' => 'Auto Insurer has been created'
            ];
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function update(array $data, $id)
    {
        try
        {
            $this->validator->with($data)->passesOrFail();
            return [
                'code' => 200,
                'action' => $this->repository->update($data, $id),
                'message' => 'Insurance Type has been created'
            ];
        }
        catch (ValidationException $exception)
        {
            return [
                'erro'=> 'Validation error',
                'code' => $exception->getCode(),
                'message'=> $exception->getMessage()
            ];
        }
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        return [
            'code' => '200',
            'action' => $this->repository->delete($id),
            'message' => 'Insurance Type been deleted'
        ];
    }
}