@extends('layouts.dashboard')

@section('title')
Update Kategori Artikel
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('kategori.update', $item->id) }}" method="post">
                @csrf
                @method('PUT')
                <input type="text" class="form-control" name="nama" value="{{ $item->nama }}" placeholder="Masukan nama kategori">
                <button class="btn btn-success btn-sm mt-2">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

