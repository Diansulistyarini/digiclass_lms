@extends('layouts/main')

@section('title', 'Data Siswa')

@section('container')
    
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
    <!-- ============================================================== -->
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
                                    echo "<br> <b> Good Morning</b>";
                                }
                                else if(($a>11) && ($a<=15))
                                {
                                echo "<br> <b> Good Afternoon!! </b>";}
                                else if (($a>15) && ($a<=18)){
                                echo "<br> <b> Good Evening!! </b>";}
                                else { echo "<br> <b> Good Night!! </b>";
                                }
                        ?> 
                            
                        {{ Auth::user()->name }}

                        </div>
                    </div>
                </div>
            <!-- End Bread crumb and right sidebar toggle -->

            <!-- Container fluid  -->
            <div class="container">
                <div class="card shadow mt-4 mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Siswa 
                            <span>
                                {{-- <a data-toggle="modal" data-target="#addData" class="text-primary float-right">
                                    <i class="fas fa-plus"><span class="ml-2">Add Data</span></i>
                                </a> --}}
                            </span>
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">NO</th>
                                        {{-- <th scope="col" class="text-center">Photo</th> --}}
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">Email</th>
                                        <th scope="col" class="text-center">Gender</th>
                                        <th scope="col" class="text-center">Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            {{-- <td>
                                                <img class="card-img-top" src="{{ asset ('photo/'. $u->photo) }}" alt="Card image cap" width="30">
                                            </td> --}}
                                            <td class="text-center">{{ $u->name }}</td>
                                            <td class="text-center">{{ $u->email }}</td>
                                            <td class="text-center">{{ $u->gender }}</td>
                                            <td class="text-center">{{ $u->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
@endsection