<?php

use Tests\TestCase;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\UserModel;
use App\Enums\Pengaduan\PengaduanStatusEnum;

class SearchableDecotatorTest extends TestCase {

    public SearchableDecorator $decorator;

    public function setUp(): void {
        parent::setUp();
        $this->decorator = new SearchableDecorator(PengaduanModel::class);
    }

    /**
     * @test
     */
    public function it_can_search_through_relationships() {
        $existingEmailPengadu = PengaduanModel::whereRelation('user', 'email', 'LIKE', '%a%')->first()->getPengadu()->getEmail();

        $results = $this->decorator->search($existingEmailPengadu, 10, ['user' => UserModel::class]);

        $this->assertNotEmpty($results);
        $this->assertEquals($existingEmailPengadu, $results->first()->getPengadu()->getEmail());
    }

    /**
     * @test
     */
    public function it_can_perform_filtering() {
        $results = $this->decorator->search('', 10, [], ['status' => PengaduanStatusEnum::BARU]);

        $this->assertNotEmpty($results);
        $this->assertEquals(PengaduanStatusEnum::BARU->value, $results->first()->getStatus());
    }

    /**
     * @test
     */
    public function it_can_paginte_the_results() {
        $results = $this->decorator->search('', 10);
        $this->assertCount(10, $results);

        $results = $this->decorator->search('', 5);
        $this->assertCount(5, $results);
        
    }

    /**
     * @test
     */
    public function it_fails_login_with_invalid_credentials() {
        // Attempt to login with invalid credentials
        $response = $this->post('/auth/signin', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        // Assert that the response redirects back to the sign-in page
        $response->assertStatus(302);
        $response->assertRedirect(route('auth.signInPage'));

        // Assert that the user is not authenticated
        $this->assertGuest();

        // Assert that the session contains the error message
        $response->assertSessionHas('danger', 'Invalid email or password');
    }

    
}