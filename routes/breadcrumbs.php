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

Breadcrumbs::register('contact-sent', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('contact');
    $breadcrumbs->push(trans('labels.frontend.titles.message_sent'), route('contact-sent'));
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

Breadcrumbs::register('admin.form_submission.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.form_submissions.titles.main'), route('admin.form_submission.index'));
});

Breadcrumbs::register('admin.form_submission.show', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.form_submission.index');
    $breadcrumbs->push(trans('labels.backend.form_submissions.titles.show'), route('admin.form_submission.show', $id));
});

Breadcrumbs::register('admin.form_setting.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.form_settings.titles.main'), route('admin.form_setting.index'));
});

Breadcrumbs::register('admin.form_setting.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.form_setting.index');
    $breadcrumbs->push(trans('labels.backend.form_settings.titles.create'), route('admin.form_setting.create'));
});

Breadcrumbs::register('admin.form_setting.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.form_setting.index');
    $breadcrumbs->push(trans('labels.backend.form_settings.titles.edit'), route('admin.form_setting.edit', $id));
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

Breadcrumbs::register('admin.role.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.roles.titles.main'), route('admin.role.index'));
});

Breadcrumbs::register('admin.role.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.role.index');
    $breadcrumbs->push(trans('labels.backend.roles.titles.create'), route('admin.role.create'));
});

Breadcrumbs::register('admin.role.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.role.index');
    $breadcrumbs->push(trans('labels.backend.roles.titles.edit'), route('admin.role.edit', $id));
});

Breadcrumbs::register('admin.meta.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.metas.titles.main'), route('admin.meta.index'));
});

Breadcrumbs::register('admin.meta.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.meta.index');
    $breadcrumbs->push(trans('labels.backend.metas.titles.create'), route('admin.meta.create'));
});

Breadcrumbs::register('admin.meta.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.meta.index');
    $breadcrumbs->push(trans('labels.backend.metas.titles.edit'), route('admin.meta.edit', $id));
});

Breadcrumbs::register('admin.redirection.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push(trans('labels.backend.redirections.titles.main'), route('admin.redirection.index'));
});

Breadcrumbs::register('admin.redirection.create', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('admin.redirection.index');
    $breadcrumbs->push(trans('labels.backend.redirections.titles.create'), route('admin.redirection.create'));
});

Breadcrumbs::register('admin.redirection.edit', function (Generator $breadcrumbs, $id) {
    $breadcrumbs->parent('admin.redirection.index');
    $breadcrumbs->push(trans('labels.backend.redirections.titles.edit'), route('admin.redirection.edit', $id));
});
