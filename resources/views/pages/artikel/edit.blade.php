@extends('layouts.dashboard')

@section('title')
Edit Artikel {{ $artikel->judul }}

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('artikel.update', $artikel->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <img src="{{ $artikel->image }}" class="img-fluid" style="width: 100px">
                </div>
                <div class="col-md-3">
                    <label for="">Penulis</label>
                    <input type="text" class="form-control" readonly value="{{ $artikel->penulis->name }}">
                </div>
                <div class="col-md-3">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="judul" value="{{ $artikel->judul }}">
                </div>
                <div class="col-md-3">
                    <label for="">Kategori</label>
                    <select name="category_id" class="form-select" >
                        <option value="">Pilih Kategori</option>
                        @forelse ($kategori as $item)
                            <option value="{{ $item->id }}" {{ $category_id === $item->id ? 'selected' :'' }}>{{ $item->nama }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>
    
                <div class="col-md-3">
                    <label for="">Status</label>
                    <select name="publish" class="form-select">
                        <option value="">Pilih Status</option>
                        <option value="yes" {{ $artikel->publish === 'yes' ? 'selected' : '' }}>Published</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
    
                <div class="col-md-12 mt-5">
                    <label for="">Tulisan</label>
                    <textarea name="editor1">{!! $artikel->body !!}</textarea>
                </div>

                <div class="col-md-12 mt-3">
                    <button class="btn btn-success">Simpan</button>
                </div>
                
            </div>

        </form>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/4.19.1/full/ckeditor.js"></script>
<script>
        CKEDITOR.replace('editor1',{
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