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
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Start First Cards -->
                @foreach ($classes as $c)
                <div class="card-group col-lg-3" style="width: 18rem;">
                    <div class="card">
                      <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title">{{ $c->category }}</h5>
                        
                      </div>
                    </div>
                  </div>
                {{-- <div class="card-group" style="width: 18rem;">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap">
                        <div class="card-body">
                        <p class="card-text-center">{{ $c->category }}</p>
                        </div>
                    </div>
                </div> --}}
                @endforeach
                <!-- End First Cards -->
            </div>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
@endsection