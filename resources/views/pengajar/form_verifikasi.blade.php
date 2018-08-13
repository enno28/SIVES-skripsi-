@extends("layouts.master_pengajar")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/verifikasi">Verifikasi</a>
        </li>
        <li class="breadcrumb-item active">{{$mata_kuliah->nama_mk}}</li>
      </ol>
<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Verifikasi</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('verifikasi.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="card bg-light mb-3">
                      <div class="card-body">
                        <h5 class="card-title">1. Kesesuaian dengan learning outcomes (kompetensi dasar)</h5>
                        <p class="card-text">(disesuaikan dengan silabus mata kuliah)</p>
                            <input type="radio" name="kesesuaian_lo" value="Sesuai" checked="checked">
                            Sesuai<br>
                            <input type="radio" name="kesesuaian_lo" value="Tidak Sesuai" inline> Tidak Sesuai<br><br>
                            <textarea class="form-control" name="penjelasan_lo" placeholder="Penjelasan Hasil Verifikasi"></textarea>
                      </div>
                    </div>

                    <div class="card bg-light mb-3">
                      <div class="card-body">
                        <h5 class="card-title">2. Tipe Soal</h5>
                            <div class="form-check">
                              <input class="form-check-input" name="tipe[]" type="checkbox" value="5" id="uraian" checked>
                              <label class="form-check-label" for="uraian">
                                Uraian
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" name="tipe[]" type="checkbox" value="1" id="pg">
                              <label class="form-check-label" for="pg">
                                Pilihan Ganda
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" name="tipe[]" type="checkbox" value="2" id="bs">
                              <label class="form-check-label" for="bs">
                                Benar/Salah
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" name="tipe[]" type="checkbox" value="3" id="isian">
                              <label class="form-check-label" for="isian">
                                Isian Singkat
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" name="tipe[]" type="checkbox" value="4" id="cocok">
                              <label class="form-check-label" for="cocok">
                                Mencocokan
                              </label>
                            </div>
                      </div>
                    </div>

                    <div class="card bg-light mb-3">
                      <div class="card-body">
                        <h5 class="card-title">3. Butir soal mewakili materi mata kuliah yang diberikan) </h5>
                        <p class="card-text">(disesuaikan dengan berita acara perkuliahan)</p>
                            <input type="radio" name="kesesuaian_bs" value="Mewakili" checked="checked">
                            Mewakili<br>
                            <input type="radio" name="kesesuaian_bs" value="Tidak Mewakili" inline> Tidak Mewakili<br><br>
                            <textarea class="form-control" name="penjelasan_bs" placeholder="Penjelasan Hasil Verifikasi"></textarea>
                      </div>
                    </div>

                    <div class="card bg-light mb-3">
                      <div class="card-body">
                        <h5 class="card-title">4. Estimasi waktu pengerjaan soal</h5>
                            <input type="radio" name="estimasi_wkt" value="Cukup" checked="checked">
                            Cukup<br>
                            <input type="radio" name="estimasi_wkt" value="Tidak Cukup" inline> Tidak Cukup<br>
                      </div>
                    </div>

                    <div class="card bg-light mb-3">
                      <div class="card-body">
                        <h5 class="card-title">5. Hasil Verifikasi</h5>
                            <input type="radio" name="status" value="Sesuai" checked="checked">
                            Diterima dan diteruskan untuk diperbanyakan<br>
                            <input type="radio" name="status" value="Tidak Sesuai" inline> Revisi<br>
                      </div>
                    </div>
                    <input type="hidden" name="id_mk" value="{{$mata_kuliah->id_mk}}">
                    <div class="form-group pull-right">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </table>
          </div>
        </div>
@endsection