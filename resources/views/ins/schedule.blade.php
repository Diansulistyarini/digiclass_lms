@extends('layouts/main')

@section('title', 'Shedule')

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
                @if ($message = Session::get('sukses'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Schedules
                        <span>
                            <a data-toggle="modal" data-target="#addData" class="text-primary float-right">
                                <i class="fas fa-plus"><span class="ml-2">Add Schedule</span></i>
                            </a>
                        </span>
                    </h6>
                </div>
                
            <!-- Start First Cards -->
            <div class="card shadow mb-4 mt-3">
                @if($jadwals->count() > 0)
                <div class="row ml-2 mr-2">
                    @foreach($jadwals as $s)
                    <div class="col-md-4 mt-4">
                        <div class="card shadow mb-6" style="border-radius: 20px">
                            <div class="card-body" href="/addSchedule">
                                <b><p class="card-text">{{ $s->type_conference }}</p></b>
                                <p class="card-text">Hari <span>{{ $s->days }}</span></p>
                                <p class="card-text">Date : {{ $s->time }}</p>
                                {{-- <p class="card-text">Category Class  : {{ $s->class_category }}</p> --}}
                                <a class="card-text">Link Converence : {{ $s->link_zoom }}</a>
                                {{-- <p class="card-text">Link Video Pembelajaran : {{ $c->video }}</p> --}}
                                <a data-toggle="modal" data-target="#modalUpdate{{ $s->id }}"
                                    class="btn btn-small text-success">
                                    <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                </a>
                                <a data-toggle="modal" data-target="#deleteData{{$s->id}}" class="btn btn-small text-danger"><i
                                        class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
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

            <!-- Add Data -->
        <div class="modal" tabindex="-1" id="addData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Schedule </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/scheduls/create" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Day</label>
                                <input type="text" name="day" id="day" class="form-control" placeholder="Day Meeting" aria-label="day" aria-describedby="basic-addon1">
                                @if($errors->has('day'))
                                <div class="text-danger">
                                    {{ $errors->first('day')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Category Conference</label>
                                <input type="text" name="tycon" id="tycon" class="form-control" placeholder="Category" aria-label="day" aria-describedby="basic-addon1">
                                @if($errors->has('tycon'))
                                <div class="text-danger">
                                    {{ $errors->first('tycon')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Time</label>
                                <input type="date" name="time" id="time" class="form-control" aria-label="date" aria-describedby="basic-addon1">
                                @if($errors->has('subject'))
                                <div class="text-danger">
                                    {{ $errors->first('subject')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Class Category</label>
                                <select class="custom-select my-1 mr-sm-2" id="class" name="class" class="form-control" placeholder="Class Category" aria-label="class" aria-describedby="basic-addon1"> 
                                    <option value="0" selected disabled>Choose...</option>
                                    @foreach ($classes as $c)
                                        <option value="{{ $c->category }}">
                                            {{ $c->category }}
                                        </option>
                                    @endforeach
                                </select> 
                                {{-- <input type="text" name="class" id="class" class="form-control" placeholder="Class Category" aria-label="class" aria-describedby="basic-addon1"> --}}

                            </div>

                            <div class="form-group">
                                <label>Link Zoom</label>
                                <input type="text" name="link" id="link" placeholder="Link Meeting" class="form-control" aria-label="video" aria-describedby="basic-addon1">

                            </div> 
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- End Add Modal -->

        <!-- Modal Delete -->
        @foreach($jadwals as $s)
        <div class="modal" tabindex="-1" id="deleteData{{$s->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Schedule </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini</p>
                    </div>
                    <div class="modal-footer">
                        <form action="scheduls/delete/{{$s->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- End Modal Delete -->

        <!-- Modal Update -->
        @foreach($jadwals as $s)
        <div class="modal" tabindex="-1" id="modalUpdate{{ $s->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Modul - {{$s->type_conference}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/scheduls/update/{{$s->id}}" enctype="multipart/form-data">

                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Days</label>
                                <input type="text" name="day" id="day" class="form-control" value="{{$s->days}}" aria-label="day" aria-describedby="basic-addon1">
                                @if($errors->has('basic'))
                                <div class="text-danger">
                                    {{ $errors->first('day')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Type Conference</label>
                                <input type="text" name="type" id="type" class="form-control" value="{{$s->type_conference}}" aria-label="type" aria-describedby="basic-addon1">
                                @if($errors->has('subject'))
                                <div class="text-danger">
                                    {{ $errors->first('subject')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Time</small></label>
                                <input type="date" name="time" id="time" value="{{$s->time}}" class="form-control" aria-label="video" aria-describedby="basic-addon1">
                            </div>


                            <div class="form-group">
                                <label>Class Category</label>
                                <select class="custom-select my-1 mr-sm-2" id="class" name="class" class="form-control" aria-label="class" aria-describedby="basic-addon1" value="{{ old('category')}}"> 
                                    <option value="0" selected disabled>Choose...</option>
                                    @foreach ($classes as $c)
                                        <option value="{{ $c->category }}">
                                            {{ $c->category }}
                                        </option>
                                    @endforeach
                                </select> 
                                {{-- <input type="text" name="class" id="class" class="form-control" value="{{$s->class_category}}" aria-label="class" aria-describedby="basic-addon1"> --}}
                                @if($errors->has('class'))
                                <div class="text-danger">
                                    {{ $errors->first('class')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Link Zoom</label>
                                <input type="text" name="link" id="link" class="form-control" value="{{$s->link_zoom}}" aria-label="link" aria-describedby="basic-addon1">
                                @if($errors->has('link'))
                                <div class="text-danger">
                                    {{ $errors->first('link')}}
                                </div>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        @endforeach
        <!-- End Modal UPDATE -->

        </div>
        <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
@endsection