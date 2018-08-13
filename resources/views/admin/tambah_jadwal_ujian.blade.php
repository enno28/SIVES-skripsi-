@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/dosen">Jadwal Ujian</a>
        </li>
        <li class="breadcrumb-item active">Tambah Jadwal Ujian</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Tambah Jadwal Ujian</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('jadwal_ujian.store') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                          <label for="mata_kuliah">Mata Kuliah</label>
                            <select class="form-control js-example-basic-multiple" id="id_mk" name="id_mk"  required="">
                              @foreach($mata_kuliah as $mk) 
                                <option value="{{ $mk->mk }}">{{ $mk->nama_mk}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="tanggal">Tanggal Ujian</label>
                            <input type="date" name="tanggal" class="form-control" id="tanggal" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="waktu_mulai">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="waktu_selesai">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" id="waktu_selesai" required="">
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Tambah</button>
                            </div>
                        </div>
                    </form>
                </table>
          </div>
        </div>
@endsection