<?php

namespace App\Providers;

use App\Repositories\Lead\LeadRepository;
use App\Repositories\Lead\LeadRepositoryInterface;
use App\Services\Lead\LeadService;
use App\Services\Lead\LeadServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Interfaces Registration
        $this->app->bind(LeadServiceInterface::class, LeadService::class);
        
        // Repository Registration
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
