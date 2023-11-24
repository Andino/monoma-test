<?php
namespace App\Services\Lead;

use App\Repositories\Lead\LeadRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LeadService implements LeadServiceInterface
{
    private $leadRepository;
    /**
     * Constructor method
     * @param LeadRepositoryInterface $leadRepository
     * */  
    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function getAll()
    {
        $user = Auth::user();
        if($user->hasRole('Manager')){
            return $this->leadRepository->getAll();
        }
        return $this->leadRepository->getAssigned($user->id);
    }

    public function show($id)
    {
        return $this->leadRepository->show($id);
    }

    public function store(array $data)
    {
        return $this->leadRepository->store($data);
    }
}
