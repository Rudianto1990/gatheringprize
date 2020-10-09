@extends('layouts.app')

@section('title')
    Acak Nama
@endsection

@section('section')
<section id="app">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="page-header">
                        <h2>Acak Nama</h2>
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
                    @if(\Session::has('warning'))
                    <div class="col-md-12">
                        <div class="alert dark alert-icon alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="material-icons">info_outline</i>
                            {{\Session::get('warning')}}
                        </div>
                    </div>
                    @endif
                    <div class="row clearfix">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="body" style="padding: 65px 50px;">
                                    <!-- <form> -->
                                        <div class="form-group m-b-10">
                                        <label>Nama Peserta</label>
                                            <input type="text" class="form-control" placeholder="Nama Peserta" name="name" v-model="name" disabled />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-outline waves-effect btn-block text-uppercase m-t-15" @click="onClick" :disabled="loading ? true : false">
                                            <div v-if="!loading">Acak Nama</div>
                                            <div class="preloader icon__preloader" v-else>
                                                <div class="spinner-layer spinner-default">
                                                    <div class="circle-clipper fl-left">
                                                        <div class="circle"></div>
                                                    </div>
                                                    <div class="circle-clipper fl-right">
                                                        <div class="circle"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            </button>
                                            <button type="button" class="btn btn-default btn-outline waves-effect btn-block" style="margin-top: 20px !important;" @click="stopRandom">Selesai</button>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                </div>
            </div>
            <!-- MODAL ADD NEW -->
            <div class="modal fade" id="newChoosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Selamat @{{ name }}!</h4>
                        </div>
                        <div class="modal-body">
                            Silahkan @{{ name }} Memilih Hadiah Sebagai Berikut!!
                        </div>
                        <div class="modal-footer">
                            <form :action="onDecision" method="POST" enctype="multipart/form-data" style="display:contents;">
                            @csrf
                                <input type="hidden" name="is_choosen" value="0">
                                <button type="submit" class="btn btn-default">Batal</button>
                            </form>
                            <form :action="onDecision" method="POST" enctype="multipart/form-data" style="display:contents;">
                            @csrf
                                <input type="hidden" name="is_choosen" value="1">
                                <button type="submit" class="btn btn-primary">Lanjut</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MODAL ADD NEW -->
        </section>
@endsection

@section('script')
    <script>
        Vue.config.devtools = true;
        var app = new Vue({
            el: '#app',
            data: {
                dataName: [],
                choosenData: {},
                name: "",
                loading: false,
                onDecision: "",
                timeoutRandom: null
            },
            mounted() {
                this.dataName = @json($participants);
            },
            methods: {
                stopRandom() {
                    clearTimeout(this.timeoutRandom);
                    this.loading = true;
                    this.name = "";
                    let tmpChoosen = Math.floor(Math.random() * this.dataName.length);
                        this.choosenData = this.dataName[tmpChoosen];
                        this.name = this.dataName[tmpChoosen].name;
                        this.loading = false;
                        // AGREE PLACEHOLDER ROUTE
                        let urlAgree = '{{ route("random.name.choose", ":id") }}';
                        urlAgree = urlAgree.replace(':id', this.choosenData.id);
                        this.onDecision = urlAgree;
                        $('#newChoosen').modal({
                            show: 'true',
                            backdrop: 'static', 
                            keyboard: false
                        });
                },

                onClick() {
                    this.loading = true;
                    this.name = "";
                    this.randomName = setTimeout(() => {
                        let tmpChoosen = Math.floor(Math.random() * this.dataName.length);
                        this.choosenData = this.dataName[tmpChoosen];
                        this.name = this.dataName[tmpChoosen].name;
                        this.loading = false;
                        // AGREE PLACEHOLDER ROUTE
                        let urlAgree = '{{ route("random.name.choose", ":id") }}';
                        urlAgree = urlAgree.replace(':id', this.choosenData.id);
                        this.onDecision = urlAgree;
                        $('#newChoosen').modal({
                            show: 'true',
                            backdrop: 'static', 
                            keyboard: false
                        });
                    }, 10000);
                }
            }
        });
    </script>
@endsection