<?php

test('about page loads', function () {
    $response = $this->get('/about');

    $response
        ->assertOk()
        ->assertSee('About Us');
});
