@extends("layouts.master_pengajar")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Unggah Soal / {{$mata_kuliah[0]->nama_mk}}</li>
      </ol>
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Unggah Soal</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                @if(count($errors)>0)
                    <ul>
                        @foreach($errors ->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif

              <form class="form-horizontal" action="{{ route('unggah_soal.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="jenis_ujian">Jenis Ujian</label>
                            <select class="form-control" name="jenis_ujian" id="jenis_ujian">
                                <option>UTS</option>
                                <option>UAS</option>
                                <option>Ujian Praktikum</option>
                                <option>Ujian Susulan</option>
                                <option>Ujian Perbaikan</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="soal_ujian">Soal Ujian</label>
                            <input type="file" name="soal_ujian" class="form-control" id="soal_ujian" required="">
                        </div>
                        
                            <input type="hidden" name="id_mk" value="{{$mata_kuliah[0]->id_mk}}">
                            <input type="hidden" name="nama_mk" value="{{$mata_kuliah[0]->nama_mk}}">
                            <input type="hidden" name="verifikator" value="{{$peran[0]->id_user}}">

                        <div class="form-group pull-right">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Unggah</button>
                            </div>
                        </div>
                    </form>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection