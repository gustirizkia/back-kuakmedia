@extends('layouts.dashboard')

@section('title')
Artikel
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a href="{{ route('artikel.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="col-md-4">
                <form action="{{ route('artikel.index') }}?q=">
                    <input type="text" class="form-control" placeholder="Cari Artikel" name="q" value="{{ $q }}">
                </form>
            </div>
        </div>
        <table class="table table-hover table-xs" style="font-size: 14px">
            <thead>
                <tr>
                    <th scope="col">Penulis</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Pembuatan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                <tr>
                    <th scope="row">{{ $item->penulis->name }}</th>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->kategori->nama }}</td>
                    <td>{{ $item->publish === 'yes' ? 'Publish' : '' }} {{ $item->publish === 'pending' ? 'Pending' : ''
                        }}
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td class="d-flex">
                        <a href="{{ route('artikel.edit', $item->id) }}" class="btn btn-link text-success "><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('artikel.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger" onclick="return confirm('Hapus artikel ?')"
                                style="margin-left: 5px">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                @empty

                @endforelse
            </tbody>
        </table>
        {{ $items->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

@push('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@endpush
