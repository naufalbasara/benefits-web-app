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
        <a href="/dana" class="btn btn-md btn-primary mb-3">Kembali</a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kas BENEFITS</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tipe Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Biaya</th>
                                <th>Sumber/Keperluan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dana as $d)
                            <tr>
                                <td>
                                    <?php
                                        if($d->tipeTransaksi == 'DanaMasuk') {
                                            echo 'Pemasukan';
                                        } else {
                                            echo "Pengeluaran";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if(($d -> tanggalTransaksi) == null) {
                                            echo "-";
                                        } else {
                                            echo $d->tanggalTransaksi;
                                        }
                                    ?>
                                </td>
                                <td>Rp
                                    <?php
                                        echo number_format($d -> biaya, 0, ',', '.');
                                    ?>
                                </td>
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
                                    <a href="/dana/edit/{{$d -> danaID}}" class="btn btn-sm btn-primary">Edit</a>
                                    |
                                    <a href="/dana/delete/{{$d -> danaID}}" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure You Want to Delete {{$d->danaID}} From Dana?')">Delete</a>
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
