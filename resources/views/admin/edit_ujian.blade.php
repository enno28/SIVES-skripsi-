@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/dosen">Jadwal Ujian</a>
        </li>
        <li class="breadcrumb-item active">Edit Jadwal Ujian</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Edit Jadwal Ujian</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <form class="form-horizontal" action="{{ route('jadwal_ujian.update',$jadwal_ujian[0]->id_jadwal) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                          <label for="mata_kuliah">Mata Kuliah</label>
                            <input type="text" name="id_mk" value="{{$jadwal_ujian[0]->mata_kuliah->nama_mk}}" class="form-control" disabled="disabled">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="tanggal">Tanggal Ujian</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{$jadwal_ujian[0]->tanggal_ujian}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai" value="{{$jadwal_ujian[0]->waktu_mulai}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" id="waktu_selesai" value="{{$jadwal_ujian[0]->waktu_selesai}}" required="">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    </form>
                </table>
          </div>
        </div>
@endsection