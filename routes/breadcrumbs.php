<?php

use \DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('home', function (Generator $breadcrumbs) {
    $breadcrumbs->push(trans('labels.frontend.titles.home'), route('home'));
});

Breadcrumbs::register('about', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.frontend.titles.about'), route('about'));
});

Breadcrumbs::register('contact', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.frontend.titles.contact'), route('contact'));
});

Breadcrumbs::register('legal-mentions', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.frontend.titles.legal_mentions'), route('legal-mentions'));
});

Breadcrumbs::register('user.home', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.user.titles.space'), route('user.home'));
});

Breadcrumbs::register('user.account', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('user.home');
    $breadcrumbs->push(trans('labels.user.titles.account'), route('user.account'));
});

Breadcrumbs::register('admin.home', function (Generator $breadcrumbs) {
    $breadcrumbs->push(trans('labels.backend.titles.dashboard'), route('admin.home'));
});

Breadcrumbs::register('admin.user.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.users.titles.main'), route('admin.user.index'));
});

Breadcrumbs::register('admin.user.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('labels.backend.users.titles.create'), route('admin.user.create'));
});

Breadcrumbs::register('admin.user.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.user.index');
    $breadcrumbs->push(trans('labels.backend.users.titles.edit'), route('admin.user.edit', $id));
});
