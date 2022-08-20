@extends('layouts.dashboard')

@section('title')
Tambah Sub Kategori Artikel
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('kategori.store') }}" method="post">
                @csrf
                <label for="">Nama Kategori</label>
                <input type="text" class="form-control" value="{{ $item->nama }}" readonly placeholder="Masukan nama kategori">
                <label for="">Nama Sub Kategori</label>
                <input type="text" class="form-control" required name="nama" placeholder="Masukan nama kategori">
                <input type="text" class="form-control d-none" name="sub_judul" value="{{ $item->id }}" readonly >
                <button class="btn btn-success btn-sm mt-2">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

