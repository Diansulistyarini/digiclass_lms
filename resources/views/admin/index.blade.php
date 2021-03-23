@extends('layouts/main')

@section('title', 'Dashboard Admin')

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

                        {{-- </div> --}}
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
           
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Start First Cards -->
                @if ($message = Session::get('sukses'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ $countInstructor }}</h2>
                                        
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">All Instructor</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fas fa-chalkboard-teacher"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{ $countStudent }}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">All Student
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i class="fas fa-chalkboard-teacher"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ $countJadwal }}</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">All Jadwal</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $countClass }}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">All Class</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End First Cards -->
                
                 <!-- Start Cards Jadwal -->
                <div class="card shadow mb-4 mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Data Jadwal </h6>
                </div>
                @if($jadwals->count() > 0)
                <div class="row ml-2 mr-2">
                    @foreach($jadwals as $c)
                    <div class="col-md-4 mt-4">
                        <div class="card shadow mb-6" style="border-radius: 20px">
                            <div class="card-body" href="/addSchedule">
                                <b><p class="card-text">{{ $c->type_conference }}</p></b>
                                <p class="card-text">Hari <span>{{ $c->days }}</span></p>
                                <p class="card-text">Date : {{ $c->time }}</p>
                                <p class="card-text">Category Class  : {{ $c->class_category }}</p>
                                <a class="card-text">Link Converence : {{ $c->link_zoom }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="row justify-content-center" style="margin-top: 15%">
                    <div class="col text-center">
                        <b>Project Belum Tersedia</b>
                    </div>
                </div>
                @endif 
                </div>
                <!-- End Cards Jadwals -->

                <!-- Start Cards Class -->
                <div class="card shadow mb-4 mt-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Class</h6>
                </div>
                @if($classes->count() > 0)
                <div class="row ml-2 mr-2">
                    @foreach($classes as $c)
                    <div class="col-md-4 mt-4">
                        <div class="card shadow mb-4">
                            <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap" width="100" height="180">
                            <div class="card-body" >
                                <b><a class="text" href="/siswa{{ $c->category }}">{{ $c->category }}</a></b>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="row justify-content-center" style="margin-top: 15%">
                    <div class="col text-center">
                        <b>Project Belum Tersedia</b>
                    </div>
                </div>
                @endif 
                </div>
                <!-- End Cards Class -->

            </div>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
@endsection