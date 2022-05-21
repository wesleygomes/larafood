<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

//Dashboard
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Dashboard', route('admin.index'));
});

// Dashboard > Planos
Breadcrumbs::for('plans', function ($trail) {
    $trail->parent('admin');
    $trail->push('Planos', route('plans.index'));
});

// Dashboard > Planos > Create
Breadcrumbs::for('plans.create', function ($trail) {
    $trail->parent('plans');
    $trail->push('Cadastrar', route('plans.create'));
});

// Dashboard > Planos > Show
Breadcrumbs::for('plans.show', function ($trail, $name) {
    $trail->parent('plans');
    $trail->push($name, route('plans.show', $name));
});

// Dashboard > Planos > Edit
Breadcrumbs::for('plans.edit', function ($trail, $name) {
    $trail->parent('plans');
    $trail->push($name, route('plans.edit', $name));
});

/**
 * Detalhes do plano
 */

// Dashboard > Planos > Plano > Detalhes
Breadcrumbs::for('details.plan.index', function ($trail, $url) {
    $trail->parent('plans.show', $url);
    $trail->push('Detalhes', route('details.plan.index', $url));
});

// Dashboard > Planos > Detalhes > Create
Breadcrumbs::for('details.plan.create', function ($trail, $url) {
    $trail->parent('details.plan.index', $url);
    $trail->push('Cadastrar novo detalhe', route('details.plan.create', $url));
});

// Dashboard > Planos > Detalhes > Show
Breadcrumbs::for('details.plan.show', function ($trail, $url, $name) {
    $trail->parent('details.plan.index', $url);
    $trail->push($name, route('details.plan.show', [$url, $name]));
});


// Dashboard > Planos > Detalhes > Edit
Breadcrumbs::for('details.plan.edit', function ($trail, $url, $name) {
    $trail->parent('details.plan.index', $url);
    $trail->push($name, route('details.plan.edit', [$url, $name]));
});

// Dashboard > Perfis
Breadcrumbs::for('profiles', function ($trail) {
    $trail->parent('admin');
    $trail->push('Perfis', route('profiles.index'));
});

// Dashboard > Perfis > Create
Breadcrumbs::for('profiles.create', function ($trail) {
    $trail->parent('profiles');
    $trail->push('Cadastrar', route('profiles.create'));
});

// Dashboard > Perfis > Show
Breadcrumbs::for('profiles.show', function ($trail, $name) {
    $trail->parent('profiles');
    $trail->push($name, route('profiles.show', $name));
});

// Dashboard > Perfis > Edit
Breadcrumbs::for('profiles.edit', function ($trail, $name) {
    $trail->parent('profiles');
    $trail->push($name, route('profiles.edit', $name));
});



// Dashboard > Permissao
Breadcrumbs::for('permissions', function ($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('permissions.index'));
});

// Dashboard > Perfis > Create
Breadcrumbs::for('permissions.create', function ($trail) {
    $trail->parent('permissions');
    $trail->push('Cadastrar', route('permissions.create'));
});

// Dashboard > Perfis > Show
Breadcrumbs::for('permissions.show', function ($trail, $name) {
    $trail->parent('permissions');
    $trail->push($name, route('permissions.show', $name));
});

// Dashboard > Perfis > Edit
Breadcrumbs::for('permissions.edit', function ($trail, $name) {
    $trail->parent('permissions');
    $trail->push($name, route('permissions.edit', $name));
});
