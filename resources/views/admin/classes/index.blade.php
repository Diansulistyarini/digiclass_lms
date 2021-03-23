@extends('layouts/main')

@section('title', 'Data Class')

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
    <br>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="container">
        <div class="card shadow mt-4 mb-4">
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
                                <th scope="col" class="text-center">Category Class</th>
                                <th scope="col" class="text-center">Deskription Class</th>
                                <th scope="col" class="text-center">Instructor/Mentor</th>
                                <th scope="col" class="text-center">Image</th>
                                <th scope="col" class="text-center">Video</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($classes as $c)
                                <tr>
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <td class="text-center">{{ $c->category }}</td>
                                    <td class="text-center">{{ $c->deskripsi }}</td>
                                    <td class="text-center">{{ $c->name_ins }}</td>
                                    <td class="text-center">{{ $c->image }}</td>
                                    <td class="text-center">{{ $c->video }}</td>
                            
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#modalUpdate{{ $c->id }}" class="btn btn-small text-success">
                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                        </a>
                                        <a data-toggle="modal" data-target="#deleteData{{$c->id}}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- @if ($message = Session::get('sukses'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables
                    <span>
                        <a data-toggle="modal" data-target="#addData" class="text-primary float-right">
                            <i class="fas fa-plus"><span class="ml-2">Add Data</span></i>
                        </a>
                    </span>
                </h6>
            </div> --}}
            
            {{-- @if($classes->count() > 0)
            <div class="row ml-2 mr-2">
                @foreach($classes as $c)
                <div class="col-md-4 mt-4">
                    <div class="card shadow mb-4">
                        <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap" width="100" height="180">
                        <div class="card-body" href="/select/class">
                        <b><p class="card-text">{{ $c->category }}</p></b>
                        <p class="card-text">Deskripsi : {{ $c->deskripsi }}</p>
                        {{-- <p class="card-text">Link Video Pembelajaran : {{ $c->video }}</p> --}}
                        {{-- <a data-toggle="modal" data-target="#modalUpdate{{ $c->id }}"
                            class="btn btn-small text-success">
                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                        </a>
                        <a data-toggle="modal" data-target="#deleteData{{$c->id}}" class="btn btn-small text-danger"><i
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
            @endif --}}

            {{-- <div class="rows">
                <br>
                @foreach ($classes as $c)
                <div class="col">
                     <div class="card-group col-lg-3">
                    <div class="card">
                      <img class="card-img-top" src="{{ asset ('image_class/'. $c->image) }}" alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title" href="/" >{{ $c->category }}</h5>
                      </div>
                    </div>
                  </div>   
                </div>
            @endforeach

            </div> --}}
        </div>

        @foreach($classes as $s)
        <div class="modal" tabindex="-1" id="deleteData{{$s->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Class </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini</p>
                    </div>
                    <div class="modal-footer">
                        <form action="class/delete/{{$s->id}}" method="post">
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

        <!-- Modal Add Data User -->
        <div class="modal" tabindex="-1" id="addData">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Data Class </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/class/create" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="form-group"> 
                        <label>Category Class </label>
                        <input type="text" name="category" id="category" class="form-control" placeholder="Category Class" aria-label="category" aria-describedby="basic-addon1">
                            @if($errors->has('category'))
                                    <div class="text-danger">
                                        {{ $errors->first('category')}}
                                    </div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Descirpsi Class </label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" aria-label="deskripsi" aria-describedby="basic-addon1">
                            @if($errors->has('deskripsi'))
                                    <div class="text-danger">
                                        {{ $errors->first('deskripsi')}}
                                    </div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Instructor/Mentor</label>
                        <input type="text" name="name_ins" id="name_ins" class="form-control" placeholder="Instructor/Mentor" aria-label="deskripsi" aria-describedby="basic-addon1">
                            @if($errors->has('name_ins'))
                                    <div class="text-danger">
                                        {{ $errors->first('name_ins')}}
                                    </div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label>Image </label>
                        <input type="file" name="image" id="image" class="form-control" placeholder="Image " aria-label="image " aria-describedby="basic-addon1">
                            @if($errors->has('image'))
                                    <div class="text-danger">
                                        {{ $errors->first('image')}}
                                    </div>
                            @endif
                    </div>
                      
                    <div class="form-group">
                        <label>Video </label>
                        <input type="text" name="video" id="video" class="form-control" placeholder="Video" aria-label="video" aria-describedby="basic-addon1">
                            @if($errors->has('role'))
                                    <div class="text-danger">
                                        {{ $errors->first('role')}}
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
        @foreach($classes as $c)
        <div class="modal fade" id="modalUpdate{{ $c->id }}" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/class/update/{{$c->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input type="hidden" class="form-control" id="id" name="id" value="{{$c->id}}">
                        <div class="form-group">
                            <label for="">Category Class</label>
                            <input type="text" class="form-control" id="category" name="category" value="{{$c->category}}">
                        </div>
                        <div class="form-group">
                            <label for="">Deskription Class</label>
                            <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $c->deskripsi}}">
                        </div>
                        <div class="form-group">
                            <label for="">Instructor/Mentor</label>
                            <input type="text" class="form-control" id="name_ins" name="name_ins" value="{{ $c->name_ins}}">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{asset ('image_class/'.Auth::user()->image)}}">
                        </div>
                        <div class="form-group">
                            <label for="">Video</label>
                            <input type="text" class="form-control" id="video" name="video" value="{{ $c->video}}">
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

        <!-- Modal Delete -->
        @foreach($classes as $c)
        <div class="modal" tabindex="-1" id="deleteData{{$c->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Data </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda Yakin Ingin Menghapus Data Ini</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/class/destroy/{{$c->id}}" method="post">
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
         <!-- End Modal Delete  -->

    </div>
</div>
</div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection