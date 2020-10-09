@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('section')
<section>
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="page-header">
                        <h2>Dashboard</h2>
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
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-30">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="https://everestviewtravels.com.au/everestview/wp-content/uploads/2017/12/bali-banner-1550x360px-1024x238.jpg" class="banner__dashboard" />
                                    </div>
                                    <div class="item">
                                        <img src="http://www.ihinaventures.in/wp-content/uploads/2018/05/home-banner5.jpg?x41072" class="banner__dashboard" />
                                    </div>
                                    <div class="item">
                                        <img src="https://www.kebunkitabali.com/wp-content/uploads/2017/06/banner-4.jpg" class="banner__dashboard" />
                                    </div>
                                </div>
                                            
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <h2>List Pemenang Hadiah</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-12 m-b-10">
                            <a href="{{ route('home.export') }}" target="_blank" class="btn btn-default btn-outline waves-effect m-r-15">Export Excel</a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="body table-responsive">
                                    <table class="table table-hover" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemenang</th>
                                            <th>Hadiah</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($participants as $key => $participant)
                                        <tr>
                                            <th scope="row">{{$key + 1}}</th>
                                            <td>{{$participant->name}}</td>
                                            <td>{{$participant->prizes->name}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div style="float: right;">
                                    {{ $participants->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
