<?php

namespace App\Http\Controllers;

use App\Models\Harian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index(Request $request)
    {
        // Get the month and year input from the user
        $month = $request->input('month');
        $year = $request->input('year');

        $query = DB::table('users')
            ->join('harian', 'harian.user_id', '=', 'users.id')
            ->select(
                'users.id',
                'users.name',
                'users.Outlet',
                'users.Target',
                DB::raw('(SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total2'),
                DB::raw('SUM(harian.Realisasi_Cair) as total'),
                DB::raw('SUM(harian.Pencairan_TopUp) as totaltu'),
                DB::raw('((SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) / Target) * 100 as percent')
            )
            ->groupBy('users.id')
            ->orderByDesc('percent');

        // Filter the data by month and year if both are provided
        if ($year && !$month) {
            // If only year is provided, multiply Target by 12
            $query->selectRaw('users.Target * 12 as Target');
            $query->addSelect(DB::raw('((SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) / (users.Target * 12)) * 100 as percent'));
        } elseif (empty($month) && empty($year)) {
            // If no month or year is provided, multiply Target by 12
            $query->selectRaw('users.Target * 12 as Target');
            $query->addSelect(DB::raw('((SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) / (users.Target * 12)) * 100 as percent'));
        } else {
            $query->selectRaw('users.Target as Target');
            $query->addSelect(DB::raw('((SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) / users.Target) * 100 as percent'));
        }

        // Filter the data by month and year if both are provided
        if ($month && $year) {
            $query->whereMonth('harian.tanggal', '=', $month)
                ->whereYear('harian.tanggal', '=', $year);
        } else if ($year) {
            // Filter the data by year if only year is provided
            $query->whereYear('harian.tanggal', '=', $year);
        }

        $userData = $query->get();

        $full = DB::table('harian')
            ->when($month && $year, function ($query) use ($month, $year) {
                return $query->whereMonth('tanggal', '=', $month)
                    ->whereYear('tanggal', '=', $year);
            })
            ->when($year && !$month, function ($query) use ($year) {
                return $query->whereYear('tanggal', '=', $year);
            })
            ->sum('Realisasi_Cair')
            + DB::table('harian')
            ->when($month && $year, function ($query) use ($month, $year) {
                return $query->whereMonth('tanggal', '=', $month)
                    ->whereYear('tanggal', '=', $year);
            })
            ->when($year && !$month, function ($query) use ($year) {
                return $query->whereYear('tanggal', '=', $year);
            })
            ->sum('Pencairan_TopUp');

        $fullto = DB::table('harian')
            ->when($month && $year, function ($query) use ($month, $year) {
                return $query->whereMonth('tanggal', '=', $month)
                    ->whereYear('tanggal', '=', $year);
            })
            ->when($year && !$month, function ($query) use ($year) {
                return $query->whereYear('tanggal', '=', $year);
            })
            ->sum('Pencairan_TopUp');

        $totalpb = DB::table('harian')
            ->when($month && $year, function ($query) use ($month, $year) {
                return $query->whereMonth('tanggal', '=', $month)
                    ->whereYear('tanggal', '=', $year);
            })
            ->when($year && !$month, function ($query) use ($year) {
                return $query->whereYear('tanggal', '=', $year);
            })
            ->sum('Realisasi_Cair');

        $totaltj = DB::table('users')
            ->join('harian', 'harian.user_id', '=', 'users.id')
            ->when($month && $year, function ($query) use ($month, $year) {
                return $query->whereMonth('tanggal', '=', $month)
                    ->whereYear('tanggal', '=', $year);
            })
            ->when($year && !$month, function ($query) use ($year) {
                return $query->whereYear('tanggal', '=', $year);
            })
            ->when($month && $year, function ($query) {
                return $query->select(DB::raw('DISTINCT users.name, users.Target'))
                    ->sum('users.Target');
            }, function ($query) {
                return $query->select(DB::raw('DISTINCT users.name, users.Target'))
                    ->sum('users.Target') * 12;
            });



        return view('data.index', compact('userData', 'full', 'fullto', 'totalpb', 'month', 'year', 'totaltj'));
    }



    public function create(Request $request)
    {
        \App\Models\Data::create($request->all());
        return redirect('/data')->with('Sukses', 'Data berhasil di input!');
    }

    public function edit($data)
    {
        $data = \App\Models\Data::find($data);
        return view('data.edit', ['data' => $data]);
    }

    public function update(Request $request, $data)
    {
        $data = \App\Models\Data::find($data);
        $data->update($request->all());
        return redirect('/data')->with('Sukses', 'Data Berhasil diupdate');
    }

    public function delete($data)
    {
        $data = \App\Models\Data::find($data);
        $data->delete();
        return redirect('/data')->with("Sukses", 'Data berhasil dihapus');
    }

    public function grafik(Request $request)
    {
        if ($request->method() == 'GET') {
            $month = $request->input('month');
            $year = $request->input('year');

            // Retrieve data and render view
            $query = DB::table('users')
                ->join('harian', 'harian.user_id', '=', 'users.id')
                ->select(
                    'users.name',
                    'users.Target',
                    DB::raw('YEAR(harian.created_at) as year'),
                    DB::raw('(SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total')
                )
                ->groupBy('year', 'users.name', 'users.Target')
                ->orderBy('total', 'desc')
                ->orderBy('year');


            if ($month && $year) {
                $query->where(DB::raw('DATE_FORMAT(harian.tanggal, "%m-%Y")'), '=', $month . '-' . $year);
            } elseif ($year) {
                // If only filtering by year, multiply target by 12
                $query->where(DB::raw('YEAR(harian.tanggal)'), '=', $year);
                $targetMultiplier = ($month) ? 1 : 12;
                $query->selectRaw('users.name, ?, (SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total', [$targetMultiplier * $year]);
            }

            $query2 = DB::table('users')
                ->join('harian', 'harian.user_id', '=', 'users.id')
                ->join('cabang', 'cabang.nama_cabang', '=', 'users.Outlet')
                ->select(
                    'users.Outlet',
                    'cabang.Target',
                    DB::raw('YEAR(harian.created_at) as year'),
                    DB::raw('(SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total2')
                )
                ->groupBy('year', 'users.Outlet', 'cabang.Target')
                ->orderBy('total2', 'desc')
                ->orderBy('year');

            if ($month && $year) {
                $query2->where(DB::raw('DATE_FORMAT(harian.tanggal, "%m-%Y")'), '=', $month . '-' . $year);
            } elseif ($year) {
                // If only filtering by year, multiply target by 12
                $query2->where(DB::raw('YEAR(harian.tanggal)'), '=', $year);
                $targetMultiplier = ($month) ? 1 : 12;
                $query2->selectRaw('users.Outlet, cabang.Target * ?, (SUM(harian.Realisasi_Cair) + SUM(harian.Pencairan_TopUp)) as total2', [$targetMultiplier]);
            }

            $data = $query->get();
            $data2 = $query2->get();

            $categories = [];
            $categories2 = [];
            $target = [];
            $target2 = [];
            $total = array_map(function ($data) {
                return floatval($data->total);
            }, $data->toArray());

            $total2 = array_map(function ($data2) {
                return floatval($data2->total2);
            }, $data2->toArray());

            foreach ($data as $nm) {
                $categories[] = $nm->name;
                $targetValue = ($month && $year) ? $nm->Target : $nm->Target * 12; // <-- use $targetMultiplier to calculate the target value
                $target[] = $targetValue;
            }



            foreach ($data2 as $nm2) {
                $categories2[] = $nm2->Outlet;

                // Count the number of IDs associated with this outlet
                $numIds = DB::table('users')
                    ->where('Outlet', '=', $nm2->Outlet)
                    ->count();

                // Calculate the target value based on the number of IDs
                $targetValue = ($month && $year) ? $nm2->Target : $nm2->Target * 12; // <-- use $targetMultiplier to calculate the target value
                $target2[] = $targetValue / $numIds;
            }


            return view('grafik.index', compact('categories', 'categories2', 'total', 'total2', 'target', 'target2', 'month', 'year'));
        } else {
            // Handle unsupported request method
            abort(405);
        }
    }
}
