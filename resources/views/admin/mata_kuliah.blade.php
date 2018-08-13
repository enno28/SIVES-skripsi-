@extends("layouts.master_admin")

@section("content")
<style>
/* Style the input field */
#myInput {
  padding: 20px;
  margin-top: -6px;
  border: 0;
  border-radius: 0;
  background: #f1f1f1;
}
</style>
@include('flash::message')
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Daftar Mata Kuliah</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" cellspacing="0">
        <p align="right" style="padding-right: 15px">
        <a href="/mata_kuliah/create"><button type="button" class="btn btn-success btn-sm">Tambah Mata Kuliah</button></a>
        </p>
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Mata Kuliah</th>
            <th>Koordinator</th>
            <th>Tim Pengajar</th>
            <th>Verifikator UTS</th>
            <th>Verifikator UAS</th>
            <th style="width: 150px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        {{-- {{dd($mata_kuliah->)}} --}}
        @foreach( $mata_kuliah as $key => $show_mk)
          <tr>
            <td>{{ ++$key}}</td>
            <td>{{ $show_mk->kode_mk }}</td>
            <td>{{ $show_mk->nama_mk }}</td>
            <td title="{{$show_mk->user["name"]}}">{{$show_mk->user["kode"]}}</td>
            <td>
              @foreach($show_mk->peran as $pengajar)
                  @if($pengajar->peran =='Pengajar') 
                    <li title="{{$pengajar->user["name"]}}">{{$pengajar->user["kode"]}}</li>
                  @endif
              @endforeach
            </td>
              @foreach($show_mk->peran as $verif)
                  @if($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UTS') 
                    <td title="{{$verif->user["name"]}}">{{$verif->user["kode"]}}</td>
                  @elseif($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UAS') 
                    <td title="{{$verif->user["name"]}}">{{$verif->user["kode"]}}</td>
                  @endif
              @endforeach
            <td>
                <button 
                  type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detail" 
                  data-mk="{{$show_mk->nama_mk}}" 
                  data-kode="{{$show_mk->kode_mk}}"
                  data-sks="{{$show_mk->bobot_sks}}"
                  data-status="{{$show_mk->status_mk}}"  
                  data-koordinator="{{$show_mk->user["name"]}}"
                  data-pengajar ="{{$show_mk->peran}}"
                  data-semester ="{{$show_mk->periode}}"

                  @foreach($show_mk->peran as $verif)
                    @if($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UTS') 
                      data-uts="{{$verif->user["name"]}}"
                    @elseif($verif->peran == 'Verifikator' AND $verif->sesi_verif == 'UAS') 
                      data-uas="{{$verif->user["name"]}}"
                    @endif
                  @endforeach>Detail
                </button>
                <a href="{{ route('mata_kuliah.edit',$show_mk->id_mk)}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                <form method="POST" action="{{ route('mata_kuliah.destroy',$show_mk->id_mk)}}" style="display: inline;">
                  {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE" />
                    <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure want to delete {{ $show_mk->kode_mk }}?')) { return true } else {return false }";>Delete
                    </button>
                </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
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
  console.log(pengajar)
  $('.modal-body #modal_pengajar').empty();
        i=0;
        var show='';
        $.each(pengajar,function(){
          if(pengajar[i].peran =='Pengajar'){
          show+='<li>'+pengajar[i].user["name"]+'</li>';
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