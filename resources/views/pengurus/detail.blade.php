@extends('layout.template')
@section('title', 'Pengurus Forda')
<!DOCTYPE html>
<html lang="en">


<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        @foreach ($nama as $n)
        <h1 class="h3 mb-2 text-gray-800">Detail Data {{$n-> nama}}</h1>
        @endforeach
        <a href="/pengurus" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengurus BENEFITS</h6>
            </div>
            <div class="card-body">
                @foreach ($pengurus as $p)
                <div class="form-group">
                    <label class="control-label" for="nama">Nama</label>
                    <input type="text" class="form-control form-control-user" id="nama" value="{{$p->nama}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nrp">NRP</label>
                    <input type="text" class="form-control form-control-user" id="nrp" value="{{$p->nrp}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="departemen">Departemen</label>
                    <input type="text" class="form-control form-control-user" id="departemen" value="{{$p->departemen}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="angkatan">Angkatan</label>
                    <input type="text" class="form-control form-control-user" id="angkatan" value="{{$p->angkatan}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="divisi">Divisi</label>
                    <input type="text" class="form-control form-control-user" id="divisi" value="{{$p->namaDivisi}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="gender">Gender</label>
                    <input type="text" class="form-control form-control-user" id="gender"
                    value="<?php if($p->gender == 'L') {
                            echo "Laki-Laki";
                        } else {
                            echo "Perempuan";
                        }
                        ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control form-control-user" id="alamat" rows="3" disabled>{{$p->alamat}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="noHp">Nomor HP</label>
                    <input type="text" class="form-control form-control-user" id="noHp" value="{{$p->noHp}}" disabled>
                </div>

                <a href="/pengurus/edit/{{$p -> divisiID}}" class="btn btn-sm btn-primary">Edit</a>
                |
                <a href="/pengurus/delete/{{$p -> divisiID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$p->nama}} From pengurus?')">Delete</a>
                @endforeach

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
