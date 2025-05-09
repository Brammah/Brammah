<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait RecordAction
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->created_by = Auth::id() ?? 1;

            if (is_null($model->branch_id)) {
                $model->branch_id = Auth::user()->branch_id ?? null;
            }
        });

        self::updating(function ($model) {
            $model->updated_by = Auth::id();

            if (is_null($model->branch_id)) {
                $model->branch_id = Auth::user()->branch_id ?? null;
            }
        });
    }
}