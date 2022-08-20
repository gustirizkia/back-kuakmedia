@extends('layouts.dashboard')

@section('title')
Penulis
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <a href="{{ route('penulis.create') }}" class="btn btn-success">Tambah Data</a>
            </div>
            <div class="col-md-4">
                <form action="{{ route('penulis.index') }}?q=">
                    <input type="text" class="form-control" placeholder="Cari Penulis" name="q" value="{{ $q }}">
                </form>
            </div>
        </div>
        <table class="table table-hover table-xs" style="font-size: 14px">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jobtitle</th>
                    <th scope="col">Jumlah Artikel</th>
                    <th scope="col">Jumlah Pengikut</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $index => $item)
                <tr>
                    <th scope="row">{{ $item->name }}</th>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->job_title }}</td>
                    <td>{{ $item->artikel_count }}
                    </td>
                    <td>{{ $item->pengikut_count }}</td>
                    <td class="d-flex">
                        <a href="{{ route('penulis.edit', $item->id) }}" class="btn btn-link text-success "><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="{{ route('penulis.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-link text-danger" onclick="return confirm('Hapus Penulis ?')"
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
