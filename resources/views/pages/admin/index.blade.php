@extends('layouts.dashboard')

@section('title')
User Admin
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a href="{{ route('user.create') }}" class="btn btn-success">Tambah Data</a>
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
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tanggal di Buat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at }}
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('user.edit', $item->id) }}" class="btn btn-link text-success "><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger" onclick="return confirm('Hapus admin ?')"
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
