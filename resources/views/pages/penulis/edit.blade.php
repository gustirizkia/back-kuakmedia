@extends('layouts.dashboard')

@section('title')
Tambah Penulis
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('penulis.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <label for="">Nama</label>
                    <input type="text" required class="form-control" name="name" value="{{ $item->name }}">
                </div>
                <div class="col-md-7">
                    <label for="">Email</label>
                    <input type="email" required class="form-control" name="email" value="{{ $item->email }}">
                </div>
                <div class="col-md-7">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image">
                    <p>Kosongkan jika tidak ingin di ubah</p>
                </div>
                <div class="col-md-7">
                    <label for="">Pekerjaan</label>
                    <input type="text" required class="form-control" name="job_title" value="{{ $item->job_title }}">
                </div>
                <div class="col-md-7">
                    <label for="">Bio</label>
                    <input type="text" required class="form-control" name="bio" value="{{ $item->bio }}">
                </div>
                <div class="col-md-7">
                    <label for="">Password</label>
                    <input type="password" required class="form-control" name="password">
                    <p>Kosongkan jika tidak ingin di ubah</p>
                </div>
                <div class="col-md-7 mt-3">
                    <button class="btn btn-success">Tambah Data</button>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection

