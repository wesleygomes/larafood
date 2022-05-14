<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

// Home
// Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
//     $trail->push('Home', route('admin.index'));
// });

// Planos
Breadcrumbs::for('plans', function ($trail) {
    $trail->push('Planos', route('plans.index'));
});

// Planos create
Breadcrumbs::for('plans.create', function ($trail) {
    $trail->parent('plans');
    $trail->push('Cadastrar', route('plans.create'));
});

// Planos show
Breadcrumbs::for('plans.show', function ($trail, $name) {
    $trail->parent('plans');
    $trail->push($name, route('plans.show', $name));
});

// Planos edit
Breadcrumbs::for('plans.edit', function ($trail, $name) {
    $trail->parent('plans');
    $trail->push('Editar: '.$name, route('plans.edit', $name));
});
