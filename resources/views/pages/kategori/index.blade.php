@extends('layouts.dashboard')

@section('title')
Kategori Artikel
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('kategori.store') }}" method="post">
                @csrf
                <input type="text" class="form-control" name="nama" required placeholder="Masukan nama kategori">
                <button class="btn btn-success btn-sm mt-2">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @forelse ($items as $item)
        <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>{{ $item->nama }}</h5>
                @foreach ($item->sub as $child)
                    <a href="{{ route('delete-sub', $item->id) }}" onclick="return confirm('Hapus sub kategori ?')" class="badge bg-primary">
                        {{ $child->nama }} X
                    </a>
                @endforeach
                <br>
                <div class="d-flex">
                    <a href="{{ route('tambah-sub', $item->id) }}" class="btn btn-link text-success mt-2"><i class="bi bi-plus-circle"></i></a>
                    <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-link text-info mt-2"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-link text-danger mt-2" onclick="return confirm('Hapus kategori ?')"
                            style="margin-left: 5px">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
        
    @endforelse
    
</div>

@endsection

@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endpush
