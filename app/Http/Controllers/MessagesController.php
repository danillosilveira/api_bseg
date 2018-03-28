<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Http\Requests\MessageCreateRequest;
use App\Repositories\MessageRepository;

/**
 * Class MessagesController.
 *
 * @package namespace App\Http\Controllers;
 */
class MessagesController extends Controller
{

    /**
     * @var MessageService
     */
    private $service;
    /**
     * @var MessageRepository
     */
    private $repository;

    public function __construct(MessageService $service, MessageRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
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
     * @param  MessageCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        return $this->repository->create($request->all());
        //return response()->json(['a porra do maldito sucesso' => $message], 200);
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

    public function my_messages($id)
    {
        return Message::with(['users', 'replies'])
            ->where('user_id', '=', $id)
            ->get(['id', 'message', 'subject', 'user_id', 'phone'])
            ->last();
    }
}