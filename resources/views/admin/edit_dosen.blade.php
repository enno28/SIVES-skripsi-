@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/mata_kuliah">Dosen</a>
        </li>
        <li class="breadcrumb-item active">Tambah Dosen</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Tambah Dosen</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="kode_dosen">Kode Dosen</label>
                            <input type="text" name="kode_dosen" class="form-control" id="kode_dosen" value="{{$dosen->kode}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama">Nama Dosen</label>
                            <input type="text" name="nama" class="form-control" id="nama" value="{{$dosen->name}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nip">NIP Dosen</label>
                            <input type="text" name="nip" class="form-control" id="nip" value="{{$dosen->nip}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{$dosen->email}}" required="">
                        </div>
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

