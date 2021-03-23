@extends('layouts/main')

@section('title', 'Modul')

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
        <div class="card shadow mb-4 mt-4">
            @if ($message = Session::get('sukses'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif
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
                                <th scope="col" class="text-center">Basic Competencies</th>
                                <th scope="col" class="text-center">Subject Matter</th>
                                <th scope="col" class="text-center">Learning Moduls</th>
                                <th scope="col" class="text-center">Video Tutorials</th>
                                <th scope="col" class="text-center">Class Category</th>
                                <th scope="col" class="text-center">Due Date</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modul as $m)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $m->basic_competencies }}</td>
                                <td class="text-center">{{ $m->subject_matter }}</td>
                                <td class="text-center"><button type="button" data-toggle="modal" data-target="#EModul{{ $m->id }}" class="btn btn-outline-dark">Learning Moduls</button><br>
                                </td>

                                <td class="text-center"><button type="button" data-toggle="modal" data-target="#videoModul{{ $m->id }}" class="btn btn-outline-dark">Video Tutorial</button></td>

                                <td class="text-center">{{ $m->class_category }}</td>
                                <td class="text-center">{{ $m->due_date }}</td>

                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#modalUpdate{{ $m->id }}" class="btn btn-small text-success">
                                        <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                    </a>
                                    <a data-toggle="modal" data-target="#modaldelete{{ $m->id }}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Video -->
        @foreach($modul as $m)
        <div class="modal" tabindex="-1" id="videoModul{{ $m->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Modul </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="https://www.youtube.com/embed/{{$m->video_tutorials}}"></iframe>
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

        <!-- Modal Video -->
        @foreach($modul as $m)
        <div class="modal" tabindex="-1" id="EModul{{ $m->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">E-Books - {{$m->subject_matter}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <embed src="{{asset('modul/'.$m->learning_moduls)}}" width="468" height="400" type=""></embed>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        @endforeach

        <!-- Modal Add Data User -->
        <div class="modal" tabindex="-1" id="addData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Modul </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/moduled/create" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Basic Competencies </label>
                                <input type="text" name="basic" id="basic" class="form-control" placeholder="Basic Competencies" aria-label="basic" aria-describedby="basic-addon1">
                                @if($errors->has('basic'))
                                <div class="text-danger">
                                    {{ $errors->first('basic')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Subject Matter</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject Matter" aria-label="subject" aria-describedby="basic-addon1">
                                @if($errors->has('subject'))
                                <div class="text-danger">
                                    {{ $errors->first('subject')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Learning Modul <small>*type file PDF / doc </small> </label>
                                <input type="file" name="learning" id="learning" class="form-control" placeholder="Learning Modul" aria-label="learning" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Video Tutorials <small>*Link Youtube</small></label>
                                <input type="text" name="video" id="video" placeholder="Learning Video" class="form-control" aria-label="video" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Class Category</label>
                                <select class="custom-select my-1 mr-sm-2" id="class" name="class" class="form-control" placeholder="Class Category" aria-label="class" aria-describedby="basic-addon1"> 
                                    <option value="0" selected disabled>Choose...</option>
                                    @foreach ($class as $c)
                                        <option value="{{ $c->caategory }}">
                                            {{ $c->category }}
                                        </option>
                                    @endforeach
                                </select> 
                                @if($errors->has('class'))
                                <div class="text-danger">
                                    {{ $errors->first('class')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" name="due" id="due" class="form-control" placeholder="Due Date" aria-label="due" aria-describedby="basic-addon1">
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

        <!-- Modal Update -->
        @foreach($modul as $m)
        <div class="modal" tabindex="-1" id="modalUpdate{{ $m->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Modul - {{$m->basic_competencies}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/moduled/update/{{$m->id}}" enctype="multipart/form-data">
                            
                        @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Basic Competencies </label>
                                <input type="text" name="basic" id="basic" class="form-control" value="{{$m->basic_competencies}}" aria-label="basic" aria-describedby="basic-addon1">
                                @if($errors->has('basic'))
                                <div class="text-danger">
                                    {{ $errors->first('basic')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Subject Matter</label>
                                <input type="text" name="subject" id="subject" class="form-control" value="{{$m->subject_matter}}" aria-label="subject" aria-describedby="basic-addon1">
                                @if($errors->has('subject'))
                                <div class="text-danger">
                                    {{ $errors->first('subject')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Learning Modul <small>*type file PDF / doc </small> </label>
                                <input type="file" name="learning" id="learning" class="form-control" value="{{$m->learning_moduls}}" aria-label="learning" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Video Tutorials <small>*Link Youtube</small></label>
                                <input type="text" name="video" id="video" value="{{$m->video_tutorials}}" class="form-control" aria-label="video" aria-describedby="basic-addon1">

                            </div>

                            <div class="form-group">
                                <label>Class Category</label>
                                <select class="custom-select my-1 mr-sm-2" id="class" name="class" class="form-control" aria-label="class" aria-describedby="basic-addon1" value="{{ old('category')}}"> 
                                    <option value="0" selected disabled>Choose...</option>
                                    @foreach ($class as $c)
                                        <option value="{{ $c->category }}">
                                            {{ $c->category }}
                                        </option>
                                    @endforeach
                                </select> 
                                @if($errors->has('class'))
                                <div class="text-danger">
                                    {{ $errors->first('class')}}
                                </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" name="due" id="due" class="form-control" placeholder="Due Date" aria-label="due" aria-describedby="basic-addon1">
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

        <!-- Modal Delete -->
        @foreach($modul as $m)
        <div class="modal" tabindex="-1" id="modaldelete{{ $m->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">E-Books - {{$m->subject_matter}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/module/delete/{{ $m->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>    
                    </div>
                </div>
                </form>
            </div>
        </div>
        @endforeach

    </div>
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection