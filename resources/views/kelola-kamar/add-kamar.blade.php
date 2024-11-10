<!-- resources/views/kelola-kamar/add-kamar.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kamar Baru</h2>
    
    @if(session('fail'))
        <div class="alert alert-danger">{{ session('fail') }}</div>
    @endif
    
    <form action="{{ route('AddKamar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Jenis Kamar</label>
            <select name="jenis_kamar" class="form-control" required>
                <option value="Superior">Superior (2 Orang)</option>
                <option value="Deluxe">Deluxe (4 Orang)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tipe Bed</label>
            <select name="tipe_bed" class="form-control" required>
                <option value="queen">Queen Size Bed</option>
                <option value="king">King Size Bed</option>
                <option value="twin">Twin Bed</option>
            </select>
        </div>

        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control">
        </div>

        <div class="form-group">
            <label>Fasilitas</label>
            <textarea name="fasilitas" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kamar</button>
    </form>
</div>
@endsection
