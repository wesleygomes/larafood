<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

//Dashboard
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Dashboard', route('admin.index'));
});

// Dashboard > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('admin');
    $trail->push('Usuários', route('users.index'));
});
// Dashboard > Users > Create
Breadcrumbs::for('users.create', function ($trail) {
    $trail->parent('users');
    $trail->push('Cadastrar', route('users.create'));
});
// Dashboard > Users > Show
Breadcrumbs::for('users.show', function ($trail, $name) {
    $trail->parent('users');
    $trail->push($name, route('users.show', $name));
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


// Dashboard > Tenants
Breadcrumbs::for('tenants', function ($trail) {
    $trail->parent('admin');
    $trail->push('Empresas', route('tenants.index'));
});

// Dashboard > Tenants > Create
Breadcrumbs::for('tenants.create', function ($trail) {
    $trail->parent('tenants');
    $trail->push('Cadastrar', route('tenants.create'));
});

// Dashboard > Tenants > Show
Breadcrumbs::for('tenants.show', function ($trail, $name) {
    $trail->parent('tenants');
    $trail->push($name, route('tenants.show', $name));
});

// Dashboard > Tenants > Edit
Breadcrumbs::for('tenants.edit', function ($trail, $name) {
    $trail->parent('tenants');
    $trail->push($name, route('tenants.edit', $name));
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

// Dashboard > Perfis > Profiles
Breadcrumbs::for('profiles.permissions', function ($trail, $name) {
    $trail->parent('profiles');
    $trail->push('Permissões do perfil '.$name, route('profiles.permissions', $name));
});

// Dashboard > Perfis > Profiles > Create
Breadcrumbs::for('profiles.permissions.available', function ($trail, $name) {
    $trail->parent('profiles');
    $trail->push('Vincular permissões para '.$name, route('profiles.permissions.available', $name));
});

// Dashboard > Permission > Profiles
Breadcrumbs::for('permissions.profiles', function ($trail, $name) {
    $trail->parent('permissions');
    $trail->push('Perfils da Permissão '.$name, route('permissions.profiles', $name));
});


// Dashboard > Planos > Profiles
Breadcrumbs::for('plans.profiles', function ($trail, $name) {
    $trail->parent('plans');
    $trail->push('Planos do perfil '.$name, route('plans.profiles', $name));
});

// Dashboard > Planos > Profiles > Create
Breadcrumbs::for('plans.profiles.available', function ($trail, $plan, $name) {
    $trail->parent('plans.profiles', $plan);
    $trail->push($name, route('plans.profiles.available', $name));
});

// Dashboard > Profiles > Plans
Breadcrumbs::for('profiles.plans', function ($trail, $name) {
    $trail->parent('profiles');
    $trail->push('Perfils do plano '.$name, route('profiles.plans', $name));
});
