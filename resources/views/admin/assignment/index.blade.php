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
                                        <i class="fa fa-star"></i><span class="ml-2">Score</span>
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

        <div class="modal" tabindex="-1" id="addData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Assignment </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/ass/create" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" aria-label="name" aria-describedby="basic-addon1">
                                @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Class Category</label>
                                <input type="text" name="class" id="class" class="form-control" aria-label="cclass" aria-describedby="basic-addon1">
                                @if($errors->has('class'))
                                <div class="text-danger">
                                    {{ $errors->first('class')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Subject Matter</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject Matter" aria-label="class" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Online Text</label>
                                <input type="text" name="online" id="online" placeholder="Link Penugasan" class="form-control" aria-label="online" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>File Assignment</label>
                                <input type="file" name="file" id="file" class="form-control" aria-label="file" aria-describedby="basic-addon1">

                            </div>


                            <div class="form-group">
                                <label>Date</label>
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
        <!-- end -->

        @foreach($ass as $s)
        <div class="modal" tabindex="-1" id="deleteData{{$s->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Assignment </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini</p>
                    </div>
                    <div class="modal-footer">
                        <form action="ass/delete/{{$s->id}}" method="post">
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
        @foreach($ass as $a)
        <div class="modal" tabindex="-1" id="modalNilai{{ $a->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Modul - {{$a->subject_matter}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/ass/update/{{$a->id}}" enctype="multipart/form-data">

                            @csrf
                            @method('put')

                            <div class="form-group">
                                <!-- <label>Name</label> -->
                                <input type="hidden" name="name" id="name" value="{{$a->name}}" class="form-control" placeholder="Name" aria-label="name" aria-describedby="basic-addon1">
                                @if($errors->has('name'))
                                <div class="text-danger">
                                    {{ $errors->first('name')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <!-- <label>Class Category</label> -->
                                <input type="hidden" name="class" value="{{$a->class_category}}" id="class" class="form-control" aria-label="cclass" aria-describedby="basic-addon1">
                                @if($errors->has('class'))
                                <div class="text-danger">
                                    {{ $errors->first('class')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <!-- <label>Subject Matter</label> -->
                                <input type="hidden" value="{{$a->subject_matter}}" name="subject" id="subject" class="form-control" placeholder="Subject Matter" aria-label="class" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <!-- <label>Online Text</label> -->
                                <input type="hidden" name="online" id="online" value="{{$a->online_text}}" class="form-control" aria-label="online" aria-describedby="basic-addon1">

                            </div>
<!-- 
                            <div class="form-group">
                                <label>File Assignment <small>*mohon input ulang file</small></label>
                                <input type="file" name="file" id="file" value=" {{$a->file}}"class="form-control" aria-label="file" aria-describedby="basic-addon1">

                            </div> -->


                            <div class="form-group">
                                <label>Date</label>
                                <input type="hidden" value="{{$a->date}}" name="due" id="due" class="form-control" aria-label="due" aria-describedby="basic-addon1">
                                @if($errors->has('due'))
                                <div class="text-danger">
                                    {{ $errors->first('due')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Scoree Assignment</label>
                                <input type="text"  name="score" id="score" class="form-control" aria-label="score" aria-describedby="basic-addon1">
                                @if($errors->has('score'))
                                <div class="text-danger">
                                    {{ $errors->first('score')}}
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