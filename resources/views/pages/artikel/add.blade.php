@extends('layouts.dashboard')

@section('title')
Tambah Artikel 
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('artikel.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <label for="exampleDataList" class="form-label">Penulis</label>
                    <input required class="form-control" name="user_id" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        @foreach ($penulis as $item)
                        <option  value="{{ $item->email }}">{{ $item->name }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-8">
                    <label for="">Judul</label>
                    <input required value="{{ old('judul') }}" type="text" class="form-control" name="judul">
                </div>
                <div class="col-md-8">
                    <label for="">Kategori</label>
                    <select name="category_id" required id="" class="form-select">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                    <label for="">Image</label>
                    <input required  type="file" class="form-control" name="image" class="image">
                </div>
                <div class="col-md-8">
                    <label for="">Status</label>
                    <select name="publish" id="" required class="form-select">
                        <option value="yes">Published</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="col-md-8 mt-5">
                    <label for="">Tulisan</label>
                    <textarea name="body">{{ old('body') }}</textarea>
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
<script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
<script>
        CKEDITOR.replace('body',{
            toolbarGroups: [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
                { name: 'forms' },
                '/',
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'links' },
                // { name: 'insert' },
                '/',
                { name: 'styles' },
                { name: 'colors' },
                { name: 'tools' },
                { name: 'others' },
                { name: 'about' }
            ]

            // NOTE: Remember to leave 'toolbar' property with the default value (null).
        });
</script>
@endpush

{{--  --}}