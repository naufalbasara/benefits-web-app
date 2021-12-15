@extends('layout.template')
@section('title', 'Edit Anggota Forda')
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
        <h1 class="h3 mb-2 text-gray-800">Edit Data {{$n-> nama}}</h1>
        @endforeach

        <a href="/anggota" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota BENEFITS</h6>
            </div>
            <div class="card-body">
                @foreach ($anggota as $a)
                <form action="/anggota/update" method="post">
		            {{ csrf_field() }}

                    <div class="form-group">
                        <label class="control-label" for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user" name="nama" id="nama" value="{{$a->nama}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">NRP</label>
                        <input type="text" class="form-control form-control-user" name="nrp" id="nrp" value="{{$a->nrp}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Departemen</label>
                        <input type="text" class="form-control form-control-user" name="departemen" id="departemen" value="{{$a->departemen}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Angkatan</label>
                        <input type="text" class="form-control form-control-user" name="angkatan" id="angkatan" value="{{$a->angkatan}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Gender</label>
                        <input type="text" class="form-control form-control-user" name="gender" id="gender" value="{{$a->gender}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Alamat</label>
                        <textarea name="alamat" class="form-control form-control-user" name="alamat" id="alamat" rows="3">{{$a->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Asal Sekolah</label>
                        <input type="text" class="form-control form-control-user" name="asalSekolah" id="asalSekolah" value="{{$a->asalSekolah}}">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nama">Nomor HP</label>
                        <input type="text" class="form-control form-control-user" name="noHp" id="noHp" value="{{$a->noHp}}">
                    </div>
                <button type="submit" class="btn btn-sm btn-success">Update</button>

                </form>
                @endforeach


            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
