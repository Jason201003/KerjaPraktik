<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // Method untuk memuat semua data kamar
    public function loadAllKamars() 
    {
        $all_kamars = Kamar::all();
        return view('kelola-kamar.index', compact('all_kamars'));
    }

    // Method untuk memuat form tambah kamar
    public function loadAddKamarForm()
    {
        $jenis_kamars = ['Superior', 'Deluxe']; // Daftar jenis kamar
        $tipe_beds = ['queen', 'king', 'twin']; // Daftar tipe bed
        return view('kelola-kamar.add-kamar', compact('jenis_kamars', 'tipe_beds'));
    }

    // Method untuk menambah kamar baru
    public function AddKamar(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'jenis_kamar' => 'required|string',
            'kapasitas' => 'required|numeric',
            'tipe_bed' => 'required|string',
            'harga' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
        ]);

        try {
            // Membuat objek kamar baru
            $new_kamar = new Kamar;
            $new_kamar->jenis_kamar = $request->jenis_kamar;
            $new_kamar->kapasitas = $request->kapasitas;
            $new_kamar->tipe_bed = $request->tipe_bed;
            $new_kamar->harga = $request->harga;
            $new_kamar->fasilitas = $request->fasilitas;
            $new_kamar->save();

            return redirect('/kelola-kamar')->with('success', 'Kamar Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add-kamar')->with('fail', $e->getMessage());
        }
    }

    // Method untuk menampilkan form edit kamar
    public function loadEditForm($id)
    {
        $kamar = Kamar::find($id);
        $jenis_kamars = ['Superior', 'Deluxe'];
        $tipe_beds = ['queen', 'king', 'twin'];
        return view('kelola-kamar.edit-kamar', compact('kamar', 'jenis_kamars', 'tipe_beds'));
    }

    // Method untuk mengedit data kamar
    public function EditKamar(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'jenis_kamar' => 'nullable|string',
            'kapasitas' => 'nullable|numeric',
            'tipe_bed' => 'nullable|string',
            'harga' => 'nullable|numeric',
            'fasilitas' => 'nullable|string',
        ]);

        try {
            // Update data kamar berdasarkan id
            Kamar::where('id', $request->kamar_id)->update([
                'jenis_kamar' => $request->jenis_kamar,
                'kapasitas' => $request->kapasitas,
                'tipe_bed' => $request->tipe_bed,
                'harga' => $request->harga,
                'fasilitas' => $request->fasilitas,
            ]);

            return redirect('/kelola-kamar')->with('success', 'Kamar Updated Successfully');
        } catch (\Exception $e) {
            return redirect('/edit-kamar/' . $request->kamar_id)->with('fail', $e->getMessage());
        }
    }

    // Method untuk menghapus kamar
    public function DeleteKamar($id)
    {
        try {
            Kamar::where('id', $id)->delete();
            return redirect('/kelola-kamar')->with('success', 'Kamar Deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/kelola-kamar')->with('fail', $e->getMessage());
        }
    }

    // Method untuk pencarian kamar
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Mencari berdasarkan jenis kamar, tipe bed, atau fasilitas
        $all_kamars = Kamar::where('jenis_kamar', 'like', "%$query%")
            ->orWhere('tipe_bed', 'like', "%$query%")
            ->orWhere('fasilitas', 'like', "%$query%")
            ->orWhere('kapasitas', 'like', "%$query%")
            ->get();

        // Return view dengan hasil pencarian
        return view('kelola-kamar.index', compact('all_kamars'));
    }
}
