<?php

use App\Models\Plan;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
// Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
//     $trail->push('Home', route('admin.index'));
// });

// Planos
Breadcrumbs::for('plans', function (BreadcrumbTrail $trail) {
    $trail->push('Planos', route('plans.index'));
});

// Planos create
Breadcrumbs::for('plans.create', function (BreadcrumbTrail $trail) {
    $trail->parent('plans');
    $trail->push('Novo Plano', route('plans.create'));
});

// Planos show
Breadcrumbs::for('plans.show', function (BreadcrumbTrail $trail, $name) {
    $trail->parent('plans');
    $trail->push($name, route('plans.show', $name));
});
