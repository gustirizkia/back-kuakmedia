@extends('layouts.dashboard')

@section('title')
Tambah Penulis
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('penulis.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <label for="">Nama</label>
                    <input type="text" required class="form-control" name="name">
                </div>
                <div class="col-md-7">
                    <label for="">Email</label>
                    <input type="email" required class="form-control" name="email">
                </div>
                <div class="col-md-7">
                    <label for="">Image</label>
                    <input type="file" required class="form-control" name="image">
                </div>
                <div class="col-md-7">
                    <label for="">Pekerjaan</label>
                    <input type="text" required class="form-control" name="job_title">
                </div>
                <div class="col-md-7">
                    <label for="">Bio</label>
                    <input type="text" required class="form-control" name="bio">
                </div>
                <div class="col-md-7">
                    <label for="">Password</label>
                    <input type="password" required class="form-control" name="password">
                </div>
                <div class="col-md-7 mt-3">
                    <button class="btn btn-success">Tambah Data</button>
                </div>
            </div>
        </form>
        
    </div>
</div>
@endsection

