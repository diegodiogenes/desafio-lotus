<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\DestroyRequest;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\ShowRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $query = Product::query();

        if ($search = $request->get('q')) {
            $query = $query->where('description', 'LIKE', $search . '%');
        }

        $products = $query->paginate();

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        DB::beginTransaction();
        try {
            $product = Product::create([
                'description' => $data['description'],
                'price' => $data['price'],
                'code' => $data['code'],
                'sale_price' => $data['sale_price'],
                'image' => $data['image'],
                'available' => $data['available'],
            ]);

            $productResource = new ProductResource($product);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.ProductController.store.success'),
                'data' => [
                    'product' => $productResource,
                ],
            ], Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.ProductController.store.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param int $id
     * @return ProductResource
     */
    public function show(ShowRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $productResource = new ProductResource($product);

        return $productResource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::findOrFail($id);

        DB::beginTransaction();
        try {
            tap($product)->update($data);

            $productResource = new ProductResource($product);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.ProductController.update.success'),
                'data' => $productResource,
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.ProductController.update.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DestroyRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            Product::destroy($id);

            DB::commit();
            return $this->responseSuccess([
                'message' => trans('response.ProductController.destroy.success'),
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError([
                'message' => trans('response.ProductController.destroy.error'),
                'exception' => $exception->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
