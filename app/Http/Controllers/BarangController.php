<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Support\Facades\Response;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAllData = Barang::all();

        return Response::json(array(
            'success'       => true,
            'message'       => "All Data",
            'data'          => BarangResource::collection($getAllData)
        ), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json("Helo");
        // $startDate = Carbon::parse($request->start_date)->toDateString();
        // $endDate = Carbon::parse($request->end_date)->toDateString();

        // $getData = Penjualan::whereBetween('created_at', [$startDate, $endDate])->paginate(4);
        // return response()->json($getData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $data = $request->validated();
        $storedData = Barang::create($data);

        return response()->json($storedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $showById = Barang::findOrFail($id);
            return response()->json($showById);
        } catch (\Throwable $th) {
            return response()->json(["message" => 'Data tidak ditemukan'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBarangRequest  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, $id)
    {
        $data = $request->validated();
        Barang::findOrFail($id)->update($data);

        return response()->json(["Message" => "Data berhasil diubah"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();

        return response()->json(["message" => "Data berhasil dihapus"]);
    }
}
