@extends('layouts/main')

@section('title', 'Lesson')

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
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="container">
            <!-- DataTales Example -->
                        <div class="card shadow mb-4">
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
                                                <th scope="col" class="text-center">Subject Nama</th>
                                                <th scope="col" class="text-center">Class Category</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lesson as $l)
                                                <tr>
                                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $l->subject_name }}</td>
                                                    <td class="text-center">{{ $l->class_category }}</td>
                                                    <td class="text-center">
                                                        <a data-toggle="modal" data-target="#modalUpdate{{ $l->id }}" class="btn btn-small text-success">
                                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                                        </a>
                                                        <a href="/lesson/destroy/{{ $l->id }}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            
                        <!-- Modal Add Data User -->
                        <div class="modal" tabindex="-1" id="addData">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Data Lesson </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/lesson/create">
                                        {{ csrf_field() }}
                                    <div class="form-group"> 
                                        <label>Subject Name </label>
                                        <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="Subject Name" aria-label="subject_name" aria-describedby="basic-addon1">
                                            @if($errors->has('subject_name'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('subject_name')}}
                                                    </div>
                                            @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Class Category </label>
                                        <input type="text" name="class_category" id="class_category" class="form-control" placeholder="Class Category" aria-label="class_category" aria-describedby="basic-addon1">
                                            @if($errors->has('class_category'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('class_category')}}
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
                        @foreach($lesson as $l)
                        <div class="modal fade" id="modalUpdate{{ $l->id }}" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Lesson</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/lesson/update/{{ $l->id }}" >
                                            @csrf
                                            @method('put')
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $l->id }}">
                                        <div class="form-group">
                                            <label for="">Subject Name</label>
                                            <input type="text" class="form-control" id="subject_name" name="subject_name" value="{{ $l->subject_name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Class Category</label>
                                            <input type="text" class="form-control" id="class_category" name="class_category" value="{{ $l->class_category }}">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                        </form>
                                        <!--END FORM UPDATE -->
                                    </div>
                                </div>
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
