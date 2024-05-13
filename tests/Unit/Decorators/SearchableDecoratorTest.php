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
}