<?php

use App\Models\Tip;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a tip can be updated', function () {
    $tip = Tip::create([
        'title' => 'Original title',
        'slug' => 'original-title',
        'content' => 'Original content',
    ]);

    $response = $this->putJson(route('tips.update', $tip), [
        'title' => 'Updated title',
        'content' => 'Updated content',
    ]);

    $response->assertOk()
        ->assertJsonPath('title', 'Updated title')
        ->assertJsonPath('content', 'Updated content');

    expect($tip->fresh())
        ->title->toBe('Updated title')
        ->content->toBe('Updated content');
});
