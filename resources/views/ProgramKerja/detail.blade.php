@extends('layout.template')
@section('title', 'Program Kerja Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Program Kerja BENEFITS</h1>
        <a href="/proker" class="btn btn-md btn-primary mb-3">Kembali</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Program Kerja BENEFITS</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Program</th>
                                <th>Divisi</th>
                                <th>Tanggal Kegiatan</th>
                                <th>PIC</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nama Program</th>
                                <th>Divisi</th>
                                <th>Tanggal Kegiatan</th>
                                <th>PIC</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($programkerja as $p)
                            <tr>
                                <td>{{$p -> namaProker}}</td>
                                <td>{{$p -> namaDivisi}}</td>
                                <td>{{$p -> tanggalKegiatan}}</td>
                                <td>{{$p -> nama}}</td>
                                <td>{{$p -> status}}</td>
                                <td>
                                    <a href="proker/edit/{{$p -> prokerID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="proker/delete/{{$p -> prokerID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$p->namaProker}} From Program Kerja?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
