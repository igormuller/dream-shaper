<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getEnrollmentsByMonth()
    {
        $items = Enrollment::select(
                    DB::raw("strftime('%m', enrollment_date) as month"),
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy(DB::raw("strftime('%m', enrollment_date)"))
                ->orderBy(DB::raw("strftime('%m', enrollment_date)"))
                ->get();

        $enrollments = $this->getMonthZero();
        foreach ($items as $item) {   
            $enrollments[$item->month] = $item->total;
        }
        return array_values($enrollments);
    }

    public function getEnrollmentsByCourse()
    {
        $items = Enrollment::select('c.name', DB::raw('COUNT(*) as total'))
                ->join('courses as c', 'c.id', 'enrollments.course_id')
                ->groupBy('c.id')
                ->orderBy('c.name')
                ->get();

        return [
            'labels' => $items->pluck('name'),
            'data' => $items->pluck('total')
        ];
    }

    private function getMonthZero()
    {
        return [
            "01" => 0,
            "02" => 0,
            "03" => 0,
            "04" => 0,
            "05" => 0,
            "06" => 0,
            "07" => 0,
            "08" => 0,
            "09" => 0,
            "10" => 0,
            "11" => 0,
            "12" => 0,
        ];
    }
}
