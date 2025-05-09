<?php

namespace App\Http\Services;

use App\Models\SalesRepresentative;
use Illuminate\Support\Facades\DB;

class CreateAsSalesRepresentativeService
{
    public static function create($user)
    {
        return DB::transaction(function () use ($user) {
            SalesRepresentative::updateOrCreate(
                [
                    'name' => $user->full_name,
                ],
                [
                    'branch_id' => $user->branch_id,
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'gender' => $user->gender,
                ]);
        });
    }
}