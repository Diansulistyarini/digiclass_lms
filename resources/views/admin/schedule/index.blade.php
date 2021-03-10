@extends('layouts/main')

@section('title', 'Schedule')

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
                                <th scope="col" class="text-center">Day</th>
                                <th scope="col" class="text-center">Type Conference</th>
                                <th scope="col" class="text-center">Time</th>
                                <th scope="col" class="text-center">Class Category</th>
                                <th scope="col" class="text-center">Link Zoom</th>
                                <th scope="col" class="text-center">due_date</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule as $s)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $s->days }}</td>
                                <td class="text-center">{{ $s->type_conference }}</td>
                                <td class="text-center">{{ $s->time }}</td>
                                <td class="text-center">{{ $s->class_category }}</td>
                                <td class="text-center">{{ $s->link_zoom }}</td>
                                <td class="text-center">{{ $s->due_date }}</td>

                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#modalUpdate{{ $s->id }}" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <a data-toggle="modal" data-target="#deleteData{{ $s->id }}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

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
                        <form method="post" action="/schedule/create" enctype="multipart/form-data">
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
                                <input type="text" name="class" id="class" class="form-control" placeholder="Class Category" aria-label="class" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Link Zoom</label>
                                <input type="text" name="link" id="link" placeholder="Link Meeting" class="form-control" aria-label="video" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Due Date Meeting</label>
                                <input type="date" name="due" id="due" class="form-control" aria-label="due" aria-describedby="basic-addon1">
                                @if($errors->has('due'))
                                <div class="text-danger">
                                    {{ $errors->first('due')}}
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
        <!-- End Add Modal -->


        @foreach($schedule as $s)
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
                        <form action="schedule/delete/{{$s->id}}" method="post">
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


        <!-- Modal Update -->
        @foreach($schedule as $s)
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
                        <form method="post" action="/schedule/update/{{$s->id}}" enctype="multipart/form-data">

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
                                <input type="text" name="class" id="class" class="form-control" value="{{$s->class_category}}" aria-label="class" aria-describedby="basic-addon1">
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

                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" name="due" id="due" class="form-control" placeholder="Due Date" aria-label="due" aria-describedby="basic-addon1" value="{{$s->due_date}}">
                                @if($errors->has('due'))
                                <div class="text-danger">
                                    {{ $errors->first('due')}}
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
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection