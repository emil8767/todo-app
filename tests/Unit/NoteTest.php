<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexAsAdmin()
    {

        $admin = User::factory()->create(['role_id' => '1']);
        $role = Role::factory()->create(['name' => 'admin']);
        $this->actingAs($admin);
        $response = $this->json('GET', '/api/v1/notes');
        $response->assertStatus(201);
        $response->assertJsonStructure(['notes']);

    }
}
