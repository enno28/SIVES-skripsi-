@extends("layouts.master_pengajar")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Unggah soal sesi {{$konfigurasi->verifikator}}</li>
      </ol>
<!-- Example DataTables Card-->
@include('flash::message')
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Daftar soal yang belum diunggah</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
               @if(count($errors)>0)
                    <ul>
                        @foreach($errors ->all() as $error)
                            <div class="alert alert-danger" style="padding-left: 25px; margin-left: -25px; margin-right: 15px">
                              <li>{{$error}}</li>
                            </div>
                        @endforeach
                    </ul>
                @endif
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Mata Kuliah</th>
                  <th>Tim Pengajar</th>
                  <th>Verifikator</th>
                  <th style="width: 80px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                
              @foreach($mata_kuliah as $key => $mengajar)
                  <tr>
                    <td>{{++$key}}</td>
                    <td>{{$mengajar->kode_mk}}</td>
                    <td>{{$mengajar->nama_mk}}</td>
                    <td>
                      @foreach($mengajar->users as $pengajar)
                          @if($pengajar->pivot->peran =='Pengajar') 
                            <li title="{{$pengajar->name}}">{{$pengajar->kode}}</li>
                          @endif
                      @endforeach
                    </td>
                    @foreach($mengajar->users as $pengajar)
                      @if($pengajar->pivot->peran=='Verifikator' and $pengajar->pivot->sesi_verif==$konfigurasi->verifikator)
                    <td title="{{$pengajar->name}}">{{$pengajar->kode}}</td>
                    
                    <td>
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#unggah" data-mk="{{$mengajar->id_mk}}" data-verifikator="{{$pengajar->id}}" data-namamk="{{$mengajar->nama_mk}}">Unggah Soal
                      </button>
                    </td>
                    @endif
                    @endforeach
                  </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<!-- Modal Unggah Soal--> 
<div class="modal fade" id="unggah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Unggah Soal</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form-horizontal" action="{{ route('unggah_soal.store') }}" method="POST" enctype="multipart/form-data">
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
                        
                            <input type="hidden" name="id_mk" id="id_mk">
                            <input type="hidden" name="verifikator" id="verifikator">
                            <input type="hidden" name="nama_mk" id="nama_mk">

                        <div class="form-group pull-right">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button style="margin-right: -12px" type="submit" class="btn btn-success">Unggah</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
@endsection

@section("script")
<script type="text/javascript">
  $('#unggah').on('show.bs.modal',function(event){
    var link = $(event.relatedTarget);
    var mk   = link.data('mk');
    var verifikator = link.data('verifikator');
    var nama_mk = link.data('namamk');
    var modal = $(this);
    modal.find('#id_mk').val(mk);
    modal.find('#verifikator').val(verifikator);
    modal.find('#nama_mk').val(nama_mk);
  })
</script>
@endsection