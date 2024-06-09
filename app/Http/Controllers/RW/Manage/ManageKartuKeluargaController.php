<?php

namespace App\Http\Controllers\RW\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\KartuKeluargaModel;
use App\Models\RukunTetanggaModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use PDOException;

class ManageKartuKeluargaController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function manageKartuKeluargaPage()
    {
        $query = request()->q;
        $paginate = request()->paginate ?? 10;
        $filters = request()->filters ?? [];

        $kartuKeluargaInstances = (new SearchableDecorator(KartuKeluargaModel::class))->search($query, $paginate, [], $filters);
        $rukunTetanggaOptions = [];

        RukunTetanggaModel::all()->map(function ($row) use (&$rukunTetanggaOptions) {
            $rukunTetanggaOptions[$row['nomor_rukun_tetangga']] = $row['id_rukun_tetangga'];
        });

        $count = KartuKeluargaModel::count();

        $data = [
            "kartuKeluargaInstances" => $kartuKeluargaInstances,
            "rukunTetanggaOptions" => $rukunTetanggaOptions,
            "count" => $count
        ];

        return view('pages.rw.manage.kartuKeluarga', $data);
    }

    public function addNewKartuKeluarga()
    {
        request()->validate([
            'nkk' => 'required|max:16',
            'alamat' => 'required',
            'id_rukun_tetangga' => 'required',
            'tagihan_listrik_per_bulan' => 'required',
            'jumlah_pekerja' => 'required',
            'total_penghasilan_per_bulan' => 'required',
            'total_pajak_per_tahun' => 'required',
            'tagihan_air_per_bulan' => 'required',
            'total_kendaraan_dimiliki' => 'required',
        ]);

        $data = [
            'nkk' => request()->nkk,
            'alamat' => request()->alamat,
            'id_rukun_tetangga' => request()->id_rukun_tetangga,
            'tagihan_listrik_per_bulan' => request()->tagihan_listrik_per_bulan,
            'jumlah_pekerja' => request()->jumlah_pekerja,
            'total_penghasilan_per_bulan' => request()->total_penghasilan_per_bulan,
            'total_pajak_per_tahun' => request()->total_pajak_per_tahun,
            'tagihan_air_per_bulan' => request()->tagihan_air_per_bulan,
            'total_kendaraan_dimiliki' => request()->total_kendaraan_dimiliki,
        ];

        $newKartuKeluarga = KartuKeluargaModel::create($data);

        if (!$newKartuKeluarga) {
            session()->flash('danger', ['title' => 'Gagal menambahkan kartu keluarga baru.', 'description' => 'Gagal menambahkan kartu keluarga baru.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil menambahkan kartu keluarga baru.', 'description' => 'Berhasil menambahkan kartu keluarga baru.']);
        }

        return 'completed';
    }

    public function importCSV()
    {
        request()->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);

        $csv = request()->file('csv');

        $csvData = array_map('str_getcsv', file($csv));

        $header = array_map('strtolower', $csvData[0]);

        $csvData = array_slice($csvData, 1);

        $data = [];

        foreach ($csvData as $row) {
            $data[] = array_combine($header, $row);
        }

        $rukunTetanggaInstances = [];

        RukunTetanggaModel::all()->each(function ($row) use (&$rukunTetanggaInstances) {
            $rukunTetanggaInstances[$row['nomor_rukun_tetangga']] = $row['id_rukun_tetangga'];
        });

        $newKartuKeluargaInstances = [];

        $i = 1;
        foreach ($data as $row) {
            $validate = Validator::make($row, [
                'nkk' => 'required|max:16',
                'alamat' => 'required',
                'rt' => 'required',
                'tagihan_listrik_per_bulan' => 'required',
                'jumlah_pekerja' => 'required',
                'total_penghasilan_per_bulan' => 'required',
                'total_pajak_per_tahun' => 'required',
                'tagihan_air_per_bulan' => 'required',
                'total_kendaraan_dimiliki' => 'required',
            ]);

            if ($validate->fails()) {
                $description = '';
                foreach ($validate->errors()->all() as $error) {
                    $description .= $error . ' ';
                }
                session()->flash('danger', [
                    'title' => sprintf('Gagal mengimport kartu keluarga pada baris %d', $i),
                    'description' => $description
                ]);
                return redirect()->route('rw.manage.pendataan.kartuKeluarga.kartuKeluarga');
            }

            $isRukunTetanggaExists = array_key_exists($row['rt'], $rukunTetanggaInstances);

            if (!$isRukunTetanggaExists) {
                session()->flash('danger', [
                    'title' => sprintf('Gagal mengimport kartu keluarga pada baris %d', $i),
                    'description' => 'Nomor rukun tetangga tidak ditemukan.'
                ]);
                return redirect()->route('rw.manage.pendataan.kartuKeluarga.kartuKeluarga');
            }

            array_push($newKartuKeluargaInstances, [
                'nkk' => $row['nkk'],
                'alamat' => $row['alamat'],
                'id_rukun_tetangga' => $rukunTetanggaInstances[$row['rt']],
                'tagihan_listrik_per_bulan' => $row['tagihan_listrik_per_bulan'],
                'jumlah_pekerja' => $row['jumlah_pekerja'],
                'total_penghasilan_per_bulan' => $row['total_penghasilan_per_bulan'],
                'total_pajak_per_tahun' => $row['total_pajak_per_tahun'],
                'tagihan_air_per_bulan' => $row['tagihan_air_per_bulan'],
                'total_kendaraan_dimiliki' => $row['total_kendaraan_dimiliki'],
            ]);

            $i++;
        }

        try {
            $newKartuKeluargaInstances = KartuKeluargaModel::insert($newKartuKeluargaInstances);
        } catch (PDOException $e) {
            session()->flash('danger', [
                'title' => sprintf('Gagal mengimport kartu keluarga'),
                'description' => $e->errorInfo[2]
            ]);
            return redirect()->route('rw.manage.pendataan.kartuKeluarga.kartuKeluarga');
        }

        if (!$newKartuKeluargaInstances) {
            session()->flash('danger', ['title' => 'Gagal mengimport kartu keluarga.', 'description' => 'Gagal mengimport kartu keluarga.']);
        } else {
            session()->flash('success', ['title' => 'Berhasil mengimport kartu keluarga.', 'description' => 'Berhasil mengimport kartu keluarga.']);
        }

        return redirect()->route('rw.manage.pendataan.kartuKeluarga.kartuKeluarga');
    }

    // export
    public function exportCSV()
    {
        $kartuKeluargaInstances = KartuKeluargaModel::all();

        $csv = 'nkk,alamat,rt,tagihan_listrik_per_bulan,jumlah_pekerja,total_penghasilan_per_bulan,total_pajak_per_tahun,tagihan_air_per_bulan,total_kendaraan_dimiliki' . PHP_EOL;

        foreach ($kartuKeluargaInstances as $row) {
            
            $alamat = preg_replace("/\r|\n|,/", "", $row->getAlamat());

            $csv .= sprintf(
                '%s,%s,%s,%s,%s,%s,%s,%s,%s', 
                $row->getNkk(), 
                $alamat, 
                $row->getNomorRukunTetangga(), 
                $row->getTagihanListrikPerBulan(), 
                $row->getJumlahPekerja(), 
                $row->getTotalPenghasilanPerBulan(), 
                $row->getTotalPajakPerTahun(), 
                $row->getTagihanAirPerBulan(), 
                $row->getTotalKendaraanDimiliki()
                ) . PHP_EOL;
            }
            
            $filename = 'kartu_keluarga_' . date('Y-m-d_H-i-s') . '.csv';

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        echo $csv;
        exit();
    }

    // update kartu keluarga with validation
    public function updateKartuKeluarga()
    {
        request()->validate([
            'nkk' => 'required',
            'alamat' => 'required',
            'id_rukun_tetangga' => 'required',
            'tagihan_listrik_per_bulan' => 'required',
            'jumlah_pekerja' => 'required',
            'total_penghasilan_per_bulan' => 'required',
            'total_pajak_per_tahun' => 'required',
            'tagihan_air_per_bulan' => 'required',
            'total_kendaraan_dimiliki' => 'required',
        ]);

        $nkk = request()->nkk;
        $kartuKeluargaInstance = KartuKeluargaModel::find($nkk);

        if (!$kartuKeluargaInstance) {
            session()->flash('danger', ['title' => 'Gagal mengupdate kartu keluarga.', 'description' => 'Gagal mengupdate kartu keluarga.']);
        } else {
            $kartuKeluargaInstance->setNkk(request()->nkk);
            $kartuKeluargaInstance->setAlamat(request()->alamat);
            $kartuKeluargaInstance->setIdRukunTetangga(request()->id_rukun_tetangga);
            $kartuKeluargaInstance->setTagihanListrikPerBulan(request()->tagihan_listrik_per_bulan);
            $kartuKeluargaInstance->setJumlahPekerja(request()->jumlah_pekerja);
            $kartuKeluargaInstance->setTotalPenghasilanPerBulan(request()->total_penghasilan_per_bulan);
            $kartuKeluargaInstance->setTotalPajakPerTahun(request()->total_pajak_per_tahun);
            $kartuKeluargaInstance->setTagihanAirPerBulan(request()->tagihan_air_per_bulan);
            $kartuKeluargaInstance->setTotalKendaraanDimiliki(request()->total_kendaraan_dimiliki);

            $kartuKeluargaInstance->save();

            session()->flash('success', ['title' => 'Berhasil mengupdate kartu keluarga.', 'description' => 'Berhasil mengupdate kartu keluarga.']);
        }

        return 'done';
    }

    public function deleteKartuKeluarga()
    {

        request()->validate([
            'nkk' => 'required'
        ]);

        $nkk = request()->nkk;

        $kartuKeluargaInstance = KartuKeluargaModel::find($nkk);

        if (!$kartuKeluargaInstance) {
            session()->flash('danger', ['title' => 'Gagal menghapus kartu keluarga.', 'description' => 'Gagal menghapus kartu keluarga.']);
        } else {
            $kartuKeluargaInstance->delete();
            session()->flash('success', ['title' => 'Berhasil menghapus kartu keluarga.', 'description' => 'Berhasil menghapus kartu keluarga.']);
        }

        return 'completed';
    }
}
