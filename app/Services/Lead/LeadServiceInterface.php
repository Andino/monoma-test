<?php

namespace App\Services\Lead;

interface LeadServiceInterface
{
    public function getAll();

    public function show($id);
    
    public function store(array $data);
}