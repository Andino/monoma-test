<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\Lead\LeadServiceInterface;
use Illuminate\Http\Request;
use App\Http\Resources\GeneralResponseResource;
use App\Http\Resources\LeadResource;

class LeadController extends Controller
{
    private $leadService;

    public function __construct(LeadServiceInterface $leadService)
    {
        $this->leadService = $leadService;
        $this->middleware(['role:Manager'])->only('store');;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $lead = $this->leadService->getAll();
            $data = LeadResource::collection($lead);
            $response = [
                "success" => true,
                "errors" => [],
                "data"=> $data
            ];
            return new GeneralResponseResource($response);
        } catch(ValidationException $error){
            $response = [
                "success" => false,
                "errors" => [$error->getMessage()],
                "data"=> []
            ];
            $response_resource = new GeneralResponseResource($response);
            return $response_resource
            ->response()
            ->setStatusCode($error->status);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return GeneralResponseResource
     */
    public function store(Request $request)
    {
        try{
            $lead = $this->leadService->store($request->all());
            $data = new LeadResource($lead);
            $response = [
                "success" => true,
                "errors" => [],
                "data"=> $data
            ];
            return new GeneralResponseResource($response);
        } catch(ValidationException $error){
            $response = [
                "success" => false,
                "errors" => [$error->getMessage()],
                "data"=> []
            ];
            $response_resource = new GeneralResponseResource($response);
            return $response_resource
            ->response()
            ->setStatusCode($error->status);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param string $lead
     * @return GeneralResponseResource
     */
    public function show(string $lead)
    {
        try{
            $leadData = $this->leadService->show($lead);
            $data = new LeadResource($leadData);
            $response = [
                "success" => true,
                "errors" => [],
                "data"=> $data
            ];
            return new GeneralResponseResource($response);
        } catch(ValidationException $error){
            $response = [
                "success" => false,
                "errors" => [$error->getMessage()],
                "data"=> []
            ];
            $response_resource = new GeneralResponseResource($response);
            return $response_resource
            ->response()
            ->setStatusCode($error->status);
        }
    }
}
