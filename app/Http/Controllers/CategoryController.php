<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use DB;
use Exception;

class CategoryController extends Controller
{
    public function store(CategoryCreateRequest $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {
            $category = Category::create($payload->toArray());
            DB::commit();

            return $this->success('new category is created successfully', $category);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function index()
    {
        try {
            $categories = Category::sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            return $this->success('category list is retrived successfully', data: $categories);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);

            return $this->success('category detail is retrived successfully', $category);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $payload = collect($request->validated());

        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update($payload->toArray());
            DB::commit();

            return $this->success('category is updated successfully', $category);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return $this->noContent('category is deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }
}
