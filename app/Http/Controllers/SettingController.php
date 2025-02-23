<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use DB;
use Exception;

class SettingController extends Controller
{
    public function update(SettingUpdateRequest $request, $id)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {
            $setting = Setting::findOrFail($id);
            $setting->update($payload->toArray());
            DB::commit();

            return $this->success('Setting info is updated successfully', $setting);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        try {
            $setting = Setting::findOrFail($id);

            return $this->success('Setting info is retrived successfully', $setting);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }
}
