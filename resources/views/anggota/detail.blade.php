@extends('layout.template')
@section('title', 'Anggota Forda')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template -->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        @foreach ($nama as $n)
        <h1 class="h3 mb-2 text-gray-800">Detail Data {{$n-> nama}}</h1>
        @endforeach
        <a href="/anggota" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota BENEFITS</h6>
            </div>
            <div class="card-body">
                @foreach ($anggota as $a)
                <div class="form-group">
                    <label class="control-label" for="nama">Nama</label>
                    <input type="text" class="form-control form-control-user" id="nama" value="{{$a->nama}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">NRP</label>
                    <input type="text" class="form-control form-control-user" id="nrp" value="{{$a->nrp}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Departemen</label>
                    <input type="text" class="form-control form-control-user" id="departemen" value="{{$a->departemen}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Angkatan</label>
                    <input type="text" class="form-control form-control-user" id="angkatan" value="{{$a->angkatan}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Gender</label>
                    <input type="text" class="form-control form-control-user" id="gender"
                    value= "<?php if($a->gender == 'L') {
                        echo "Laki-Laki";
                    } else {
                        echo "Perempuan";
                    }
                    ?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Alamat</label>
                    <textarea name="alamat" class="form-control form-control-user" id="alamat" rows="3" disabled>{{$a->alamat}}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Asal Sekolah</label>
                    <input type="text" class="form-control form-control-user" id="asalSekolah" value="{{$a->asalSekolah}}" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="nama">Nomor HP</label>
                    <input type="text" class="form-control form-control-user" id="noHp" value="{{$a->noHp}}" disabled>
                </div>

                <a href="/anggota/edit/{{$a -> nrp}}" class="btn btn-sm btn-primary">Edit</a>
                |
                <a href="/anggota/delete/{{$a -> nrp}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$a->nama}} From Anggota?')">Delete</a>
                @endforeach

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
