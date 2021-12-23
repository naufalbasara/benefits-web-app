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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Anggota BENEFITS</h1>
        @can('admin', 'sekretaris')
        <a href="anggota/add" class="btn btn-md btn-success mb-3">Tambah Data</a>
        @endcan

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota BENEFITS</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NRP</th>
                                <th>Departemen</th>
                                <th>Angkatan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>NRP</th>
                                <th>Departemen</th>
                                <th>Angkatan</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($anggota as $a)
                            <tr>
                                <td>{{$a -> nama}}</td>
                                <td>{{$a -> nrp}}</td>
                                <td>{{$a -> departemen}}</td>
                                <td>{{$a -> angkatan}}</td>
                                <td>
                                    <a href="anggota/detail/{{$a -> nrp}}" class="btn btn-sm btn-info">View Details</a>
                                    @can('admin', 'sekretaris')
                                    |
                                    <a href="anggota/edit/{{$a -> nrp}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="anggota/delete/{{$a -> nrp}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$a->nama}} From Anggota?')">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $anggota->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
