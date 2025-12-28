<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $query = Product::with('category');

        // Search by product name
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        $categories = Category::all();

        // API response
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'success',
                'data' => $products
            ]);
        }

        // Web view
        return view('components.products', compact('products', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'brand'       => 'required|string|max:255',
            'thumbnail'   => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'status'      => 'required|in:active,inactive',
        ]);

        // Convert status to integer (1 = active, 0 = inactive)
        $validated['status'] = $validated['status'] === 'active' ? 1 : 0;

        Product::create($validated);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'required|string',
        'price'       => 'required|numeric|min:0',
        'category_id' => 'required|integer|exists:categories,id',
        'brand'       => 'required|string|max:255',
        'thumbnail'   => 'required|string|max:255',
        'stock'       => 'required|integer|min:0',
        'status'      => 'required|in:active,inactive',
    ]);

    // Convert status to integer
    $validated['status'] = $validated['status'] === 'active' ? 1 : 0;

    $product->update($validated);

    return redirect()->back()->with('success', 'Product updated successfully');
}

        /**
         * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->back()
            ->with('success', 'Product deleted successfully');
    }
}
