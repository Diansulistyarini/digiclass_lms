@extends('layouts/main')

@section('title', 'Instructor Data')

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
                                                <th scope="col" class="text-center">Nama</th>
                                                <th scope="col" class="text-center">Email</th>
                                                <th scope="col" class="text-center">Gender</th>
                                                <th scope="col" class="text-center">Phone</th>
                                                <th scope="col" class="text-center">Role</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $u)
                                                <tr>
                                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $u->name }}</td>
                                                    <td class="text-center">{{ $u->email }}</td>
                                                    <td class="text-center">{{ $u->gender }}</td>
                                                    <td class="text-center">{{ $u->phone }}</td>
                                                    <td class="text-center">{{ $u->role }}</td>
                                            
                                                    <td class="text-center">
                                                        <a data-toggle="modal" data-target="#modalUpdate{{ $u->id }}" class="btn btn-small text-success">
                                                            <i class="fa fa-edit"></i><span class="ml-2">Edit</span>
                                                        </a>
                                                        <a data-toggle="modal" data-target="#deleteData{{$u->id}}" class="btn btn-small text-danger"><i class=" fa fa-trash"></i><span class="ml-2">Delete</span></a>
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
                                    <h5 class="modal-title">Add Data Instructor </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="/user/create">
                                        {{ csrf_field() }}
                                    <div class="form-group"> 
                                        <label>Name </label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" aria-label="Name" aria-describedby="basic-addon1">
                                            @if($errors->has('name'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('name')}}
                                                    </div>
                                            @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email </label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Your Email" aria-label="Name" aria-describedby="basic-addon1">
                                            @if($errors->has('email'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('email')}}
                                                    </div>
                                            @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password </label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password " aria-label="Password " aria-describedby="basic-addon1">
                                            @if($errors->has('password'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('password')}}
                                                    </div>
                                            @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Gender </label>
                                        <select class="custom-select my-1 mr-sm-2" id="gender" name="gender" value="{{ old('gender') }}">
                                            <option selected>Choose...</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                            @if($errors->has('gender'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('gender')}}
                                                    </div>
                                            @endif
                                    </div>
                                      
                                    <div class="form-group">  
                                        <label>Phone </label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" aria-label="Phone" aria-describedby="basic-addon1">
                                            @if($errors->has('phone'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('phone')}}
                                                    </div>
                                            @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Role </label>
                                        <input type="text" name="role" id="role" class="form-control" placeholder="Role" aria-label="Role" aria-describedby="basic-addon1">
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
                        @foreach($users as $u)
                        <div class="modal fade" id="modalUpdate{{ $u->id }}" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Data Instructor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="/user/update/{{$u->id}}" >
                                            @csrf
                                            @method('put')
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{$u->id}}">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$u->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ $u->email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select class="custom-select my-1 mr-sm-2" id="gender" name="gender" value="{{ $u->gender }}"> 
                                                <option selected >Choose...</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $u->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Role</label>
                                            <input type="text" class="form-control" id="role" name="role" value="{{ $u->role}}">
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
                        @foreach($users as $u)
                        <div class="modal" tabindex="-1" id="deleteData{{$u->id}}">
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
                                        <form action="/user/destroy/{{$u->id}}" method="post">
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
