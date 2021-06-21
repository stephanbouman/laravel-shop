<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.show', compact('categories'));
    }


    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View|Response
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }
}
