@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/mata_kuliah">Mata Kuliah</a>
        </li>
        <li class="breadcrumb-item active">Tambah Mata Kuliah</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Tambah Mata Kuliah</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('mata_kuliah.store') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control" id="kode_mk" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" id="nama_mk" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="bobot_sks">Bobot SKS</label>
                            <select class="form-control" name="bobot_sks" id="bobot_sks">
                                <option>1</option>
                                <option>2(2-0)</option>
                                <option>3</option>
                                <option>3(2-2)</option>
                                <option>4</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="semester">Semester</label>
                            <select class="form-control js-example-basic-multiple" id="semester" name="semester[]" multiple="multiple" required="">
                                @for($i=1;$i<=8;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status_mk">Status Mata Kuliah</label>
                            <select class="form-control" name="status_mk" id="status_mk">
                                <option>Wajib</option>
                                <option>Pilihan</option>
                                <option>Layanan</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="koordinator">Dosen Koordinator</label>
                            <select class="form-control js-example-basic-multiple" id="koordinator" name="koordinator" required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pengajar">Tim Pengajar</label>
                            <select class="form-control js-example-basic-multiple" id="pengajar" name="pengajar[]" multiple="multiple"  required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uts">Verifikator UTS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uts" name="verif_uts" required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uas">Verifikator UAS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uas" name="verif_uas" required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
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