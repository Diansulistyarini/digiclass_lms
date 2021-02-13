@extends('layouts/main')

@section('title', 'Dashboard Admin')

@section('container')
    
    <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">

                    <div class="col-5 align-self-center">
                        <?php
                            $tanggal= mktime(date("m"),date("d"),date("Y"));
                            echo "Date : <b>".date("d-M-Y", $tanggal)."</b> ";
                            date_default_timezone_set('Asia/Jakarta');
                            $jam=date("H:i:s");
                            echo "| Time : <b>". $jam." "."</b>";
                            $a = date ("H");
                                if (($a>=6) && ($a<=11))
                                {
                                    echo "<br> <b> Selamat Pagi !!</b>";
                                }
                                else if(($a>11) && ($a<=15))
                                {
                                echo ", Selamat Pagi !!";}
                                else if (($a>15) && ($a<=18)){
                                echo ", Selamat Siang !!";}
                                else { echo "<br> <b> Good Night </b>";
                                }
                        ?> 
                            
                        {{ Auth::user()->name }}

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="container">
            <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DataTables 
                                    <span>
                                        <a href="/makanan/create" class="text-primary float-right">
                                            <i class="fas fa-plus"><span class="ml-2">Add Data</span></i>
                                        </a>
                                    </span>
                                </h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="text-center">NO</th>
                                                <th scope="col" class="text-center">Nama</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">Role</th>
                                                <th scope="col" class="text-center">OPSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $u)
                                                <tr>
                                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $u->name }}</td>
                                                    <td class="text-center">{{ $u->email }}</td>
                                                    <td class="text-center">{{ $u->role }}</td>
                                            
                                                    <td class="text-center">
                                                        <a href="/makanan/{{ $u->name }}/edit" class="btn btn-small text-success">
                                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                                        </a>
                                                        <form action="/makanan/{{ $u->name }}" method="POST"
                                                            class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-small text-danger">
                                                                <i class=" fa fa-trash"></i><span class="ml-2">Delete</span>
                                                            </button>
                                                        </form>
                                                    </td>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
@endsection
