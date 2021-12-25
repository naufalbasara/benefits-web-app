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
        <a href="proker/add" class="btn btn-md btn-success mb-3">Tambah Data</a>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Program</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalProgram}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Progress Program
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$progress}}%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Biaya Keperluan Proker</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$fund}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Uang Kas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$totalKas}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                <td>
                                    <?php
                                        if(strlen($p ->nama) > 20) {
                                            $nama = explode(' ', $p ->nama);
                                            if(count($nama) > 2) {
                                                array_splice($nama, 2, 1);
                                                echo implode(' ', $nama);
                                            } else {
                                                array_splice($nama, 1, 1);
                                                echo implode(' ', $nama);
                                            }
                                        } else {
                                            echo $p->nama;
                                        }
                                    ?>
                                </td>
                                <td>{{$p -> status}}</td>
                                <td>
                                    <a href="proker/detail/{{$p -> prokerID}}" class="btn btn-sm btn-info">View Details</a>
                                    |
                                    <a href="proker/edit/{{$p -> prokerID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="proker/delete/{{$p -> prokerID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$p->namaProker}} From Program Kerja?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $programkerja->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
