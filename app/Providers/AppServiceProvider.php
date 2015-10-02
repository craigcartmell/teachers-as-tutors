<?php

namespace TeachersAsTutors\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use TeachersAsTutors\Lesson;
use TeachersAsTutors\Page;
use TeachersAsTutors\Report;
use TeachersAsTutors\Resource;
use TeachersAsTutors\User;
use TeachersAsTutors\UserPermission;

class AppServiceProvider extends ServiceProvider
{
    protected $models = [User::class, Page::class, Resource::class, Report::class, UserPermission::class, Lesson::class];

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

        Validator::extend('lesson_length', function ($attribute, $value, $parameters) {
            $accepted_remainders = [0, 0.25, 0.5, 0.75];

            $value = floatval($value);

            if (empty($value)) {
                return false;
            }

            $remainder = $value - floor($value);

            return in_array($remainder, $accepted_remainders);
        });
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
