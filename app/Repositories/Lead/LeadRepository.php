<?php

namespace App\Repositories\Lead;

use App\Models\Lead;
use App\Repositories\Lead\LeadRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LeadRepository implements LeadRepositoryInterface
{
    private $model;
    /**
     * Constructor method
     * @param Lead $model - the var is called model to make more easy the model switch if needed 
     * */   
    public function __construct(Lead $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getAssigned($user_id)
    {

        return $this->model->whereOwner($user_id)->get();
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function store(array $request)
    {
        $model = $this->model->fill($request);
        $model->created_by = Auth::user()->id;
        $model->save();
        return $model;
    }
}
