<?php

use App\Decorators\SearchableDecorator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Models\UmkmModel;

// test('SearchableDecorator __construct method', function () {
//     $mockModel = $this->getMockBuilder(UmkmModel::class)
//         ->getMock();

//     $mockModel->searchable = ['field1', 'field2'];

//     $decorator = new SearchableDecorator($mockModel);

//     $this->assertEquals(['field1', 'field2'], $decorator->searchable);
// });

test('SearchableDecorator search method with paginate parameter as null', function () {
    $mockModel = $this->getMockBuilder(UmkmModel::class)
        ->getMock();

    $mockModel->searchable = ['field1', 'field2'];
    $mockModel->method('where')->willReturn($mockModel);
    $mockModel->method('paginate')->willReturn(new LengthAwarePaginator([], 0, 5));

    $decorator = new SearchableDecorator($mockModel);

    $result = $decorator->search('query', null, []);

    $this->assertInstanceOf(LengthAwarePaginator::class, $result);
});

// test('SearchableDecorator search method with paginate parameter as not null', function () {
//     $mockModel = $this->getMockBuilder(UmkmModel::class)
//         ->getMock();

//     $mockModel->searchable = ['field1', 'field2'];
//     $mockModel->method('where')->willReturn($mockModel);
//     $mockModel->method('paginate')->willReturn(new LengthAwarePaginator([], 0, 10));

//     $decorator = new SearchableDecorator($mockModel);

//     $result = $decorator->search('query', 10, []);

//     $this->assertInstanceOf(LengthAwarePaginator::class, $result);
// });

// test('SearchableDecorator search method with relations parameter as empty', function () {
//     $mockModel = $this->getMockBuilder(UmkmModel::class)
//         ->getMock();

//     $mockModel->searchable = ['field1', 'field2'];
//     $mockModel->method('where')->willReturn($mockModel);
//     $mockModel->method('paginate')->willReturn(new LengthAwarePaginator([], 0, 5));

//     $decorator = new SearchableDecorator($mockModel);

//     $result = $decorator->search('query', 5, []);

//     $this->assertInstanceOf(LengthAwarePaginator::class, $result);
// });

// test('SearchableDecorator search method with relations parameter as not empty', function () {
//     $mockModel = $this->getMockBuilder(UmkmModel::class)
//         ->getMock();

//     $mockModel->searchable = ['field1', 'field2'];
//     $mockModel->method('where')->willReturn($mockModel);
//     $mockModel->method('paginate')->willReturn(new LengthAwarePaginator([], 0, 5));

//     $decorator = new SearchableDecorator($mockModel);

//     $result = $decorator->search('query', 5, ['relation' => $mockModel]);

//     $this->assertInstanceOf(LengthAwarePaginator::class, $result);
// });