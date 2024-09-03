<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProductAPIService
{
    protected $apiBaseUrl = 'http://localhost:8000/api/fruitAndVegetable/prices';

    public function fetchProducts($memberStateCodes, $products)
    {
        $response = Http::timeout(60)->get($this->apiBaseUrl, [
            'memberStateCodes' => $memberStateCodes,
            'products' => $products
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Assuming the API returns a list of products with relevant fields
            $products = array_map(function ($product) {
                return [
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'category' => $product['category'],
                    'image_url' => $product['image_url'],
                    'price' => $product['price']
                ];
            }, $data);

            return $products;
        }

        return [];
    }

    public function fetchProduct($id)
    {
        $response = Http::get($this->apiBaseUrl . '/' . $id);

        if ($response->successful()) {
            $product = $response->json();

            return [
                'name' => $product['name'],
                'description' => $product['description'],
                'category' => $product['category'],
                'image_url' => $product['image_url'],
                'price' => $product['price']
            ];
        }

        return null;
    }
}
