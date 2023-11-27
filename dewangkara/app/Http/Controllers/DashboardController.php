<?php

namespace App\Http\Controllers;

use App\Charts\AnalisisChart;
use App\Http\Controllers\Controller;
use App\Models\Katalog;
use App\Models\Pembayaran;
use App\Models\Pengajuan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $chart = new AnalisisChart();
        $currentYear = Carbon::now()->year;
        $isEmpty = true;
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'December'];

        if (Auth::user()->hasRole('super-admin')) {
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

            $katalog = Katalog::count();
            $pengajuanCoverAccepted = Pengajuan::where('status', 'accepted')->count();
            $pengajuanCoverPending = Pengajuan::where('status', 'pending')->count();
            $pengajuanCoverRejected = Pengajuan::where('status', 'rejected')->count();
            $pengajuanKontenAccepted = Pengajuan::where('is_active', 'accepted')->count();
            $pengajuanKontenPending = Pengajuan::where('is_active', 'pending')->count();
            $pengajuanKontenRejected = Pengajuan::where('is_active', 'rejected')->count();
            $pembayaran = 0;

            return view('pages.dashboard.super-admin.index', compact('chart', 'katalog', 'pengajuanCoverAccepted', 'pengajuanCoverPending', 'pengajuanCoverRejected', 'pengajuanKontenAccepted', 'pengajuanKontenPending', 'pengajuanKontenRejected', 'pembayaran'));
        }
        if (Auth::user()->hasRole('publisher')) {
            $publisherId = Auth::user()->id;

            $lagudicover = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('is_active', 'accepted')
                ->distinct('katalog_id')
                ->count();

            $pengcover = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('status', 'accepted')
                ->distinct('created_by')
                ->count();

            $pengajuanCoverAccepted = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('status', 'accepted')
                ->count();

            $pengajuanCoverPending = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('status', 'pending')
                ->count();

            $pengajuanCoverRejected = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('is_active', 'rejected')
                ->count();

            $pengajuanKontenAccepted = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('is_active', 'accepted')
                ->count();

            $pengajuanKontenPending = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('is_active', 'pending')
                ->count();

            $pengajuanKontenRejected = Pengajuan::whereHas('katalog', function ($query) use ($publisherId) {
                $query->where('publisher_id', $publisherId);
            })
                ->where('is_active', 'rejected')
                ->count();

            return view('pages.dashboard.publisher.index', compact('lagudicover', 'pengcover', 'pengajuanCoverAccepted', 'pengajuanCoverPending', 'pengajuanCoverRejected', 'pengajuanKontenAccepted', 'pengajuanKontenPending', 'pengajuanKontenRejected'));
        }
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

            $user_id = Auth::user()->id;

            $pengajuanCoverAccepted = Pengajuan::where('created_by', $user_id)->where('status', 'accepted')->count();
            $pengajuanCoverPending = Pengajuan::where('created_by', $user_id)->where('status', 'pending')->count();
            $pengajuanCoverRejected = Pengajuan::where('created_by', $user_id)->where('status', 'rejected')->count();
            $pengajuanKontenAccepted = Pengajuan::where('created_by', $user_id)->where('is_active', 'accepted')->count();
            $pengajuanKontenPending = Pengajuan::where('created_by', $user_id)->where('is_active', 'pending')->count();
            $pengajuanKontenRejected = Pengajuan::where('created_by', $user_id)->where('is_active', 'rejected')->count();
            $pembayaran = 0;
            return view('pages.dashboard.cover-patner.index', compact('chart', 'pengajuanCoverAccepted', 'pengajuanCoverPending', 'pengajuanCoverRejected', 'pengajuanKontenAccepted', 'pengajuanKontenPending', 'pengajuanKontenRejected', 'pembayaran'));
        }
    }
}
