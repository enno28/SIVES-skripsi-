@extends("layouts.master_verifikator")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Tahun Ajaran {{$konfigurasi->tahun1}}/{{$konfigurasi->tahun2}}
        </li>
        <li class="breadcrumb-item">Semester {{$konfigurasi->periode}}</li>
      </ol>

<!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5">{{$mata_kuliah}} Mata Kuliah</div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
              <div class="mr-5">43 Verifikasi</div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-support"></i>
              </div>
              <div class="mr-5">{{$jumlah_jadwal}} Jadwal Ujian</div>
            </div>
          </div>
        </div>
      </div>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar Jadwal Ujian</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Mata Kuliah</th>
                  <th>Hari/Tanggal</th>
                  <th>Jam Ujian</th>
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
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection