@extends("layouts.master_admin")

@section("content")
<!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="/mata_kuliah">Mata Kuliah</a>
        </li>
        <li class="breadcrumb-item active">Edit Mata Kuliah</li>
      </ol>

<!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Form Edit Mata Kuliah</div>
            <div class="card-body">
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                   <form class="form-horizontal" action="{{ route('mata_kuliah.update', $show_mk->id_mk) }}" method="post">
                    <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}
                        <div class="form-group col-sm-6">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" class="form-control" id="kode_mk" value="{{$show_mk->kode_mk}}" disabled="disabled">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" id="nama_mk" value="{{$show_mk->nama_mk}}" required="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="bobot_sks">Bobot SKS</label>
                            <select class="form-control" name="bobot_sks" id="bobot_sks" value="{{$show_mk->bobot_sks}}">
                                <option @if($show_mk->bobot_sks == '1')       {{"selected"}} @endif>1     </option>
                                <option @if($show_mk->bobot_sks == '(2-0)')   {{"selected"}} @endif>2(2-0)</option>
                                <option @if($show_mk->bobot_sks == '3')       {{"selected"}} @endif>3     </option>
                                <option @if($show_mk->bobot_sks == '3(2-2)')  {{"selected"}} @endif>3(2-2)</option>
                                <option @if($show_mk->bobot_sks == '4')       {{"selected"}} @endif>4     </option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="semester">Semester</label>
                            <select class="js-example-basic-multiple form-control"  id="semester" name="semester[]" multiple="multiple" required="">
                                @for($i=1;$i<=8;$i++)
                                <option value="{{$i}}" 
                                    @foreach($show_mk->periode as $s) 
                                     @if($s->semester ==$i)
                                        {{"selected"}} 
                                     @endif
                                    @endforeach>{{$i}}
                                </option>
                                @endfor
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="status_mk">Status Mata Kuliah</label>
                            <select class="form-control" name="status_mk" id="status_mk" value="{{$show_mk->status_mk}}">
                                <option @if($show_mk->status_mk == 'Wajib')   {{"selected"}} @endif>Wajib  </option>
                                <option @if($show_mk->status_mk == 'Pilihan') {{"selected"}} @endif>Pilihan</option>
                                <option @if($show_mk->status_mk == 'Layanan') {{"selected"}} @endif>Layanan</option>
                          </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="koordinator">Dosen Koordinator</label>
                            <select class="form-control js-example-basic-multiple" id="koordinator" name="koordinator" required="">
                              @foreach($datadosen as $dosen) 
                                <option @if($show_mk->koordinator == $dosen->id) {{"selected"}} @endif value="{{ $dosen->id }}">{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="pengajar">Tim Pengajar</label>
                            <select class="form-control js-example-basic-multiple" id="pengajar" name="pengajar[]" multiple="multiple"  required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}"
                                    @foreach($show_mk->peran as $pengajar) 
                                     @if(($pengajar->id_user == $dosen->id) AND ($pengajar->peran == 'Pengajar'))
                                        {{"selected"}} 
                                     @endif
                                    @endforeach>{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uts">Verifikator UTS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uts" name="verif_uts" required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}"
                                    @foreach($show_mk->peran as $verif_uts) 
                                     @if(($verif_uts->id_user == $dosen->id) AND ($verif_uts->peran == 'Verifikator') AND ($verif_uts->sesi_verif == 'UTS'))
                                        {{"selected"}} 
                                     @endif
                                    @endforeach>{{ $dosen->name}}</option>
                              @endforeach
                             </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="verif_uas">Verifikator UAS</label>
                            <select class="form-control js-example-basic-multiple" id="verif_uas" name="verif_uas" required="">
                              @foreach($datadosen as $dosen) 
                                <option value="{{ $dosen->id }}"
                                    @foreach($show_mk->peran as $verif_uas) 
                                     @if(($verif_uas->id_user == $dosen->id) AND ($verif_uas->peran == 'Verifikator') AND ($verif_uas->sesi_verif == 'UAS'))
                                        {{"selected"}} 
                                     @endif
                                    @endforeach>{{ $dosen->name}}</option>
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

