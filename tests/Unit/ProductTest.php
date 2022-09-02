<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateProductWithImageByApi()
    {
        $data = [
            'name' => 'kakak',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
            'image' => 'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg',
        ];

        $response = $this->post(route('api.product.store'), $data);

        $response->assertStatus(201);
        $response->assertJson(['data' => $data]);
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                ]
            ]
        );

    }

    public function testCreateProductWithoutImageByApi()
    {
        $data = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $response = $this->post(route('api.product.store'), $data);

        $response->assertStatus(201);
        $response->assertJson(['data' => $data]);
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'image',
                ]
            ]
        );

    }

    public function testSearchingForProductWithNameByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'name' => 'name'
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testSearchingForProductWithCategoryByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'name' => 'test'
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testSearchingForProductWithOnlyCategoryByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'category' => 'test'
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testSearchingForProductWithImageByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
            'image' => 'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg',
        ];

        $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'image' => true
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testSearchingForProductWithOutImageByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'image' => false
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testSearchingForProductWithOnlyIdByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $product = $this->post(route('api.product.store'), $dataInsert);

        $data = [
            'id' => $product['data']['id']
        ];

        $response = $this->get(route('api.product.find'), $data);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    [
                        'id',
                        'name',
                        'description',
                        'price',
                        'image',
                    ]
                ]
            ]
        );
    }

    public function testDeletingProductByApi()
    {
        $dataInsert = [
            'name' => 'product name',
            'price' => '109.95',
            'description' => 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...',
            'category' => 'test',
        ];

        $product = $this->post(route('api.product.store'), $dataInsert);

        $response = $this->delete(route('api.product.delete', ['id' => $product['data']['id']]));

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Product deleted']);

    }
}
