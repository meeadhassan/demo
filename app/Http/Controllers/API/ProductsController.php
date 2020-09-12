<?php

namespace App\Http\Controllers\API;

use App\Constants\Request\RequestKey;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Product;
use App\Services\Products\ProductsService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
   protected $productsServices ;

    public function __construct(ProductsService $productsServices)
    {
        $this->productsServices = $productsServices;
    }
        /**
     * @return \Illuminate\Http\JsonResponse
     * display all products
     */


    public function index(){

      $this->productsServices = new ProductsService();
      $products = $this->productsServices->getAll();

     return response()->json(array('success' => true,
            'status_code' => 200,
            'message' => 'Products',
            'data'=>$products
        ));

    }

    /**
     * @param StoreProduct $request
     * @return \Illuminate\Http\JsonResponse
     * validate and store new product
     */

    public function store(StoreProduct $request){

       $product = $this->productsServices->createProduct($request);

        return response()->json(array('success' => true,
            'status_code' => 200,
            'message' => 'Created Successfully',
            'data'=>$product
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * show the product Info
     */

    public function show(Request $request){

    $product = $this->productsServices->showProduct($request);

    return response()->json(array('success' => true,
            'status_code' => 200,
            'message' => 'Product Info',
            'data'=>$product
        ));
    }

    /**
     * @param StoreProduct $request
     * @return \Illuminate\Http\JsonResponse
     * edit product
     */

    public function update(StoreProduct $request)
    {
        return $this->productsServices->updateProduct($request);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * delete product
     */


    public function delete(Request $request)
    {
    return $this->productsServices->deleteProduct($request);

    }



}
