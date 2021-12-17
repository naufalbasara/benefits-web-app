@extends('layout.template')
@section('title', 'Pengurus Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Pengurus</h1>
        <a href="/pengurus" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengurus BENEFITS</h6>
            </div>
            <div class="card-body">

                <form action="/pengurus/store" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="pengurusID">
                    <div class="form-group">
                        <label class="control-label" for="nrp">Nama</label>
                        <select class="form-select form-select-md" name="nrp" id="nrp">
                        @foreach ($anggota as $a)
                            <option value="{{$a -> nrp}}">{{$a -> nama}}</option>
                        @endforeach
                </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="divisi">Divisi</label>
                        <select class="form-select form-select-md" name="divisiID" id="divisi">
                        @foreach ($divisi as $d)
                            <option value="{{$d -> divisiID}}">{{$d -> namaDivisi}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="jabatan">Jabatan</label>
                        <input type="text" class="form-control form-control-user" name="jabatan" id="jabatan" required>
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">Tambah</button>
                </form>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
