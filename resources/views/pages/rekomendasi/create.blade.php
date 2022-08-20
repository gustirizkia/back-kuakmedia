@extends('layouts.dashboard')

@section('title')
Tambah Artikel Rekomendasi
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('rekomendasi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Penulis</label>
                    <input required class="form-control" name="slug" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        @foreach ($artikel as $item)
                        <option  value="{{ $item->slug }}">{{ $item->judul }}</option>
                        @endforeach
                    </datalist>
                </div>

                <div class="col-md-8 mt-3">
                    <button class="btn btn-success btn-block">Simpan</button>
                </div>
            </div>
         </form>
    </div>
</div>
@endsection