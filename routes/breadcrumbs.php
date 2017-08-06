<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use DaveJamesMiller\Breadcrumbs\Generator;

Breadcrumbs::register('home', function (Generator $breadcrumbs) {
    $breadcrumbs->push(trans('labels.frontend.titles.home'), route('home'));
});

Breadcrumbs::register('about', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.frontend.titles.about'), route('about'));
});

Breadcrumbs::register('blog.index', function (Generator $breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('labels.frontend.titles.blog'), route('blog.index'));
});

Breadcrumbs::register('blog.show', function (Generator $breadcrumbs, Post $post) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push($post->title, route('blog.show', $post->slug));
});

Breadcrumbs::register('blog.tag', function (Generator $breadcrumbs, Tag $tag) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push($tag->name, route('blog.tag', $tag->slug));
});

Breadcrumbs::register('blog.owner', function (Generator $breadcrumbs, User $user) {
    $breadcrumbs->parent('blog.index');
    $breadcrumbs->push($user->name, route('blog.owner', $user->slug));
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
