@extends("layouts.master_pengajar")

@section("content")
<!-- Example DataTables Card-->
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6>Hasil verifikasi sesi {{$konfigurasi->verifikator}}</h6>
                </div>
                <div class="card-body">
                    <div class="default-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Pending ({{$pending}})</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Revisi ({{$revisi}})</a>
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Success ({{$success}})</a>
                            </div>
                        </nav>
                        <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>Pengirim</th>
                                        <th>Verifikator</th>
                                        <th>Tanggal Unggah</th>
                                        <th style="width: 140px">Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                      $counter = 1;
                                    @endphp
                                    @foreach( $matkul as $mk)
                                      @foreach($mk->verifikasi as $soal)
                                        @if($soal->status_verif == '0')
                                      <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{$mk->kode_mk}}</td>
                                        <td>{{$mk->nama_mk}}</td>
                                        <td title="{{$soal->versi_soal[0]->user->name}}">
                                          @php
                                            $ind=count($soal->versi_soal)-1;
                                          @endphp
                                          {{$soal->versi_soal[$ind]->user->kode}}
                                        </td>
                                        <td title="{{$soal->user_verif->name}}">{{$soal->user_verif->kode}}</td>
                                        <td>{{$soal->versi_soal[$ind]->tanggal_unggah}}</td>
                                        <td>
                                            <button 
                                              type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail" 
                                              data-mk="{{$mk->nama_mk}}" 
                                              data-kode="{{$mk->kode_mk}}"
                                              data-sks="{{$mk->bobot_sks}}"
                                              data-status="{{$mk->status_mk}}"  
                                              data-koordinator="{{$mk->user["name"]}}"
                                              data-semester ="{{$mk->periode}}"
                                              data-pengajar ="{{$mk->users}}"
                                              @foreach($mk->peran as $verif)
                                                @if($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UTS') 
                                                  data-uts="{{$verif->user["name"]}}"
                                                @elseif($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UAS') 
                                                  data-uas="{{$verif->user["name"]}}"
                                                @endif
                                              @endforeach>Detail
                                            </button>
                                            
                                            <form method="GET" action="{{ url('download1')}}" style="display: inline;">
                                              {{ csrf_field() }}
                                                <input type="hidden" name="file" value="{{$soal->versi_soal[$ind]->file}}" />
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
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-bordered dataTableClass" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>Pengirim</th>
                                        <th>Verifikator</th>
                                        <th>Tanggal Unggah</th>
                                        <th style="width: 190px">Download</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                      $counter = 1;
                                    @endphp
                                    @foreach( $dosen as $key => $unggah)
                                      @foreach($unggah->mata_kuliah->verifikasi as $soal)
                                        @if($soal->status_verif == '1')
                                      <tr>
                                        <td>{{$counter++}}</td>
                                        <td>{{$unggah->mata_kuliah->kode_mk}}</td>
                                        <td>{{$unggah->mata_kuliah->nama_mk}}</td>
                                        <td title="{{$soal->versi_soal[0]->user->name}}">
                                          @php
                                            $ind=count($soal->versi_soal)-1;
                                          @endphp
                                          {{$soal->versi_soal[$ind]->user->kode}}
                                        </td>
                                        <td title="{{$soal->user_verif->name}}">{{$soal->user_verif->kode}}</td>
                                        <td>{{$soal->versi_soal[$ind]->tanggal_unggah}}</td>
                                        <td>
                                            <form method="GET" action="{{ url('download1')}}" style="display: inline;">
                                                {{ csrf_field() }}
                                                  <input type="hidden" name="file" value="{{$soal->versi_soal[$ind]->file}}" />
                                                  <button type="submit" class="btn btn-success btn-sm">Soal
                                                  </button>
                                            </form>
                                            <a href="{{url('pdf1',$soal->versi_soal[$ind]->id_versi)}}"><button type="button" class="btn btn-success btn-sm">Hasil Verif</button>
                                            </a>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#revisi" data-verifikasi="{{$soal->versi_soal[$ind]->id_verifikasi}}" data-mk="{{$unggah->mata_kuliah->nama_mk}}" data-id_mk="{{$unggah->mata_kuliah->id_mk}}">Revisi
                                            </button>
                                        </td>
                                      </tr>
                                      @endif
                                      @endforeach
                                    @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-bordered dataTableClass" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th>Pengirim</th>
                                        <th>Verifikator</th>
                                        <th>Tanggal Unggah</th>
                                        <th style="width: 60px">Aksi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                      $counter = 1;
                                    @endphp
                                    @foreach( $dosen as $key => $unggah)
                                      @foreach($unggah->mata_kuliah->verifikasi as $soal)
                                        @if($soal->status_verif == '2')
                                          <tr>
                                            <td>{{$counter++}}</td>
                                            <td>{{$unggah->mata_kuliah->kode_mk}}</td>
                                            <td>{{$unggah->mata_kuliah->nama_mk}}</td>
                                            <td title="{{$soal->versi_soal[0]->user->name}}">
                                              @php
                                                $ind=count($soal->versi_soal)-1;
                                              @endphp
                                              {{$soal->versi_soal[$ind]->user->kode}}
                                            </td>
                                            <td title="{{$soal->user_verif->name}}">{{$soal->user_verif->kode}}</td>
                                            <td>{{$soal->versi_soal[$ind]->tanggal_unggah}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#history" data-verifikasi="{{$soal->id_verifikasi}}" data-versi_soal="{{$soal->versi_soal}}">History
                                                </button>                                       
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
            </div>
        </div>

<!--Modal Detail-->
<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table style="width:100%" class="table-hover">
          <tr>
            <td>Kode MK</th>
            <td>:</td>
            <td id="kode_mk"></td>
          </tr>
          <tr>
            <td>Nama MK</th>
            <td>:</td>
            <td id="nama_mk"></td>
          </tr>
          <tr>
            <td>Semester</th>
            <td>:</td>
            <td id="modal_semester"></td>
          </tr>
          <tr>
            <td>Bobot SKS</th>
            <td>:</td>
            <td id="sks"></td>
          </tr>
          <tr>
            <td>Status MK</th>
            <td>:</td>
            <td id="status"></td>
          </tr>
          <tr>
            <td>Koordinator</th>
            <td>:</td>
            <td id="koordinator"></td>
          </tr>
          <tr>
            <td>Tim Pengajar</th>
            <td>:</td>
            <td id="modal_pengajar">            
              <li></li>
            </td>
          </tr>
          <tr>
            <td>Verifikator UTS</th>
            <td>:</td>
            <td id="uts"></td>
          </tr>
          <tr>
            <td>Verifikator UAS</th>
            <td>:</td>
            <td id="uas"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Unggah Revisi--> 
<div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Unggah Revisi</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" action="{{ url('store_revisi') }}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
                  <div class="form-group">
                    <label for="jenis_ujian">Jenis Ujian</label>
                    <select class="form-control" name="jenis_ujian" id="jenis_ujian">
                        <option>UTS</option>
                        <option>UAS</option>
                        <option>Ujian Praktikum</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="soal_ujian">Soal Ujian</label>
                      <input type="file" name="soal_ujian" class="form-control" id="soal_ujian" required="">
                  </div>
                  
                      <input type="hidden" name="id_verifikasi" id="id_verifikasi" value="" >
                      <input type="hidden" name="nama_mk" id="nama_mk" value="">
                      <input type="hidden" name="id_mk" id="id_mk" value="" >

                  <div class="form-group pull-right">
                      <div class="col-sm-offset-2 col-sm-10">
                      <button style="margin-right: -12px" type="submit" class="btn btn-success">Upload</button>
                      </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<!-- Modal History--> 
<div id="history" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">History</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-bordered" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama file</th>
                  <th>Tanggal Unggah</th>
                  <th style="width: 180px">Download</th>
                </tr>
              </thead>
              <tbody id="coba">
              
              </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
$('#detail').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var mata_kuliah = button.data('mk')
  var kode_mk = button.data('kode')
  var sks = button.data('sks')
  var status = button.data('status')
  var koordinator = button.data('koordinator')
  var pengajar = button.data('pengajar')
  var uts = button.data('uts')
  var uas = button.data('uas')
  var semester = button.data('semester')
  var modal = $(this)
  modal.find('.modal-title').text(mata_kuliah)
  modal.find('.modal-body #kode_mk').text(kode_mk)
  modal.find('.modal-body #nama_mk').text(mata_kuliah)
  modal.find('.modal-body #sks').text(sks)
  modal.find('.modal-body #status').text(status)
  modal.find('.modal-body #koordinator').text(koordinator)
  modal.find('.modal-body #uts').text(uts)
  modal.find('.modal-body #uas').text(uas)
  $('.modal-body #modal_pengajar').empty();
        i=0;
        var show='';
        $.each(pengajar,function(){
          if(pengajar[i].pivot.peran =='Pengajar'){
          show+='<li>'+pengajar[i].name+'</li>';
          }
          i+=1;
        });
        $('#modal_pengajar').append(show);

  $('.modal-body #modal_semester').empty();
        i=0;
        var show_semester='';
        $.each(semester,function(){
          show_semester+=semester[i].semester+' ';
          i+=1;
        });
        $('#modal_semester').append(show_semester);
})
</script>

<script>
$('#revisi').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var verifikasi = button.data('verifikasi')
  var nama_mk = button.data('mk')
  var id_mk = button.data('id_mk')
  var modal = $(this)
  console.log(id_mk)
  modal.find('.modal-body #id_verifikasi').val(verifikasi)
  modal.find('.modal-body #nama_mk').val(nama_mk)
  modal.find('.modal-body #id_mk').val(id_mk)
})
</script>

<script>
$('#history').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var versi_soal = button.data('versi_soal')
  var verifikasi = button.data('verifikasi')
  var modal = $(this)

  console.log(versi_soal)

  $('.modal-body #coba').empty();
        i=0;
        count=1;
        var show='';
        $.each(versi_soal,function(){

          if(versi_soal[i].id_verifikasi == verifikasi){
            console.log(versi_soal[i].nama_file)
          show+='<tr><td>'+count+'</td><td>'+versi_soal[i].nama_file+'</td><td>'+versi_soal[i].tanggal_unggah+'</td><td><form method="GET" action="{{ url('download1')}}" style="display: inline;">{{ csrf_field() }}<input type="hidden" name="file" value="'+versi_soal[i].file+'" /><button type="submit" class="btn btn-success btn-sm">Soal</button></form></button><a href="/pdf1/'+versi_soal[i].id_versi+'"><button type="button" class="btn btn-success btn-sm">Hasil Verif</button></a></td></tr>';
          }
          i+=1;
          count+=1;
        });
        $('#coba').append(show);

})
</script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".dropdown-menu li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
@endsection