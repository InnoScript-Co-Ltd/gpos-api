<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use DB;
use Exception;

class ItemController extends Controller
{
    public function store(ItemCreateRequest $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {
            $item = Item::create($payload->toArray());
            DB::commit();

            return $this->success('new item is created successfully', $item);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function index()
    {
        try {
            $items = Item::with(['category'])
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            return $this->success('item list is retrived successfully', $items);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $item = Item::with(['category'])->findOrFail($id);

            return $this->success('item detail is retrived successfully', $item);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        if (isset($payload['photo'])) {
            $profileImagePath = $payload['photo']->store('images', 'public');
            $profileImage = explode('/', $profileImagePath)[1];
            $payload['photo'] = $profileImage;
        }

        try {
            $item = Item::findOrFail($id);
            $item->update($payload->toArray());
            DB::commit();

            return $this->success('item is updated successfully', $item);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $item = Item::findOrFail($id);
            $item->delete();

            return $this->noContent('item is deleted successfully');
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }
}
