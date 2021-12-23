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
        <h1 class="h3 mb-2 text-gray-800">Tambah Data Anggota</h1>
        <a href="/anggota" class="btn btn-md btn-primary mb-3">Kembali</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Anggota BENEFITS</h6>
            </div>
            <div class="card-body">
                <form action="/anggota/store" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label" for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="nrp">NRP</label>
                        <input type="text" class="form-control form-control-user @error('nrp') is-invalid @enderror" name="nrp" id="nrp" value="{{old('nrp')}}" required>
                        @error('nrp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="departemen">Departemen</label>
                        <input type="text" class="form-control form-control-user @error('departemen') is-invalid @enderror" name="departemen" id="departemen" value="{{old('departemen')}}" required>
                        @error('departemen')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="angkatan">Angkatan</label>
                        <input type="text" class="form-control form-control-user @error('angkatan') is-invalid @enderror" name="angkatan" id="angkatan" value="{{old('angkatan')}}" required>
                        @error('angkatan')
                        <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="gender">Gender</label>
                        <select class="form-select form-select-md @error('gender') is-invalid @enderror" name="gender" id="gender">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control form-control-user @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" required></textarea>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="asalSekolah">Asal Sekolah</label>
                        <input type="text" class="form-control form-control-user @error('asalSekolah') is-invalid @enderror" name="asalSekolah" id="asalSekolah" value="{{old('asalSekolah')}}" required>
                        @error('asalSekolah')
                        <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="noHp">Nomor HP</label>
                        <input type="text" class="form-control form-control-user @error('noHp') is-invalid @enderror" name="noHp" id="noHp" value="{{old('noHp')}}" required>
                        @error('noHp')
                        <div class="invalid-feedback">
                            {{$message}}
                          </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-success">Tambah</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection
</body>

</html>
