@extends("layouts.master_admin")
@section("content")
<div class="card mb-3">
  <div class="card-header">
      <i class="fa fa-table"></i> Daftar Berkas Soal Ujian
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
      { root: '../../upload/Berkas_Soal/', 
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