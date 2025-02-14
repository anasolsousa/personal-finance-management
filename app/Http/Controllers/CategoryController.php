<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;


class CategoryController extends Controller
{

    // CATEGORY
    public function index()
    {
        $category = Category::all();
        return response()->json($category);
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->icon = $request->icon;

        $category->save();

        return response()->json([
            'message' => 'Category criada com sucesso',
            'Category' => $category
        ], 201);
    }

    public function updateCategory(Request $request, string $id)
    {
        $category = Category::find($id);

        $validated = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'icon' => 'required|max:255',
        ], [
            'name.unique' => 'Este nome já está inserido. Por favor escolha outro.',
            'icon.max' => 'O campo icon aceita no máximo 255 caracteres.'
        ]);

        $category->update($validated);

        return response()->json([
            'message' => 'Category atualizado com sucesso',
            'Categoria' => $category
        ], 200);
    }

    public function destroyCategory(string $id)
    {
        $category = Category::find($id);

        $category->delete();

        return response()->json([
            'message' => 'Categoria eliminada com sucesso',
            'category' => $category
        ]);
    }


    // -------------

    
    // SUBCATEGORY
    public function subCategory()
    {
        $subCategory = SubCategory::all();
        return response()->json($subCategory);
    }

    public function storeSubCategory(Request $request)
    {
        $subCategory = new SubCategory();

        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;

        $subCategory->save();

        return response()->json([
            'message' => 'SubCategory criada com sucesso',
            'SubCategory' => $subCategory
        ], 201);
    }

    public function updateSubCategory(Request $request, string $id){

        $subCategory = SubCategory::find($id);

        $validated = $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $subCategory->id,
            'category_id' => 'required|max:255',
        ], [
            'name.unique' => 'Este nome já está inserido. Por favor escolha outro.',
            'category_id.max' => 'O campo aceita no máximo 255 caracteres.'
        ]);

        $subCategory->update($validated);

        return response()->json([
            'message' => 'Subcategoria atualizado com sucesso',
            'Subcategoria' => $subCategory
        ], 200);
    }

    public function destroySubCategory(string $id)
    {
        $subCategory = SubCategory::where('id', $id)->first();

        if(!$subCategory){
            return response()->json([
            'message' => 'Subcategoria não foi encontrada'
            ],400);
        }

        $subCategory->delete();

        return response()->json([
            'message' => 'Subcategoria eliminada com sucesso',
            'Subcategoria' => $subCategory
        ]);
    }


    // lista de categorias e subcategorias juntas
    public function categoryAndSubCategory()
    {
        $subCategories = SubCategory::with('category')
        ->get()
        ->groupBy('category_id')
        ->map(function ($group) {
            return [
                'category' => $group->first()->category->name,
                'subcategories' => $group
            ];
        });
    
        return response()->json($subCategories);
    }
}
