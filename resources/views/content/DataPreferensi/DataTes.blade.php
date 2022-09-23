@inject('TransServiceRequisition', 'App\Http\Controllers\DataPreferensi\DataPreferensiController')

@extends('adminlte::page')

@section('title', 'SMArT Baznas Sragen')

@section('content_header')

@stop

@section('content')

    <h3 class="page-title"><br>
        <b>Data Tes</b> <small>Kelola Data Tes</small>
    </h3>
    <br />
    @if (session('msg'))
        <div class="alert alert-info" role="alert">
            {{ session('msg') }}
        </div>
    @endif
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Cari Daftar
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <label for="tanggalmulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" id="tanggalmulai" placeholder="Masukan Tanggal Mulai">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label for="tanggalberakhir" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-12">
                        <input type="date" class="form-control" id="tanggalberakhir"
                            placeholder="Masukan Tanggal Berakhir ">
                    </div>
                </div>
                <div class="form-group col-6">
                    <label class="col-sm-2 col-form-label">Kategori Tes</label>
                    <div class="col-sm-12">
                        <select class="form-control select choose" id="kategorites">
                            <option value=""> -- Pilih Kategori Tes -- </option>
                            <option value="PenjurusanSMA">Penjurusan SMA</option>
                            <option value="Rekrutmen">Rekrutmen</option>
                            <option value="MinatBakat">Minat Bakat</option>
                            <option value="Assesmen">Assesmen</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label class="col-sm-4 col-form-label">Tipe Pengguna</label>
                    <div class="col-sm-12">
                        <select class="form-control select choose" id="role">
                            <option value="">-- Tipe Pengguna --</option>
                            <option value="Siswa">Siswa</option>
                            <option value="Karyawan">Karyawan</option>
                            <option value="Pribadi">Pribadi</option>
                            <option value="HRD">HRD</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-6">
                    <label class="col-sm-2 col-form-label">Klien</label>
                    <div class="col-sm-12">
                        <select class="form-control select choose" id="klien">
                            <option value=""> -- Pilih Klien -- </option>
                            @foreach ($tb_datates as $c)
                                <option value="{{ $c->id }}"> {{ $c->namaklien }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-actions float-right">
                        <button type="reset" name="Reset" class="btn btn-danger" onClick="window.location.reload();"><i
                                class="fa fa-times"></i> Batal</button>
                        <button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" title="Save"><i
                                class="fa fa-search"></i> Temukan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border border-dark">
        <div class="card-header bg-dark clearfix">
            <h5 class="mb-0 float-left">
                Daftar
            </h5>
            <div class="form-actions float-right">
                <button onclick="location.href='{{ url('datates-tambah') }}'" name="Find" class="btn btn-sm btn-info"
                    title="Add Data"><i class="fa fa-plus"></i> Tambah Data Tes</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-actions float-right">
                <form action="/datates/cari-datates" method="GET">
                    <input type="text" name="cari" placeholder="Nama Klien" value="{{ old('cari') }}">
                    <input type="submit" value="CARI">
                </form><br>
            </div>
            <div class="table-responsive">
                <table id="table-ist" style="width:100%"
                    class="table table-striped table-bordered table-hover table-full-width">
                    <thead>
                        <tr>
                            <th width="1%" style='text-align:center'>No</th>
                            <th width="15%" style='text-align:center'>Nama Klien</th>
                            <th width="15%" style='text-align:center'>Kategori Ujian</th>
                            <th width="15%" style='text-align:center'>Tipe User</th>
                            <th width="15%" style='text-align:center'>Tanggal Ujian</th>
                            <th width="15%" style='text-align:center'>Tujuan Ujian</th>
                            <th width="10%" style='text-align:center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="listdatates">
                        @foreach ($tb_datates as $a)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->namaklien }}</td>
                                <td>{{ $a->kategorites }}</td>
                                <td>{{ $a->tipepengguna }}</td>
                                <td>{{ $a->tanggalujian }}</td>
                                <td>{{ $a->tujuanujian }}</td>
                                <td>
                                    <a href="/datates/{{ $a->id }}/edit-datates"
                                        class="btn btn-outline-warning btn-sm">Edit</a>
                                    <a href="/datates/{{ $a->id }}/hapus-datates"
                                        class="btn btn-outline-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $('#listdatates').html(html);
        $('#table-ist').DataTable();
    </script>

@stop

@section('footer')

@stop

@section('css')

@stop

@section('js')

@stop
