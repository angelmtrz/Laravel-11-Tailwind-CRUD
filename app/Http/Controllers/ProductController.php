<?php
//Controlador para rutas web
//php artisan make:controller ProductController --resource

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Mostrar todos los productos
        //$products = Product::all();

        //Mostrar todos los productos con paginacion
        //$products = Product::paginate(10);

        //Agregar busqueda
        $query = Product::query();
        //aplicar filtro
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear un nuevo producto
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Almacenar un nuevo producto
        $request->validate([
            'code' => 'required|string|max:10|unique:products,code',
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('assets/images/products', 'public');
        }

        //dd($imagePath);

        //Product::create($request->all());
        Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Mostrar un producto específico
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Mostrar el formulario para editar un producto
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Actualizar un producto específico
        $request->validate([
            'code' => ['required','string', 'max:10',
                        Rule::unique('products', 'code')->ignore($product->id)
                    ],
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Inicializar la variable para la ruta de la imagen
        $imagePath = $product->image; // Mantener la imagen existente por defecto

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('assets/images/products', 'public');
        }

        //$product->update($request->all());
        $product->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'image' => $imagePath
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Eliminar un producto específico
        $product->delete();
        return redirect()->route('products.index');
    }
}
