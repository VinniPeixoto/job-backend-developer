<?php

namespace App\Services\Products;



use App\Models\Product;
use GuzzleHttp\Client;

class ImportProductsByExternalApiService
{
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function run($id)
    {
        $response = $this->client->get("https://fakestoreapi.com/products/{$id}");
        $dataResponse = $response->getBody()->getContents();

        $data = $this->prepareData(json_decode($dataResponse));

        return Product::create($data);
    }

    public function prepareData($product)
    {
        return [
            'name' => $product->title,
            'price' => $product->price,
            'description' => $product->description,
            'category' => $product->category,
            'image_url' => $product->image,
        ];
    }
}
