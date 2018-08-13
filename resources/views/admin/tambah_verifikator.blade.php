@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/verifikator">Verifikator</a>
        </li>
        <li class="breadcrumb-item active">Tambah Verifikator</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Tambah Verifikator</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
              
                   <form class="form-horizontal" action="{{ route('verifikator.store') }}" method="POST">
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
                            <label for="verif_uts">Verifikator UTS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uts" name="verif_uts"  required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uas">Verifikator UAS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uas" name="verif_uas"  required="">
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