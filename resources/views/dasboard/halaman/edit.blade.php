@extends('dasboard.dasboard')
@section('content')
    <div class="pb-3">
        <a href="{{ route('halaman.index') }}" class="btn btn-secondary"> Back
        </a>
    </div>
    <form action="{{ route('halaman.update',$data->id) }}"method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text"
          class="form-control @error('judul') is-invalid @enderror" value="{{ $data->judul}}" name="judul" id="judul">
            @error('judul')
            <span class="invalid-feedback" >
            <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
           <textarea class="form-control @error('deskripsi') is-invalid @enderror" value="{{ old ('deskripsi') }}"
           name="deskripsi" rows="5">{{ $data->deskripsi }}</textarea>
           @error('deskripsi')
            <span class="invalid-feedback" >
            <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          @if ($data->gambar)
              <img src="{{ asset('storage/'.$data->gambar) }}" class="img-thumbnail" style="width: 50%">
          @endif
          <!--Image-->
          <div class="mb-3">
            <label for="gambar" class="form-label text-light">GAMBAR</label>
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" value="{{ $data->gambar }}" id="gambar" name="gambar"
            accept="image/*" onchange="document.getElementById('output').src = window. URL.createObjectURL(this.files[0])">
            @error('gambar')
            <span class="invalid-feedback" >
            <strong>{{ $message }}</strong>
            </span>
            @enderror
            </div>
            <div class="mt-3"><img src="" id="output" width="500"></div>
        <button class="btn btn-primary" name="simpan" type="submit">Simpan</button>
          
    </form>
    
@endsection