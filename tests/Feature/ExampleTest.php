<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('la portada redirige al listado de productos', function () {
    $this->get('/')->assertRedirect('/productos');
});

test('el listado de productos responde correctamente', function () {
    $this->get('/productos')->assertSuccessful();
});
