<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch categories, optionally filtering by search
        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        // Return JSON if requested (API)
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'success',
                'data' => $categories
            ]);
        }

        // Return Blade view
        return view('components.categories', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $category = Category::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Category created successfully',
                'data' => $category
            ], 201);
        }

        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully.');
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $category->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category
            ]);
        }

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Category deleted successfully'
            ]);
        }

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    // Optional: Show a single category (API only)
    public function show(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'success',
                'data' => $category
            ]);
        }

        return view('categories.show', compact('category'));
    }
}
