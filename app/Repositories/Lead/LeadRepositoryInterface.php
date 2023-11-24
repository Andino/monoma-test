<?php

namespace App\Repositories\Lead;

interface LeadRepositoryInterface
{
    public function getAll();

    public function getAssigned($user_id);

    public function show($id);

    public function store(array $data);

}