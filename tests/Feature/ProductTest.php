<?php

namespace Tests\Feature;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test route GET /api/products with ProductController@index.
     *
     * @return void
     */
    public function testIndex()
    {
        Product::factory(4)->create();

        $response = $this->getJson('/api/products', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = ProductResource::collection(Product::paginate());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Search Product by name ProductController@index
     * q = 'Arroz Integral'
     *
     * @return void
     */
    public function testSearchProduct()
    {
        $q = 'Arroz integral';

        Product::factory(['description' => 'Arroz integral'])->create();

        Product::factory(4)->create();

        $response = $this->getJson('/api/products?q='.$q, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = ProductResource::collection(Product::where('description', 'LIKE', $q . '%')->paginate());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route GET /api/products/{product} with ProductController@show.
     *
     * @return void
     */
    public function testShow()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/products/' . $product->id, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = new ProductResource($product);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route PUT /api/products/{product} with ProductController@update
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'code' => '12345678',
        ];

        $product = Product::factory()->create();

        $response = $this->putJson('/api/products/' . $product->id, $data, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.ProductController.update.success'),
            ])->assertJsonStructure([
                'data' => [
                    'id',
                    'description',
                    'price',
                    'sale_price',
                    'available'
                ],
            ]);
    }

    /**
     * Test route DELETE /api/products/{product} with ProductController@destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson('/api/products/' . $product->id, [], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.ProductController.destroy.success'),
            ]);
    }
}
