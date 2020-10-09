@extends('layouts.app')

@section('title')
    Kocok Undian Tabel
@endsection

@section('section')
<section id="app">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="page-header">
                        <h2>Kocok Undian Tabel</h2>
                        <h5>Undian atas nama: {{ $participants->name }}</h5>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12" v-for="(data, index) in dataPrizes" :key="data.id">
                            <div class="card">
                                <div :class="idActive == data.id ? 'card--active' : data.is_taken != null ? 'card--active-green' : ''" class="body" v-if="data.is_taken != null">
                                    <img :src="data.file != null ? '{{ asset('storage') }}/' + data.file : '{{ asset('images/widget/3.jpg') }}'" alt="Random Prize" style="width: 100%; height: 125px;">
                                </div>
                                <div :class="idActive == data.id ? 'card--active' : ''" class="body has__center" style="width: 100%; height: 165px;" v-else>
                                    <img :src="data.file != null ? '{{ asset('storage') }}/' + data.file : '{{ asset('images/widget/3.jpg') }}'" alt="Random Prize" style="width: 100%; height: 125px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 has__center--horizontal">
                            <button class="btn btn-primary waves-effect text-uppercase m-t-15 btn__submit" @click="onClick" :disabled="loading ? true : false">
                                <div v-if="!loading">Kocok Undian</div>
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
                            <button type="button" class="btn btn-default btn-outline waves-effect m-t-15 m-l-15 btn__submit" @click="stopRandom">Selesai</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODAL ADD NEW -->
            <div class="modal fade" id="newChoosen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Selamat {{ $participants->name }}!</h4>
                        </div>
                        <div class="modal-body">
                            Selamat {{ $participants->name }} Mendapatkan @{{ choosenPrize.name }}!!
                        </div>
                        <div class="modal-footer">
                            <form :action="onDecision" method="POST" enctype="multipart/form-data" style="display:contents;">
                            @csrf
                                <input type="hidden" name="is_taken" value="">
                                <button type="submit" class="btn btn-default">Batal</button>
                            </form>
                            <form :action="onDecision" method="POST" enctype="multipart/form-data" style="display:contents;">
                            @csrf
                                <input type="hidden" name="is_taken" value="1">
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
                dataPrizes: [],
                namePrize: "",
                choosenPrize: {},
                loading: false,
                onDecision: "",
                idActive: null,
                intervalAnimation: null,
                timeoutRandom: null
            },
            mounted() {
                this.dataPrizes = @json($prizes);
            },
            methods: {
                stopRandom() {
                    clearTimeout(this.timeoutRandom);
                    this.namePrize = "";
                    this.nameParticipants = "";
                    let tmpIsTaken = this.dataPrizes.filter(x => x.is_taken == null);
                    let tmpChoosen = Math.floor(Math.random() * tmpIsTaken.length);
                    let tmpFind = this.dataPrizes.find(x => x.id == tmpIsTaken[tmpChoosen].id);
                    let tmpIndexFind = this.dataPrizes.indexOf(tmpFind);
                    this.choosenPrize = this.dataPrizes[tmpIndexFind];
                    this.namePrizes = this.dataPrizes[tmpIndexFind].name;
                    this.dataPrizes[tmpIndexFind].is_taken = 1;
                    this.loading = false;
                    this.idActive = this.dataPrizes[tmpIndexFind].id;
                    clearInterval(this.intervalAnimation);
                    // PLACEHOLDER
                    let urlAgree = '{{ route("random.lottery-table.choose", ":id") }}';
                    urlAgree = urlAgree.replace(':id', this.choosenPrize.id);
                    this.onDecision = urlAgree;
                    $('#newChoosen').modal({
                        show: 'true',
                        backdrop: 'static', 
                        keyboard: false
                    });
                },
                onClick() {
                    this.loading = true;
                    this.namePrize = "";
                    this.nameParticipants = "";
                    this.intervalAnimation = setInterval(() => {
                        let tmpChoosen = Math.floor(Math.random() * this.dataPrizes.length);
                        let tmpFind = this.dataPrizes.find(x => x.id == this.dataPrizes[tmpChoosen].id);
                        let tmpIndexFind = this.dataPrizes.indexOf(tmpFind);
                        this.idActive = this.dataPrizes[tmpChoosen].id;
                    }, 16);
                    this.timeoutRandom = setTimeout(() => {
                        let tmpChoosen = Math.floor(Math.random() * this.dataPrizes.length);
                        let tmpFind = this.dataPrizes.find(x => x.id == this.dataPrizes[tmpChoosen].id);
                        let tmpIndexFind = this.dataPrizes.indexOf(tmpFind);
                        this.choosenPrize = this.dataPrizes[tmpChoosen];
                        this.namePrizes = this.dataPrizes[tmpChoosen].name;
                        this.dataPrizes[tmpChoosen].is_taken = 1;
                        this.loading = false;
                        this.idActive = this.dataPrizes[tmpChoosen].id;
                        clearInterval(this.intervalAnimation);
                        // PLACEHOLDER
                        let urlAgree = '{{ route("random.lottery-table.choose", ":id") }}';
                        urlAgree = urlAgree.replace(':id', this.choosenPrize.id);
                        this.onDecision = urlAgree;
                        $('#newChoosen').modal({
                            show: 'true',
                            backdrop: 'static', 
                            keyboard: false
                        });
                    }, 10000);
                }
            }
        })
    </script>
@endsection
