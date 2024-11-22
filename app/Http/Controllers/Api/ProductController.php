<?php
//Controlador para rutas api
//php artisan make:controller Api/ProductController --resource

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            $products = Product::orderBy('name')->paginate(10);

            $response = [
                'data' => $products->items(),
                'meta' => [
                    'total' => $products->total(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                ]
            ];

            return response()->json($response, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Error al obtener los productos'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $product = null;

        try {
            $product = Product::create($data);

            return response()->json([
                'success' => true,
                'data' => $product
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al crear el producto'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $product
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al obtener el producto'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code): JsonResponse
    {
        try {
            $product = Product::where('code', $code)->firstOrFail();

            $request->validate([
                'code' => ['required','string', 'max:10',
                    Rule::unique('products', 'code')->ignore($product->id)
                ],
                'name' => ['required', 'string', 'max:100'],
                'description' => ['required', 'string', 'max:300'],
                'stock' => ['required', 'numeric'],
                'price' => ['required', 'numeric'],
                'image' => ['string', 'max:255'],
            ]);

            $product->update($request->all());

            return response()->json([
                'success' => true,
                'data' => $product
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al actualizar el producto'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code): JsonResponse
    {
        try {
            $product = Product::where('code', $code)->firstOrFail();

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado!'
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Error al eliminar el producto'
            ]);
        }
    }
}
