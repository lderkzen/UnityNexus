<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        // TODO: Fetch all categories from database

        return Inertia::render('Categories/Index', [
            'categories' => [
                [
                    'id' => 1,
                    'name' => 'Social',
                    'member_count' => 100,
                    'application_id' => '',
                    'status' => 'OPEN',
                ],
                [
                    'id' => 2,
                    'name' => 'Ashes of Creation',
                    'member_count' => 400,
                    'application_id' => '',
                    'status' => 'OPEN',
                ],
                [
                    'id' => 3,
                    'name' => 'Lost Ark',
                    'member_count' => 50,
                    'application_id' => '',
                    'status' => 'OPEN',
                ],
            ]
        ]);
    }

    public function create()
    {
        //
    }

    public function store(CategoryRequest $request)
    {
        //
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(CategoryRequest $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {
        //
    }
}
