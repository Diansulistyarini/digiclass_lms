@extends('layouts/main')

@section('title', 'Clases')

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
            <!-- End Bread crumb and right sidebar toggle -->

            <!-- Container fluid  -->

            <div class="container">
                <!-- Start First Cards -->
            <div class="card shadow mb-4 mt-3">
                @if($classes->count() > 0)
                <div class="row ml-2 mr-2">
                    @foreach($classes as $c)
                    <div class="col-md-4 mt-4">
                        <div class="card shadow mb-6">
                            <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap">
                            <div class="card-body">
                            <a class="card-text" style="color: black" href="/data">{{ $c->category }}</a>
                            {{-- <p class="card-text">Deskripsi : {{ $c->deskripsi }}</p>
                            <p class="card-text">Link Video Pembelajaran : {{ $c->video }}</p> --}}
                           
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
            <!-- End First Cards -->

        </div>
        <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
@endsection