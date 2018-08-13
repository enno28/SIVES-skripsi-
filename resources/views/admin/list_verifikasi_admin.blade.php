@extends("layouts.master_admin")

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
                    <td title="{{$soal->user->name}}">{{$soal->user->kode}}</td>
                    <td title="{{$soal->user_verif->name}}">{{$soal->user_verif->kode}}</td>
                    <td>{{$soal->tanggal_unggah}}</td>
                    <td>
                        <button 
                          type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail" 
                          data-mk="{{$unggah->mata_kuliah->nama_mk}}" 
                          data-kode="{{$unggah->mata_kuliah->kode_mk}}"
                          data-sks="{{$unggah->mata_kuliah->bobot_sks}}"
                          data-status="{{$unggah->mata_kuliah->status_mk}}"  
                          data-koordinator="{{$unggah->mata_kuliah->user["name"]}}"
                          data-semester ="{{$unggah->mata_kuliah->periode}}"
                          {{-- data-pengajar ="{{$unggah->mata_kuliah->peran}}" --}}
                          @foreach($unggah->mata_kuliah->peran as $verif)
                            @if($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UTS') 
                              data-uts="{{$verif->user["name"]}}"
                            @elseif($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UAS') 
                              data-uas="{{$verif->user["name"]}}"
                            @endif
                          @endforeach>Detail
                        </button>
                        
                        <form method="GET" action="{{ url('download1')}}" style="display: inline;">
                          {{ csrf_field() }}
                            <input type="hidden" name="file" value="{{$soal->versi_soal->file}}" />
                            <button type="submit" class="btn btn-success btn-sm">Download
                            </button>
                        </form>
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