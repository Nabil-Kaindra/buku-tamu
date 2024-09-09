@extends ('includes.master')

@section('content')
<div class="card">
  <h5 class="card-header">Data Tamu</h5>
  <div class="table-responsive text-nowrap m-4">
    <table id="example" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Tamu</th>
          <th>Gambar</th>
          <th>Jenis Kelamin</th>
          <th>Asal</th>
          <th>No Hp</th>
          <th>Tujuan</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tamu as $tamu)
        <tr>
          <td>{{$tamu->id}}</td>
          <td>{{$tamu->nama_tamu}}</td>
          <td>{{$tamu->gambar}}</td>
          <td>{{$tamu->jenis_kelamin}}</td>
          <td>{{$tamu->asal}}</td>
          <td>{{$tamu->nohp}}</td>
          <td>{{$tamu->tujuan}}</td>
          <td>{{$tamu->keterangan}}</td>
          <td>{{$tamu->tanggal}}</td>
          <td>
            <form action="{{route('bulanan.destroy',$tamu->id)}}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i><span class="ml-1">Delete</span></button>
            </form>
          </td>
        </tr>
        @endforeach
  </div>
</div>
@endsection