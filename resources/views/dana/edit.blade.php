@extends('layout.template')
@section('title', 'Edit Kas Forda')

    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Data Kas</h1>
        <a href="/dana" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kas BENEFITS</h6>
            </div>
            <div class="card-body">
                <form action="/dana/update" method="post">
                    @foreach ($dana as $d)

                    {{ csrf_field() }}
                    <input type="hidden" name="danaID" value="{{$d->danaID}}">
                    <div class="form-group">
                        <label class="control-label" for="tipeTransaksi">Tipe Transaksi</label>
                        <select class="form-select form-select-md" name="tipeTransaksi" id="tipeTransaksi" required>
                            <option value="DanaMasuk" {{$d->tipeTransaksi == 'DanaMasuk'  ? 'selected' : ''}}>Pemasukan</option>
                            <option value="DanaKeluar" {{$d->tipeTransaksi == 'DanaKeluar'  ? 'selected' : ''}}>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="biaya">Biaya</label>
                        <input type="text" class="form-control form-control-user" name="biaya" id="biaya" placeholder="Ex: 100000" value="{{$d->biaya}}" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="tanggalTransaksi">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tanggalTransaksi" id="tanggalTransaksi" value="{{$d->tanggalTransaksi}}">
                      </div>
                    <div class="form-group">
                        <label class="control-label" for="sumber">Sumber</label>
                        <input type="text" class="form-control form-control-user" name="sumber" id="sumber" placeholder="Ex: Pemasukan Dari Program Kerja, Kas Rutin, dll." value="{{$d->sumber}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="keperluan">Keperluan</label>
                        <input type="text" class="form-control form-control-user" name="keperluan" id="keperluan" placeholder="Ex: Kebutuhan Program Kerja, dll." value="{{$d->keperluan}}">
                    </div>


                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                    @endforeach

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
