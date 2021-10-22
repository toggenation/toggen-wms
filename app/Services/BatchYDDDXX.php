<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class BatchYDDDXX implements Batch
{

    /**
     * Undocumented variable
     *
     * @var integer
     */
    private static $end;


    public function __construct()
    {
        self::$end = config('toggen.batch.ydddxx.end');
    }
    public static function generate()
    {
        $now = Carbon::now('Australia/Melbourne');
        $year = $now->format('Y');
        $ordinal = sprintf('%03d', $now->format('z'));
        return self::formatted($year, $ordinal, self::$end);
    }



    public static function formatted($year, $day, $end)
    {

        for ($i = 1; $i <= $end; $i++) {
            $batch = sprintf('%02d', $i);
            $batches[] = [
                'batch' => $year % 10 . $day . sprintf('%02d', $i),
                'description' => join(' - ', [$year, $day, $batch])
            ];
        }


        return $batches;
    }
}
