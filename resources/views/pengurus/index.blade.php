@extends('layout.template')
@section('title', 'Pengurus Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Pengurus BENEFITS</h1>
        <a href="pengurus/add" class="btn btn-md btn-success mb-3">Tambah Data</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data pengurus BENEFITS</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NRP</th>
                                <th>Divisi</th>
                                <th>Jabatan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>NRP</th>
                                <th>Divisi</th>
                                <th>Jabatan</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($pengurus as $p)
                            <tr>
                                <td>{{$p -> nama}}</td>
                                <td>{{$p -> nrp}}</td>
                                <td>{{$p -> namaDivisi}}</td>
                                <td>{{$p -> jabatan}}</td>
                                <td>
                                    <a href="pengurus/detail/{{$p -> pengurusID}}" class="btn btn-sm btn-info">View Details</a>
                                    |
                                    <a href="pengurus/edit/{{$p -> pengurusID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="pengurus/delete/{{$p -> pengurusID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$p->nama}} From pengurus?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pengurus->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
