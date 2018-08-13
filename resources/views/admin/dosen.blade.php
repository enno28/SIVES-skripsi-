@extends("layouts.master_admin")

@section("content")
@include('flash::message')
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> Daftar Dosen</div>
  <div class="card-body">
    <div class="table-responsive">
        <p align="right" style="padding-right: 15px">
          <a href="/dosen/create"><button type="button" class="btn btn-success btn-sm">Tambah Dosen</button></a>
        </p>
      <div class="default-tab">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Aktif</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Non-aktif</a>
          </div>
        </nav>
          <div class="tab-content pl-3 pt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP Dosen</th>
                      <th>Kode Dosen</th>
                      <th>Nama Dosen</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th style="width: 110px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $counter = 1;
                    @endphp
                    @foreach( $dosen as $key => $show_dosen)
                      @if($show_dosen->status == 1)
                      <tr>
                      <td>{{ $counter++}}</td>
                      <td>{{ $show_dosen->nip }}</td>
                      <td>{{ $show_dosen->kode }}</td>
                      <td>{{ $show_dosen->name }}</td>
                      <td>{{ $show_dosen->email }}</td>
                      <td>  @if($show_dosen->role == '1') {{'Admin'}}
                            @elseif($show_dosen->role == '2') {{'Verifikator'}}
                            @elseif($show_dosen->role == '3') {{'Pengajar'}}
                            @elseif($show_dosen->role == '4') {{'TU'}} @endif
                      </td>
                      <td>
                          <a href="{{ route('dosen.edit',$show_dosen->id)}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                          <form method="POST" action="{{ route('dosen.destroy',$show_dosen->id)}}" style="display: inline;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE" />
                            <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure want to deactivate {{ $show_dosen->kode }}?')) { return true } else {return false }";>Non-Aktif
                            </button>
                          </form>
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table class="table table-bordered dataTableClass" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIP Dosen</th>
                      <th>Kode Dosen</th>
                      <th>Nama Dosen</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th style="width: 90px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $counter = 1;
                    @endphp
                    @foreach( $dosen as $key => $show_dosen)
                      @if($show_dosen->status == 0)
                    <tr>
                      <td>{{ $counter++}}</td>
                      <td>{{ $show_dosen->nip }}</td>
                      <td>{{ $show_dosen->kode }}</td>
                      <td>{{ $show_dosen->name }}</td>
                      <td>{{ $show_dosen->email }}</td>
                      <td>  @if($show_dosen->role == '1') {{'Admin'}}
                            @elseif($show_dosen->role == '2') {{'Verifikator'}}
                            @elseif($show_dosen->role == '3') {{'Pengajar'}} @endif
                      </td>
                      <td>
                          <a href="{{ route('dosen.edit',$show_dosen->id)}}"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                          <form method="POST" action="{{ url('activate',$show_dosen->id)}}" style="display: inline;">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT" />
                            <button type="submit" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure want to aktivate this {{ $show_dosen->kode }}?')) { return true } else {return false }";>Aktif
                            </button>
                          </form>
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection