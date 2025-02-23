<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingUpdateRequest;
use App\Models\Setting;
use DB;
use Exception;

class SettingController extends Controller
{
    public function update(SettingUpdateRequest $request)
    {
        $payload = collect($request->validated());

        DB::beginTransaction();

        try {
            $setting = Setting::findOrFail(1);
            $setting->update($payload->toArray());
            DB::commit();

            return $this->success('Setting info is updated successfully', $setting);
        } catch (Exception $e) {
            DB::rollBack();

            return $this->internalServerError();
        }
    }

    public function show()
    {
        try {
            $setting = Setting::findOrFail(1);

            return $this->success('Setting info is retrived successfully', $setting);
        } catch (Exception $e) {
            return $this->internalServerError();
        }
    }
}
