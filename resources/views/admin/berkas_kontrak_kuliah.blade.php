@extends("layouts.master_admin")
@section("content")

<p>
  <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Unggah Kontrak Kuliah
  </button>
</p>
@include('flash::message')
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    <form class="form-horizontal" action="{{ route('kontrak_kuliah.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
          <div class="form-group col-sm-6">
            <label for="id_mk">Mata Kuliah</label>
              <select class="form-control js-example-basic-multiple" id="id_mk" name="id_mk"  required="">
                @foreach($mata_kuliah as $mk) 
                  <option value="{{ $mk->id_mk }}">{{ $mk->nama_mk}}</option>
                @endforeach
               </select>
          </div>
          <div class="form-group col-sm-6">
            <label for="berkas_verifikasi">File Kontrak Kuliah</label>
              <input type="file" name="berkas_kontrak_kuliah" class="form-control" id="berkas_kontrak_kuliah" required="">
          </div>
          <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-success">Submit</button>
          </div>
      </form>
  </div>
</div>
@if(count($errors)>0)
    <ul>
        @foreach($errors ->all() as $error)
            <div class="alert alert-danger" style="padding-left: 25px; margin-left: -25px; margin-right: 15px">
              <li>{{$error}}</li>
            </div>
        @endforeach
    </ul>
@endif
<div class="card mb-3" style="margin-top: 15px">
  <div class="card-header">
      <i class="fa fa-table"></i> Daftar Berkas Kontrak Kuliah
    </div>
  <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" cellspacing="0">
          <div id="fileTreeDemo_1"></div>
        </table>
    </div>
  </div>
</div>
@endsection

@section('script')

<script src="{{asset("file_tree/jquery.js")}}" type="text/javascript"></script>
<script src="{{asset("file_tree/jquery.easing.js")}}" type="text/javascript"></script>
<script src="{{asset("file_tree/jqueryFileTree.js")}}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready( function() { 
    $('#fileTreeDemo_1').fileTree(
      { root: '../../upload/Berkas_Kontrak_Kuliah/', 
      script: '/file_tree/connectors/jqueryFileTree.php',
      expandSpeed: 1000,
            collapseSpeed: 1000,
            multiFolder: true
      }, function(file) { 
      window.open(file);
    });
  });
</script>
@endsection