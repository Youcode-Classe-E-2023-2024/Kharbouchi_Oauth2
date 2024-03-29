<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ApiAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testSuccessfulLogin()
    {
        // Créer un utilisateur
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
    
        // Tenter de se connecter
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
    
        // Vérifier que la réponse contient un jeton
        $response->assertJsonStructure([
            'token'
        ]);
    
        $response->assertStatus(200);
    }
    public function testAccessProtectedRoute()
{
    // Créer un utilisateur et obtenir un jeton
    $user = User::factory()->create();
    $token = $user->createToken('TestToken')->accessToken;

    // Faire une requête à une route protégée avec le jeton
    $response = $this->withHeaders([
        'Authorization' => 'Bearer '.$token,
    ])->get('/api/protected-route');

    // Vérifier que l'accès est autorisé
    $response->assertStatus(200);
}
}
