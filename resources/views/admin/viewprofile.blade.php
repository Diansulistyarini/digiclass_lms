@extends('layouts/main')

@section('title', 'View Profile')

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

                        </div>
                    </div>
                </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @if ($message = Session::get('sukses'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                            <!-- Card -->
                            <div class="card" style="width: 300px;margin-left:15%">
                                @if (Auth::user()->photo == null)
                                <img class="card-img-top img-fluid" src="{{ asset ('photo/user.png') }}" alt="user-image">
                                @else
                                <img class="card-img-top img-fluid" src="{{ asset ('photo/'.Auth::user()->photo) }}" alt="user-image" >
                                @endif
                            </div>
                            {{-- <div class="card">
                            @foreach($users as $u)
                                <img class="card-img-top img-fluid" src="{{ asset ('photo/'. $u->photo) }}" alt=" {{ $u->photo }}">
                            @endforeach
                            </div> --}}
                            <!-- Card -->
                    </div>
            
                    <div class="col-lg-6 col-md-6">
                        @foreach($users as $u)
                        <div class="card-header">
                            {{ Auth::user()->name }}'s Details
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name : {{ Auth::user()->name }}</li>
                            <li class="list-group-item">Email : {{ Auth::user()->email }}</li>
                            <li class="list-group-item">Phone : {{ Auth::user()->phone }}</li>
                            <li class="list-group-item">Gender : {{ Auth::user()->gender }}</li>
                            {{-- <li class="list-group-item">Category Class : {{ Auth::user()->class }}</li> --}}
                        </ul>
                        <br>
                        <button type="submit" data-toggle="modal" data-target="#setProfile{{ $u->id }}" name="update_profile" class="btn btn-outline-secondary">Setting Profile</button>
                        <br>    
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @endforeach   
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
            </div>
            <!-- End Page wrapper  -->

            <!-- Modal Set Data  -->
            {{-- @foreach($users as $u) --}}
                        <div class="modal fade" id="setProfile{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="modalUpdate" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Setting Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" method="post" action="/setprofile/{{$u->id}}" >
                                            @csrf
                                            @method('put')
                                            <input type="hidden" class="form-control" id="id" name="id" value="{{ Auth::user()->id }}">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Gender</label>
                                            <select class="custom-select my-1 mr-sm-2" id="gender" name="gender" value="{{ Auth::user()->gender }}"> 
                                                <option selected >Choose...</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Photo</label>
                                            <input type="file" id="photo" name="photo">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="">Category Class</label>
                                            <input type="text" class="form-control" id="class" name="class" value="{{ Auth::user()->class }}">
                                        </div> --}}
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
                        {{-- @endforeach --}}
                        <!-- End Modal -->
@endsection