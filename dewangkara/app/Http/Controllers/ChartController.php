<?php

namespace App\Http\Controllers;

use App\Charts\AnalisisChart;
use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pengajuan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ChartController extends Controller
{
    public function showChart()
    {
        $chart = new AnalisisChart();
        $currentYear = Carbon::now()->year;
        $isEmpty = true;
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        if (Auth::user()->hasRole('cover-patner')) {
            $userId = Auth::user()->id;
            $datasets = [];
            $pengajuanData = Pengajuan::where('is_active', 'accepted')->where('created_by', $userId)->get();
            foreach ($pengajuanData as $pengajuan) {
                $nominals = [];
                foreach ($months as $month) {
                    // Query to get the nominal for this pengajuan and month

                    $nominal = Pembayaran::where('user_id', $userId)
                        ->whereYear('tanggal_pembayaran', $currentYear)
                        ->whereMonth('tanggal_pembayaran', Carbon::parse($month)->month)
                        ->sum('nominal_pembayaran');
                    $nominals[] = $nominal;
                }
                $label = 'Pendapatan - ' . $currentYear;
                if (!empty($nominals)) {
                    $isEmpty = false; // If any data exists, set isEmpty to false
                }
            }
            $chart->labels($bulan);
            if ($isEmpty) {
                // Set default data for the chart (you can customize this as needed)
                $defaultData = [0, 0, 0, 0]; // Assuming 4 months for example
                $defaultLabel = "No Data Available";

                $chart->customDataset($defaultLabel, $defaultData, '#ccc'); // Use a default color
            } else {
                $chart->customDataset($label, $nominals, '#9900ff'); // Random color for each dataset
            }
        }
        if (Auth::user()->hasRole('super-admin')) {
            // $userId = Auth::user()->id;
            $datasets = [];
            $pengajuanData = Pengajuan::where('is_active', 'accepted')->get();
            foreach ($pengajuanData as $pengajuan) {
                $nominals = [];
                foreach ($months as $month) {
                    // Query to get the nominal for this pengajuan and month
                    $nominal = Pembayaran::whereYear('tanggal_pembayaran', $currentYear)
                        ->whereMonth('tanggal_pembayaran', Carbon::parse($month)->month)
                        ->sum('nominal_pembayaran');

                    $nominals[] = $nominal;
                }
                $label = 'Pembayaran - ' . $currentYear;
                if (!empty($nominals)) {
                    $isEmpty = false; // If any data exists, set isEmpty to false
                }
            }
            $chart->labels($bulan);
            if ($isEmpty) {
                // Set default data for the chart (you can customize this as needed)
                $defaultData = [0, 0, 0, 0]; // Assuming 4 months for example
                $defaultLabel = "No Data Available";

                $chart->customDataset($defaultLabel, $defaultData, '#ccc'); // Use a default color
            } else {
                $chart->customDataset($label, $nominals, '#9900ff'); // Random color for each dataset
            }
        }
        return view('pages.pembayaran-cover.analisispendapatan', compact('chart'));
    }
}
