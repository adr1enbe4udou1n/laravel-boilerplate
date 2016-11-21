<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('labels.backend.titles.dashboard'), route('admin.dashboard'));
});

Breadcrumbs::register('admin.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.users.titles.main'), route('admin.user.index'));
});

Breadcrumbs::register('admin.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('labels.backend.users.titles.create'), route('admin.user.create'));
});

Breadcrumbs::register('admin.user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('labels.backend.users.titles.edit'), route('admin.user.edit', $id));
});
