<?php

Breadcrumbs::register('/', function ($breadcrumbs) {
    $breadcrumbs->push('Home', url('/'));
});

Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->push('Blog', url('blog'));
});

Breadcrumbs::register('contact', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('Contact', url('contact'));
});

Breadcrumbs::register('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('My Profile', url('profile'));
});

Breadcrumbs::register('reports', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('My Reports', url('reports'));
});

Breadcrumbs::register('edit-report', function ($breadcrumbs, $report) {
    $breadcrumbs->parent('reports');

    $breadcrumbs->push($report->name);
});

Breadcrumbs::register('view-report', function ($breadcrumbs, $report) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push($report->name);
});

Breadcrumbs::register('resources', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('Resources', url('resources'));
});

Breadcrumbs::register('edit-resource', function ($breadcrumbs, $resource) {
    $breadcrumbs->parent('resources');

    $breadcrumbs->push($resource->original_filename);
});

Breadcrumbs::register('pages', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('Manage Pages', url('admin/pages'));
});

Breadcrumbs::register('edit-page', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('pages');

    $breadcrumbs->push($page->name);
});

Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('Manage Users', url('admin/users'));
});

Breadcrumbs::register('edit-user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');

    $breadcrumbs->push($user->name);
});

Breadcrumbs::register('page', function ($breadcrumbs, $page) {
    if ($page->uri !== '/') {
        $breadcrumbs->parent('/');
    }

    if ($page->parent_id) {
        $breadcrumbs->parent($page->parent->uri);
    }

    $breadcrumbs->push($page->name, url($page->uri, $page->uri));
});

Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('/');

    $breadcrumbs->push('Login', url('auth/login'));
});

Breadcrumbs::register('forgotten-password', function ($breadcrumbs) {
    $breadcrumbs->parent('login');

    $breadcrumbs->push('Forgotten Password');
});

Breadcrumbs::register('reset-password', function ($breadcrumbs) {
    $breadcrumbs->parent('login');

    $breadcrumbs->push('Reset Password');
});