<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Установка Laravel Passport
        $this->artisan('passport:install');
    }

    public function testAdminCanGetAllNotes()
    {
        // Создание пользователя с ролью 'admin'
        $admin = User::factory()->create();
        $admin->role()->associate(Role::factory()->create(['name' => 'admin']));
        $admin->save();

        //Вызов API без авторизации
        $response = $this->json('GET', '/api/v1/notes');
        $response->assertStatus(401);

        // Авторизация пользователя
        Passport::actingAs($admin);

        // Создание нескольких записей
        $notes = Note::factory(3)->create();

        // Вызов API авторизованным администратором
        $response = $this->json('GET', '/api/v1/notes');
        $response->assertStatus(201)
            ->assertJsonCount($notes->count(), 'notes');
    }

    public function testUserCanGetOwnNotes()
    {
        // Создание обычного пользователя
        $user = User::factory()->create();

        // Генерация токена доступа для пользователя
        $token = $user->createToken('Test Token')->accessToken;

        // Вызов API без авторизации
        $response = $this->json('GET', '/api/v1/notes');
        $response->assertStatus(401);

        // Вызов API авторизованным пользователем
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
            ->json('GET', '/api/v1/notes');
        $response->assertStatus(201)
            ->assertJsonCount($user->notes->count(), 'notes');
    }
}
