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
                  
                   <form class="form-horizontal" action="{{ route('verifikator.update',$verifikator[0]->id_verifikator) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}
                    <input name="id_verifikator" value="{{$verifikator[0]->id_verifikator}}" hidden="">
                        <div class="form-group col-sm-6">
                          <label for="mata_kuliah">Mata Kuliah</label>
                                <input type="text" name="id_mk" value="{{ $verifikator[0]->mk }}" class="form-control" disabled="disabled">                             
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uts">Verifikator UTS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uts" name="verif_uts"  required="">
                                <option value="{{$verifikator[0]->verif_uts}}">{{$verifikator[0]->named1}}</option>
                              @foreach($datadosen as $dosen) 
                                @if($dosen->id_dosen != $verifikator[0]->verif_uts)
                                  <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                                @endif
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uas">Verifikator UAS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uas" name="verif_uas"  required="">
                                <option value="{{$verifikator[0]->verif_uas}}">{{$verifikator[0]->named2}}</option>
                              @foreach($datadosen as $dosen) 
                                @if($dosen->id_dosen != $verifikator[0]->verif_uas)
                                  <option value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                                @endif
                              @endforeach
                             </select>
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