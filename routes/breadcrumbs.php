<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('user.dashboard'));
});

Breadcrumbs::for('my-profile', function ($trail) {
    $trail->parent('home');
    $trail->push('My Profile', route('users.profile'));
});