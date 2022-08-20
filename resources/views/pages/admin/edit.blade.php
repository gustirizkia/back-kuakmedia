@extends('layouts.dashboard')

@section('title')
Tambah Admin 
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('user.update', $item->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="row justify-content-center">
                
                <div class="col-md-8">
                    <label for="">Name</label>
                    <input required value="{{ $item->name }}" type="text" class="form-control" name="name">
                </div>
                
                <div class="col-md-8">
                    <label for="">Email</label>
                    <input required readonly type="email" class="form-control" name="email" value="{{ $item->email }}" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="">Password</label>
                    <input  type="password" class="form-control" name="password" class="form-control">
                    <small>Kosongkan jika tidak ingin diubah</small>
                </div>

                <div class="col-md-8 mt-3">
                    <button class="btn btn-success btn-block">Simpan</button>
                </div>
            </div>
         </form>
    </div>
</div>
@endsection


@push('script')

@endpush



