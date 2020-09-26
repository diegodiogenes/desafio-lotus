<?php

namespace Tests\Feature;

use App\Http\Resources\SaleResource;
use App\Models\Sales;
use Illuminate\Http\Response;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * Test route GET /api/sales with SaleController@index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->getJson('/api/sales', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = SaleResource::collection(Sales::paginate());

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route GET /api/sales/{sale} with SaleController@show.
     *
     * @return void
     */
    public function testShow()
    {
        $sale = Sales::find(1);

        $response = $this->getJson('/api/sales/' . $sale->id, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $resource = new SaleResource($sale);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson($resource->response()->getData(true));
    }

    /**
     * Test route PUT /api/sales/{sale} with SaleController@update
     *
     * @return void
     */
    public function testUpdate()
    {
        $data = [
            'amount' => '123.50',
        ];

        $sale = Sales::find(1);

        $response = $this->putJson('/api/sales/' . $sale->id, $data, [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.SaleController.update.success'),
            ])->assertJsonStructure([
                'data' => [
                    'amount',
                    'profit',
                    'products'
                ],
            ]);
    }

    /**
     * Test route DELETE /api/sales/{sale} with SaleController@destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $sale = Sales::find(1);

        $response = $this->deleteJson('/api/sales/' . $sale->id, [], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertSuccessful()
            ->assertJson([
                'message' => trans('response.SaleController.destroy.success'),
            ]);
    }
}
