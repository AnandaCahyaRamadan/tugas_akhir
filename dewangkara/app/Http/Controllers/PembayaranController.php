<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Channel;
use App\Models\Pembayaran;
use App\Models\Pembayarans_Channels;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->is('dashboard/pembayaran/cover-patner*')) {
            $pengajuan = Pengajuan::select('created_by', DB::raw('max(created_at) as latest_created_at'))
                ->where('is_active', 'accepted')
                ->groupBy('created_by')
                ->get();
            return view('pages.pembayaran-cover.index', compact('pengajuan'));
        }
    }

    public function riwayat(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pembayaran = Pembayaran::where('user_id', $decryptedId)->get();
        $channels = Channel::where('user_id', $decryptedId)->get();
        // dd($pembayaran);
        return view('pages.pembayaran-cover.riwayat', compact('pembayaran', 'channels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pembayaran = Pengajuan::where('created_by', $decryptedId)->first();
        $channels = Channel::where('user_id', $decryptedId)->get();
        return view('pages.pembayaran-cover.create', compact('pembayaran', 'channels'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // Validasi input yang diterima dari form
        $request->validate(
            [
                'user_id' => 'required',
                'tanggal_pembayaran' => 'required|date',
                'nominal_pembayaran' => 'required|numeric',
                'bukti_pembayaran' => 'nullable|image|mimes:jpeg,jpg|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
                'detail_pembayaran' => 'nullable|file|mimes:pdf|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
                'rincian_pembayaran' => 'nullable|file|mimes:csv,txt|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
            ],
            [
                'user_id.required' => 'Kolom user id wajib di isi.',
                'tanggal_pembayaran.required' => 'Kolom tanggal pembayaran wajib diisi.',
                'nominal_pembayaran.required' => 'Kolom nominal pembayaran wajib diisi.',
                'nominal_pembayaran.numeric' => 'Nominal pembayaran harus berupa angka.',
                'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa file gambar.',
                'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan ekstensi: jpeg, jpg.',
                'bukti_pembayaran.max' => 'Ukuran bukti pembayaran maksimal 2 MB.',
                'detail_pembayaran.file' => 'Detail pembayaran harus berupa file.',
                'detail_pembayaran.mimes' => 'Detail pembayaran harus berupa file dengan ekstensi: pdf.',
                'detail_pembayaran.max' => 'Ukuran Detail pembayaran maksimal 2 MB.',
                'rincian_pembayaran.file' => 'Rincian pembayaran harus berupa file.',
                'rincian_pembayaran.mimes' => 'Rincian pembayaran harus berupa file dengan ekstensi: csv.',
                'rincian_pembayaran.max' => 'Ukuran rincian pembayaran maksimal 2 MB.',
            ]
        );

        // Buat objek Pembayaran dan simpan ke database
        if ($request->file('bukti_pembayaran')) {
            $bukti_pembayaran = $request->file("bukti_pembayaran")->store("bukti_pembayaran");
        } else {
            $bukti_pembayaran = null;
        }
        if ($request->file('detail_pembayaran')) {
            $detail_pembayaran = $request->file("detail_pembayaran")->store("detail_pembayaran");
        } else {
            $detail_pembayaran = null;
        }
        if ($request->file('rincian_pembayaran')) {
            $rincian_pembayaran = $request->file("rincian_pembayaran")->store("rincian_pembayaran");
        } else {
            $rincian_pembayaran = null;
        }
        if ($bukti_pembayaran && $rincian_pembayaran && $detail_pembayaran) {
            $status = 'success';
        } else {
            $status = 'pending';
        }
        $pembayaran = new Pembayaran([
            'user_id' => $request->input('user_id'),
            'status' => $status,
            'tanggal_pembayaran' => $request->input('tanggal_pembayaran'),
            'nominal_pembayaran' => $request->input('nominal_pembayaran'),
            'bukti_pembayaran' => $bukti_pembayaran,
            'detail_pembayaran' => $detail_pembayaran,
            'rincian_pembayaran' => $rincian_pembayaran,
        ]);

        $pembayaran->save();
        if (!empty($request->channels)) {
            foreach ($request->channels as $channel) {
                $newChannel = new Pembayarans_Channels;
                $newChannel->create([
                    'pembayaran_id' => $pembayaran->id,
                    'channel_id' => $channel,
                ]);
            }
        } else {
            // return redirect()->back()->with('error', 'Pastikan pilih link channel youtube')->withInput();
        }

        return redirect()->route('pembayaran_cover_patner.riwayat', Crypt::encryptString($request->input('user_id')))->with('success', 'Pembayaran berhasil disimpan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $decryptedId = Crypt::decryptString($id);
        // $pengajuan = Pembayaran::where('pengajuan_id', $id)->get();
        $pembayaran = Pembayaran::where('id', $decryptedId)->first();
        return view('pages.pembayaran-cover.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decryptedId = Crypt::decryptString($id);
        $pembayaran = Pembayaran::findOrFail($decryptedId);
        $pembayarans_channels = Pembayarans_Channels::where('pembayaran_id', $pembayaran->id)->get();
        $channels = Channel::where('user_id', $pembayaran->user_id)->get();
        return view('pages.pembayaran-cover.edit', compact('pembayaran', 'pembayarans_channels', 'channels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePembayaranRequest  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        // Validasi input yang diterima dari form
        $request->validate(
            [
                'user_id' => 'required',
                'tanggal_pembayaran' => 'required|date',
                'nominal_pembayaran' => 'required|numeric',
                'bukti_pembayaran' => 'nullable|image|mimes:jpeg,jpg|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
                'detail_pembayaran' => 'nullable|file|mimes:pdf|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
                'rincian_pembayaran' => 'nullable|file|mimes:csv,txt|max:2048', // Sesuaikan dengan aturan validasi yang Anda butuhkan
            ],
            [
                'user_id.required' => 'Kolom user id wajib di isi.',
                'tanggal_pembayaran.required' => 'Kolom tanggal pembayaran wajib diisi.',
                'nominal_pembayaran.required' => 'Kolom nominal pembayaran wajib diisi.',
                'nominal_pembayaran.numeric' => 'Nominal pembayaran harus berupa angka.',
                'bukti_pembayaran.image' => 'Bukti pembayaran harus berupa file gambar.',
                'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan ekstensi: jpeg, jpg.',
                'bukti_pembayaran.max' => 'Ukuran bukti pembayaran maksimal 2 MB.',
                'detail_pembayaran.file' => 'Detail pembayaran harus berupa file.',
                'detail_pembayaran.mimes' => 'Detail pembayaran harus berupa file dengan ekstensi: pdf.',
                'detail_pembayaran.max' => 'Ukuran Detail pembayaran maksimal 2 MB.',
                'rincian_pembayaran.file' => 'Rincian pembayaran harus berupa file.',
                'rincian_pembayaran.mimes' => 'Rincian pembayaran harus berupa file dengan ekstensi: csv.',
                'rincian_pembayaran.max' => 'Ukuran rincian pembayaran maksimal 2 MB.',
            ]
        );

        // Mengambil data pembayaran yang akan diupdate
        $pembayaran = Pembayaran::findOrFail($id);

        // Jika ada file bukti pembayaran yang diunggah, simpan file tersebut
        if ($request->hasFile('bukti_pembayaran')) {
            if ($pembayaran->bukti_pembayaran) {
                Storage::delete($pembayaran->bukti_pembayaran);
            }
            $bukti_pembayaran = $request->file("bukti_pembayaran")->store("bukti_pembayaran");
        } else {
            $bukti_pembayaran = $pembayaran->bukti_pembayaran;
        }

        // Jika ada file rincian pembayaran yang diunggah, simpan file tersebut
        if ($request->hasFile('detail_pembayaran')) {
            if ($pembayaran->detail_pembayaran) {
                Storage::delete($pembayaran->detail_pembayaran);
            }
            $detail_pembayaran = $request->file("detail_pembayaran")->store("detail_pembayaran");
        } else {
            $detail_pembayaran = $pembayaran->detail_pembayaran;
        }
        if ($request->hasFile('rincian_pembayaran')) {
            if ($pembayaran->rincian_pembayaran) {
                Storage::delete($pembayaran->rincian_pembayaran);
            }
            $rincian_pembayaran = $request->file("rincian_pembayaran")->store("rincian_pembayaran");
        } else {
            $rincian_pembayaran = $pembayaran->rincian_pembayaran;
        }

        // Menentukan status berdasarkan keberadaan file-file yang diunggah
        if ($bukti_pembayaran && $rincian_pembayaran && $detail_pembayaran) {
            $status = 'success';
        } else {
            $status = 'pending';
        }

        // Mengupdate data pembayaran
        $pembayaran->user_id = $request->input('user_id');
        $pembayaran->status = $status;
        $pembayaran->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $pembayaran->nominal_pembayaran = $request->input('nominal_pembayaran');
        $pembayaran->bukti_pembayaran = $bukti_pembayaran;
        $pembayaran->detail_pembayaran = $detail_pembayaran;
        $pembayaran->rincian_pembayaran = $rincian_pembayaran;
        $pembayaran->save();
        if (!empty($request->channels)) {
            $channels = Pembayarans_Channels::where('pembayaran_id', $pembayaran->id);
            if ($channels) {
                $channels->delete();
                foreach ($request->channels as $channel) {
                    $newChannel = new Pembayarans_Channels;
                    $newChannel->create([
                        'pembayaran_id' => $pembayaran->id,
                        'channel_id' => $channel,
                    ]);
                }
            }
        } else {
            // return redirect()->back()->with('error', 'Pastikan pilih link channel youtube')->withInput();
        }

        return redirect()->route('pembayaran_cover_patner.riwayat', Crypt::encryptString($request->input('user_id')))->with('success', 'Pembayaran berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->bukti_pembayaran) {
            Storage::delete($pembayaran->bukti_pembayaran);
        }

        if ($pembayaran->detail_pembayaran) {
            Storage::delete($pembayaran->detail_pembayaran);
        }
        if ($pembayaran->rincian_pembayaran) {
            Storage::delete($pembayaran->rincian_pembayaran);
        }
        $channels = Pembayarans_Channels::where('pembayaran_id', $pembayaran->id);
        $channels->delete();
        $pembayaran->delete();
        return redirect()->route('pembayaran_cover_patner.riwayat', Crypt::encryptString($pembayaran->user_id))->with('success', 'Riwayat pembayaran berhasil dihapus');
    }}
