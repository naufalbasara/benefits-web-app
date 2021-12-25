@extends('layout.template')
@section('title', 'Program Kerja Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit Program Kerja {{$nama->namaProker}}</h1>
        <a href="/proker" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Program Kerja BENEFITS</h6>
            </div>
            <div class="card-body">
                <form action="/proker/update" method="post">
                        @foreach ($proker as $pr)
                        {{ csrf_field() }}
                    <input type="hidden" name="prokerID" value="{{$pr->prokerID}}">
                    <input type="hidden" name="danaID" value="{{$pr->danaID}}">

                    <div class="form-group">
                        <label class="control-label" for="divisiID">Divisi</label>
                        <select class="form-select form-select-md" name="divisiID" id="divisiID">
                            @foreach ($divisi as $d)
                            <option value="{{ $d->divisiID }}" {{$d->divisiID == $pengurusDivisi->divisiID  ? 'selected' : ''}}>{{ $d->namaDivisi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="pengurusID">PIC</label>
                        <select class="form-select form-select-md" name="pengurusID" id="pengurusID">

                            @foreach ($pengurus as $p)
                            <option value="{{$p ->pengurusID}}" {{$p->pengurusID == $pic->pengurusID  ? 'selected' : ''}}>{{$p->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="biaya">Total Biaya Diperlukan</label>
                        <input type="number" class="form-control form-control-user" name="biaya" id="biaya" value="{{$pr->biaya}}" placeholder="Ex: 100000" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="namaProker">Nama Program</label>
                        <input type="text" class="form-control form-control-user" name="namaProker" id="namaProker" value="{{$pr->namaProker}}" placeholder="Ex: 100000" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="tanggalKegiatan">Tanggal Kegiatan</label>
                        <input type="date" class="form-control" name="tanggalKegiatan" value="{{$pr->tanggalKegiatan}}" id="tanggalKegiatan">
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="status">Status Kegiatan</label>
                        <select class="form-select form-select-md" name="status" id="status" required>
                            <option value="Belum">Belum</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Sudah">Sudah</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection

</body>

</html>
