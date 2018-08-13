@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/dosen">Dosen</a>
        </li>
        <li class="breadcrumb-item active">Tambah Dosen</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Tambah Dosen</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('dosen.store') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="kode_dosen">Kode Dosen</label>
                            <input type="text" name="kode_dosen" class="form-control" id="kode_dosen" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama">Nama Dosen</label>
                            <input type="text" name="nama" class="form-control" id="nama" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama">Username IPB</label>
                            <input type="text" name="username" class="form-control" id="username" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nip">NIP Dosen</label>
                            <input type="text" name="nip" class="form-control" id="nip" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email" required="">
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