@extends('layouts.dashboard')

@section('title')
Tambah Admin 
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row justify-content-center">
                
                <div class="col-md-8">
                    <label for="">Name</label>
                    <input required value="{{ old('name') }}" type="text" class="form-control" name="name">
                </div>
                
                <div class="col-md-8">
                    <label for="">Email</label>
                    <input required  type="email" class="form-control" name="email" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="">Password</label>
                    <input required  type="password" class="form-control" name="password" class="form-control">
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



