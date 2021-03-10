@extends('layouts/main')

@section('title', 'Assignment')

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
                $tanggal = mktime(date("m"), date("d"), date("Y"));
                echo "Date : <b>" . date("d-M-Y", $tanggal) . "</b> ";
                date_default_timezone_set('Asia/Jakarta');
                $jam = date("H:i:s");
                echo "| Time : <b>" . $jam . " " . "</b>";
                $a = date("H");
                if (($a >= 6) && ($a <= 11)) {
                    echo "<br> <b> Good Morning</b>";
                } else if (($a > 11) && ($a <= 15)) {
                    echo "<br> <b> Good Afternoon!! </b>";
                } else if (($a > 15) && ($a <= 18)) {
                    echo "<br> <b> Good Evening!! </b>";
                } else {
                    echo "<br> <b> Good Night!! </b>";
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
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables
                    <span>
                        <a data-toggle="modal" data-target="#addData" class="text-primary float-right">
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
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Class Category</th>
                                <th scope="col" class="text-center">Subject Matter</th>
                                <th scope="col" class="text-center">Online Text</th>
                                <th scope="col" class="text-center">File Assignment</th>
                                <th scope="col" class="text-center">Date Submit</th>
                                <th scope="col" class="text-center">Score</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ass as $a)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $a->name }}</td>
                                <td class="text-center">{{ $a->class_category }}</td>
                                <td class="text-center">{{ $a->subject_matter }}</td>
                                <td class="text-center">{{ $a->online_text }}</td>
                                <td>
                                    <embed src="{{asset('tugas_siswa/'.$a->file)}}" type="">
                                </td>
                                <td class="text-center">{{ $a->date }}</td>
                                <td class="text-center">{{ $a->score }} </td>

                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#modalNilai{{ $a->id }}" class="btn btn-small text-success">
                                        <i class="fa fa-star"></i><span class="ml-2">Update</span>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteData{{ $a->id }}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

        @endsection