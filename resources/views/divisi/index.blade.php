@extends('layout.template')
@section('title', 'Divisi Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Divisi BENEFITS</h1>
        <a href="divisi/add" class="btn btn-md btn-success mb-3">Tambah Data</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Divisi BENEFITS</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Divisi</th>
                                <th>Jumlah Pengurus</th>
                                <th>Jumlah Program Kerja</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Divisi</th>
                                <th>Jumlah Pengurus</th>
                                <th>Jumlah Program Kerja</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($divisi as $d)
                            <tr>
                                <td>{{$d -> namaDivisi}}</td>
                                <td>{{$numberOfStaff}}</td>
                                <td>{{$numberOfProker }}</td>
                                <td>
                                    <a href="divisi/detail/{{$d -> divisiID}}" class="btn btn-sm btn-info">View Details</a>
                                    |
                                    <a href="divisi/edit/{{$d -> divisiID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="divisi/delete/{{$d -> divisiID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$d->namaDivisi}} From divisi?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                {{ $divisi->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
