@extends('layouts.app')

@section('title')
    List Participants
@endsection

@section('styles')
    <link href="{{asset('plugins/file-input/css/jasny-bootstrap.css')}}" rel="stylesheet" />
@endsection

@section('section')
<section>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="page-header" style="display:flex;">
                        <em class="material-icons m-r-15">card_giftcard</em><h2>List Hadiah</h2>
                    </div>
                    @if(\Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert dark alert-icon bg-green alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="material-icons">info_outline</i>
                            {{\Session::get('success')}}
                        </div>
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert dark bg-red alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-30" style="display:flex;">
                            <button type="button" class="btn btn-default btn-outline waves-effect m-r-15" data-toggle="modal" data-target="#addPrizes">Tambah Baru</button>
                            <button type="button" class="btn btn-default btn-outline waves-effect m-r-15" data-toggle="modal" data-target="#importExcel">Upload Excel</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-30">
                            <div class="card">
                                <div class="body table-responsive">
                                    <table class="table table-hover" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Hadiah</th>
                                            <th>Gambar</th>
                                            <th>Ukuran</th>
                                            <th>Type</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prizes as $key => $prize)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$prize->name}}</td>
                                            <td>{{$prize->file}}</td>
                                            <td>{{$prize->size}}</td>
                                            <td>{{$prize->type}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="float: right;">
                                    {!! $prizes->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL ADD NEW -->
            <div class="modal fade" id="addPrizes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Hadiah</h4>
                        </div>
                        <form action="{{ route('lists.prizes.post') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group m-b-10">
                                    <label>Nama Hadiah</label>
                                    <input type="text" class="form-control" placeholder="Nama Peserta" name="name" />
                                </div>
                                <div class="form-group m-b-10">
                                    <label>Ukuran</label>
                                    <input type="text" class="form-control" placeholder="Ukuran" name="size" />
                                </div>
                                <div class="form-group m-b-10">
                                    <label>Type</label>
                                    <select class="form-control" size="1" name="type">
                                        <option disabled selected>Pilih Type</option>
                                        <option value="ALL">ALL</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MODAL ADD NEW -->
            <!-- MODAL IMPORT -->
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload Excel</h4>
                        </div>
                        <form action="{{ route('lists.prizes.import-excel') }}" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                            @csrf
                                <div class="form-group m-b-10">
                                    <label>Excel</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MODAL IMPORT -->
        </section>
@endsection

@section('script')
    <script src="{{asset('plugins/file-input/js/jasny-bootstrap.js')}}"></script>
@endsection