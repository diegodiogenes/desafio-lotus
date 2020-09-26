<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\DestroyRequest;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\ShowRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ReportResource;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * Report of top or less sold products.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function reportProducts(IndexRequest $request)
    {
        $from = Carbon::today()->addMonths(-3)->startOfMonth();
        $to = Carbon::today()->endOfMonth();

        if ($request->get('from')) {
            $from = Carbon::createFromFormat('d/m/Y', $request->get('from'));
        }

        if ($request->get('to')) {
            $to = Carbon::createFromFormat('d/m/Y', $request->get('to'));
        }

        $order = $request->get('order', 'desc');

        $report = Product::whereHas(
            'sales',
            function ($q) use ($from, $to) {
                $q->where('sales.created_at', '<=', $to->format('Y-m-d'));
                $q->where('sales.created_at', '>=', $from->format('Y-m-d'));
            }
        )->withCount('sales')->orderBy('sales_count', $order)->take(10)->get();

        return ReportResource::collection($report);
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
        $image = null;
        if ($request->hasFile('image')) {
            $image = time() . '-' . $data['description'] . '.' . $request->file('image')
                    ->getClientOriginalExtension();
            $request->file('image')->move('products', $image);
        }

        DB::beginTransaction();
        try {
            $product = Product::create([
                'description' => $data['description'],
                'price' => $data['price'],
                'code' => $data['code'],
                'sale_price' => $data['sale_price'],
                'image' => $image,
                'available' => $data['available'] ?? null,
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
                'errors' => $exception->getMessage(),
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

            if ($request->hasFile('image')) {
                @unlink('products' . $product->image);
                $product->image = time() . '-' . $product->description . '.' . $request->file('image')
                        ->getClientOriginalExtension();
                $request->file('image')->move('products', $product->image);
            }

            $product->save();

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
                'errors' => $exception->getMessage(),
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
