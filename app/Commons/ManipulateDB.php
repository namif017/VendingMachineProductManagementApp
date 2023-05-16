<?php

namespace App\Commons;

use Illuminate\Support\Facades\DB;

class ManipulateDB
{
    public static function manipulateDB($func) {
        DB::beginTransaction();

        try {
            $func();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return back();
        }
    }
}
