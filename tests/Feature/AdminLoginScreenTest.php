<?php

test('admin login presents a branded responsive sign in form', function () {
    $this->get(route('admin.login'))
        ->assertOk()
        ->assertSee('YAKINIKU KING')
        ->assertSee('Khu vực quản trị')
        ->assertSee('action="'.route('admin.login.submit').'"', false)
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false);
});
