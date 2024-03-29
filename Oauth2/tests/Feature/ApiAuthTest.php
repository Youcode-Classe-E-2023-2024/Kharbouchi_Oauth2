<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; // Assurez-vous d'importer le modèle User

class ApiAuthTest extends TestCase
{
    use RefreshDatabase; // Utilisez cette trait si vous voulez réinitialiser la base de données après chaque test

    /**
     * Test de la connexion réussie.
     */
    public function testSuccessfulLogin()
    {
        // Créer un utilisateur
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        // Tenter de se connecter
        $response = $this->postJson('/api/login', [ // Utilisez postJson pour une API
            'email' => $user->email,
            'password' => $password,
        ]);

        // Vérifier que la réponse contient un jeton
        $response->assertJsonStructure([
            'access_token', // Assurez-vous que la clé JSON correspond à ce que votre API renvoie
            // Si vous utilisez Laravel Passport par défaut, la clé serait 'access_token' et non 'token'
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test de l'accès à une route protégée.
     */
    public function testAccessProtectedRoute()
    {
        // Créer un utilisateur et obtenir un jeton
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken; // Assurez-vous que cette ligne correspond à la manière dont votre application génère le token

        // Faire une requête à une route protégée avec le jeton
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/protected-route');

        // Vérifier que l'accès est autorisé
        $response->assertStatus(200);
    }
}
