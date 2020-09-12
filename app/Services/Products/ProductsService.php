<?php

namespace App\Services\Products;


use App\Constants\Request\RequestKey;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;

/**
 *  handling all products logic
 */
class ProductsService
{

    /***
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     */
    public static function getAll()
    {
        return Product::query()->orderByDesc('created_at')->paginate('15');

    }


    public static function createProduct($request)
    {
        return Product::create([
            'name' => $request[RequestKey::PRODUCT_NAME],
            'price' => $request[RequestKey::PRICE],
            'description' => $request[RequestKey::DESCRIPTION]
        ]);

    }

    /**
     * @param $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]
     *
     */

    //TODO encrypt all passing id
    public static function showProduct($request)
    {
        return Product::query()->find($request[RequestKey::ID]);
    }


    public static function updateProduct($request)
    {
        $product = Product::query()->find($request[RequestKey::ID]);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not found',
                'status_code' => Response::HTTP_NOT_FOUND
            ]);

        } else {
            $product = Product::query()->where(RequestKey::ID, $request[RequestKey::ID])
                ->update([
                    'name' => $request[RequestKey::PRODUCT_NAME],
                    'price' => $request[RequestKey::PRICE],
                    'description' => $request[RequestKey::DESCRIPTION]
                ]);

            return response()->json(array('success' => true,
                'status_code' => 200,
                'message' => 'Updated Successfully',
                'data' => $product
            ));
        }

    }


    public function deleteProduct($request)
    {
        $product = Product::query()->find($request[RequestKey::ID]);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product Not found',
                'status_code' => Response::HTTP_NOT_FOUND
            ]);

        } else {

            Product::query()->where(RequestKey::ID, $request[RequestKey::ID])->delete();

            return response()->json(array('success' => true,
                'status_code' => 200,
                'message' => 'Deleted Successfully',
            ));

        }


    }


}
