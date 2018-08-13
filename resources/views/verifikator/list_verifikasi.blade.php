@extends("layouts.master_verifikator")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Verifikasi</li>
      </ol>
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar soal yang belum diverifikasi</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Mata Kuliah</th>
                  <th>Tim Pengajar</th>
                  <th style="width: 150px">Aksi</th>
                </tr>
              </thead>
              <tbody>
              @php
                $counter = 1;
              @endphp
              @foreach( $dosen as $key => $unggah)
                @foreach($unggah->mata_kuliah->verifikasi as $soal)
                  @if($soal->status_verif == '0')
                <tr>
                  <td>{{$counter++}}</td>
                  <td>{{$unggah->mata_kuliah->kode_mk}}</td>
                  <td>{{$unggah->mata_kuliah->nama_mk}}</td>
                  <td>
                    @foreach($unggah->mata_kuliah->peran as $pengajar)
                        @if($pengajar->peran =='Pengajar') 
                          <li title="{{$pengajar->user["name"]}}">{{$pengajar->user["kode"]}}</li>
                        @endif
                    @endforeach
                  <td>
                      <form method="GET" action="{{ url('download_zip')}}" style="display: inline;">
                        {{ csrf_field() }}
                        @php
                          $ind=count($soal->versi_soal)-1;
                        @endphp
                          <input type="hidden" name="file" value="{{$soal->versi_soal[$ind]->file}}" />
                          <input type="hidden" name="bap" value="{{$soal->versi_soal[$ind]->verifikasi->id_mk}}" />
                          <button type="submit" class="btn btn-success btn-sm">Download
                          </button>
                      </form>
                      <a href="{{url('verifikasi/create',$unggah->mata_kuliah->id_mk)}}"><button type="button" class="btn btn-primary btn-sm">Verifikasi</button></a>
                  </td>
                </tr>
                @endif
                @endforeach
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection