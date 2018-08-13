@extends("layouts.master_admin")

@section("content")
@include('flash::message')
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Jadwal Ujian</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
              <p align="right" style="padding-right: 15px">
              <a href="/jadwal_ujian/create"><button type="button" class="btn btn-success btn-sm">Tambah Jadwal Ujian</button></a>
              </p>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Mata Kuliah</th>
                  <th>Hari/Tanggal</th>
                  <th>Jam Ujian</th>
                  <th style="width: 90px">Aksi</th>
                </tr>
              </thead>
              <tbody>
              @foreach( $jadwal_ujian as $key => $show_ujian)
                <tr>
                  <td>{{++$key}}</td>
                  <td>{{$show_ujian->mata_kuliah->kode_mk}}</td>
                  <td>{{$show_ujian->mata_kuliah->nama_mk}}</td>
                  <td>{{date_format(date_create($show_ujian->tanggal_ujian), 'l, d-m-Y')}}</td>
                  <td>{{date_format(date_create($show_ujian->waktu_mulai), 'H:i')}} - {{date_format(date_create($show_ujian->waktu_selesai), 'H:i')}}</td>
                  <td>
                      <a href="{{ route('jadwal_ujian.edit',$show_ujian->id_jadwal)}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                      <form method="POST" action="{{ route('jadwal_ujian.destroy',$show_ujian->id_jadwal)}}" style="display: inline;">
                        {{ csrf_field() }}
                          <input type="hidden" name="_method" value="DELETE" />
                          <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure want to delete {{$show_ujian->mata_kuliah->kode_mk}} ?')) { return true } else {return false }";>Delete
                          </button>
                      </form>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@endsection