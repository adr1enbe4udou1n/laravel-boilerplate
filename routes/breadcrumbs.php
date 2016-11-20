<?php

Breadcrumbs::register('admin.dashboard', function ($breadcrumbs) {
    $breadcrumbs->push(trans('labels.backend.dashboard.title'), route('admin.dashboard'));
});

Breadcrumbs::register('admin.user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('labels.backend.users.management'), route('admin.user.index'));
});

Breadcrumbs::register('admin.user.deleted', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('menus.backend.users.deleted'), route('admin.user.deleted'));
});

Breadcrumbs::register('admin.user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('menus.backend.users.create'), route('admin.user.create'));
});

Breadcrumbs::register('admin.user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('menus.backend.users.edit'), route('admin.user.edit', $id));
});
