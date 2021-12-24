@extends('layout.template')
@section('title', 'Divisi Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Divisi {{$nama->namaDivisi}}</h1>
        @can('admin', 'sekretaris')
        <a href="divisi/add" class="btn btn-md btn-success mb-3">Tambah Data</a>
        @endcan

        <div class="row">
            <div class="col-sm-6">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pengurus Divisi {{$nama->namaDivisi}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Pengurus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $s)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$s->nama}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $staff->links() }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Program Kerja Divisi {{$nama->namaDivisi}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Program Kerja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proker as $s)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$s->namaProker}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
