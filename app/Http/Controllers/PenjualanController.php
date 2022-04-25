<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Barang;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = Carbon::parse($request->start_date)->toDateString();
        $endDate = Carbon::parse($request->end_date)->toDateString();

        $getData = Penjualan::whereBetween('created_at', [$startDate, $endDate])->paginate(4);
        return response()->json($getData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenjualanRequest $request)
    {
        $data = $request->validated();
        $idBarang = Barang::where('id', $data['id_barang'])->first();

        if ($idBarang) {
            $storedData = Penjualan::create([
                'id_penjualan' => 'INV-' . time(),
                'id_barang'     => $data['id_barang'],
                'nama_pembeli'  => $data['nama_pembeli'],
                'no_hp'         => $data['no_hp'],
                'jml_barang'    => $data['jml_barang'],
                'total_harga'   => $data['jml_barang'] * $idBarang->harga_barang,
            ]);

            return response()->json($storedData, 201);
        }

        return response()->json(["message" => "Data barang tidak ditemukan"], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show($id_penjualan)
    {
        $getDataById = Penjualan::where('id_penjualan', $id_penjualan)
            ->with(['detail_barang:id,nama_barang,harga_barang'])
            ->first();

        if ($getDataById) {
            return response()->json($getDataById);
        }

        return response()->json(["message" => "Data tidak ditemukan"], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, $id)
    {
        $data = $request->validated();
        $idBarang = Barang::where('id', $data['id_barang'])->first();

        if ($idBarang) {
            Penjualan::where('id', $id)->update([
                'id_barang'     => $data['id_barang'],
                'nama_pembeli'  => $data['nama_pembeli'],
                'no_hp'         => $data['no_hp'],
                'jml_barang'    => $data['jml_barang'],
                'total_harga'   => $data['jml_barang'] * $idBarang->harga_barang,
            ]);

            return response()->json(["message" => "Data berhasil diubah"]);
        }

        return response()->json(["message" => "Data barang tidak ditemukan"], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_penjualan)
    {
        $deletedData = Penjualan::where('id_penjualan', $id_penjualan)->delete();

        if ($deletedData) {
            return response()->json(["message" => "Data berhasil dihapus"]);
        }

        return response()->json(["message" => "Data tidak ditemukan"], 404);
    }
}
