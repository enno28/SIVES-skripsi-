@extends("layouts.master_admin")

@section("content")
@include('flash::message')
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i>Form Konfigurasi</div>
        <form class="form-horizontal" action="{{ route('konfigurasi.store', $konf->id_konfigurasi) }}" method="post">
         {{--  <input name="_method" type="hidden" value="PATCH"> --}}
            {{ csrf_field() }}
          <div class="form-group col-sm-2" style="padding-top: 10px">
            <label>Semester :</label><br>
            <input type="radio" name="periode" value="Ganjil" @if($konf->periode == 'Ganjil') checked="checked" @endif>
            Ganjil<br>
            <input type="radio" name="periode" value="Genap" inline @if ($konf->periode == 'Genap') checked="checked" @endif> Genap
          </div>

          <div class="form-group col-sm-2" style="padding-top: 10px">
            <label>Kirim ke :</label><br>
            <input type="radio" name="verifikator" value="UTS" @if($konf->verifikator == 'UTS') checked="checked" @endif>
            Verifikator UTS<br>
            <input type="radio" name="verifikator" value="UAS" inline @if ($konf->verifikator == 'UAS') checked="checked" @endif> Verifikator UAS
          </div>

          <div style="padding-left: 15px">
              <label>Tahun ajaran:</label>
          </div>
          <div class="row" style="padding-left: 15px;">
            <div class="form-group col-sm-2">
                <input type="number" name="tahun1" class="form-control" value="{{$konf->tahun1}}" placeholder="YYYY" min="2017" max="2100">
            </div>
            <div class="form-group col-sm-1">
                <input value="   /   " disabled="" class="form-control">
            </div>
            <div class="form-group col-sm-2">
                <input type="number" name="tahun2" class="form-control" value="{{$konf->tahun2}}" placeholder="YYYY" min="2017" max="2100">
            </div>
          </div>
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default" onclick="if(confirm('Are you sure want to change configuration?')) { return true } else {return false }";>Simpan</button>
              </div>
          </div>
        </form>
      </div>
    </div>

<script>
  document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>

@endsection