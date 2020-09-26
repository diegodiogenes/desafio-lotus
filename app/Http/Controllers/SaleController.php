<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale\DestroyRequest;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\SaleResource;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Class SaleController
 * @package App\Http\Controllers
 */
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $sales = Sales::paginate();

        return SaleResource::collection($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        $products = Product::whereIn('id', $data['products']);

        DB::beginTransaction();
        try {
            $sale = Sales::create([
                'amount' => $products->sum('sale_price'),
                'profit' => $products->sum('sale_price') - $products->sum('price')
            ]);

            $sale->products()->sync($products->pluck('id'));

            $saleResource = new SaleResource($sale);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.SaleController.store.success'),
                'data' => [
                    'product' => $saleResource,
                ],
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.SaleController.store.error'),
                'errors' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return SaleResource
     */
    public function show($id)
    {
        $sale = Sales::findOrFail($id);

        $saleResource = new SaleResource($sale);

        return $saleResource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $sale = Sales::findOrFail($id);

        DB::beginTransaction();
        try {
            tap($sale)->update($data);

            $saleResource = new SaleResource($sale);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.SaleController.update.success'),
                'data' => $saleResource,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.SaleController.update.error'),
                'errors' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Sales::destroy($id);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.SaleController.destroy.success'),
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.SaleController.destroy.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
