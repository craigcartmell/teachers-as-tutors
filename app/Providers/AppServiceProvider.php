<?php

namespace TeachersAsTutors\Providers;

use Illuminate\Support\ServiceProvider;
use TeachersAsTutors\Page;
use TeachersAsTutors\Report;
use TeachersAsTutors\Resource;
use TeachersAsTutors\User;
use TeachersAsTutors\UserPermission;

class AppServiceProvider extends ServiceProvider
{
    protected $models = [User::class, Page::class, Resource::class, Report::class, UserPermission::class];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->models as $model) {
            $model::creating(function ($model) {
                $model->created_by = auth()->check() ? auth()->user()->getKey() : null;
            });

            $model::updating(function ($model) {
                $model->updated_by = auth()->check() ? auth()->user()->getKey() : null;
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
