<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penjualan>
 */
class PenjualanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "id_barang" => 1,
            "nama_pembeli" => "Bobby",
            "no_hp" => "081236707010",
            "jml_barang" => 5,
            "total_harga" => 50000
        ];
    }
}
