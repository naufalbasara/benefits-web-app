@extends('layout.template')
@section('title', 'Kas Forda')
<!DOCTYPE html>
<html lang="en">

<body id="page-top">
    @section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Kas BENEFITS</h1>
        <a href="dana/add" class="btn btn-md btn-success mb-3">Tambah Data</a>

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Kas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$totalKas}}</div>
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
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pemasukkan Bulan Ini
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Rp{{$thisMonthIncome}}</div>
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
                                    Total Pemasukan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$danaMasuk}}</div>
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
                                    Total Pengeluaran</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{$danaKeluar}}</div>
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
                                <th>Tanggal Transaksi</th>
                                <th>Biaya</th>
                                <th>Sumber/Keperluan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tanggal Transaksi</th>
                                <th>Biaya</th>
                                <th>Sumber/Keperluan</th>
                                <th>Opsi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($dana as $d)
                            <tr>
                                <td>
                                    <?php
                                        if(($d -> tanggalTransaksi) == null) {
                                            echo "-";
                                        } else {
                                            echo $d->tanggalTransaksi;
                                        }
                                    ?>
                                </td>
                                <td>{{$d -> biaya}}</td>
                                <td>
                                    <?php
                                        if(($d -> sumber) != null) {
                                            echo $d->sumber;
                                        } else if(($d -> keperluan) != null){
                                            echo $d->keperluan;
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a href="dana/detail/{{$d -> danaID}}" class="btn btn-sm btn-info">View Details</a>
                                    |
                                    <a href="dana/edit/{{$d -> danaID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="dana/delete/{{$d -> danaID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$d->danaID}} From Dana?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $dana->links() }}
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
