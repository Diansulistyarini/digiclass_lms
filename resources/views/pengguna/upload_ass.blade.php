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

            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning Jason!</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                        <option selected>Aug 19</option>
                        <option value="1">July 19</option>
                        <option value="2">Jun 19</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="container">
        <!-- DataTales Example -->
        @foreach($modul as $m)
        <div class="card">
            <div class="card-header">
                Upload Tugas
            </div>
            <div class="card-body">
                <table class="table table-striped">
                <form action="/ass/create" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <tr>
                        <td>
                            <p>Name</p>
                        </td>
                        <td>
                            <p>{{ Auth::user()->name }}</p>
                            <input type="hidden" name="name" id="name" value="{{ Auth::user()->name }}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Class Category </p>
                        </td>
                        <td>
                            <p>{{$m->class_category}}</p>
                            <input type="hidden" name="class" id="class" value="{{$m->class_category}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Asigment Title</p>
                        </td>
                        <td>
                            <p>{{$m->subject_matter}}</p>
                            <input type="hidden" name="subject" id="suvject" value="{{$m->subject_matter}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Online Text - <small>*Link Blog / Youtube</small></p>
                        </td>
                        <td>
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder="Link" aria-label="Link" id="online" name="online" aria-describedby="basic-addon1">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>File Asignment</p>
                        </td>
                        <td>
                            <input type="file" name="file" id="file" class="btn btn-secondary">
                            <!-- <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                Pilih File
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Drop the file here</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore reiciendis atque nostrum perspiciatis repellendus assumenda non quas itaque consequuntur. Perspiciatis omnis quis quos neque cum veritatis porro officia fuga totam.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Submit Date</p>
                        </td>
                        <td>
                            <p><?php
                                    $tanggal = mktime(date("m"), date("d"), date("Y"));
                                    echo date("d-M-Y", $tanggal);
                                ?>
                                <input type="hidden" name="date" id="date" value="$tanggal">   
                                
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <button type="submit">Submit</button>
                        </td>
                        <td>
                            <button title="Silahkan Submit Disini" class="btn btn-danger" id="btn-submit">
                                Delete</button>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    @endsection