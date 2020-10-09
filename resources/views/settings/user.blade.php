@extends('layouts.app')

@section('title')
    Manage Users
@endsection

@section('section')
<section id="app">
    <div class="content-wrapper">
                <div class="container-fluid">
                    <div class="page-header" style="display:flex;">
                        <em class="material-icons m-r-15">person</em><h2>Manage Users</h2>
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
                            <button type="button" class="btn btn-default btn-outline waves-effect m-r-15" data-toggle="modal" data-target="#addUser">Tambah Baru</button>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-30">
                            <div class="card">
                                <div class="body table-responsive">
                                    <table class="table table-hover" style="margin-bottom: 0;">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(data, index) in dataUser" :key="index">
                                            <th scope="row">@{{ index + 1 }}</th>
                                            <td>@{{ data.name }}</td>
                                            <td>@{{ data.email }}</td>
                                            <td>@{{ data.role }}</td>
                                            <td>
                                                <button class="btn btn-warning waves-effect" @click="editData(data)">
                                                    <i class="material-icons">mode_edit</i>
                                                </button>
                                                <button type="button" class="btn btn-danger waves-effect" @click="deleteData(data)">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- MODAL ADD NEW -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Form Tambah User</h4>
                        </div>
                        <form action="{{ route('settings.user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                            @csrf
                                    <div class="form-group m-b-10">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama Peserta" name="name" />
                                    </div>
                                    <div class="form-group m-b-10">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" />
                                    </div>
                                    <div class="form-group m-b-10">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" v-model="password" />
                                    </div>
                                    <div class="form-group m-b-10" :class="isPasswordAlert ? 'has-error' : ''">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control" placeholder="Konfirmasi Password" v-model="confirm_password" />
                                        <label class="control-label" v-show="isPasswordAlert ? true : false">Password tidak sama!</label>
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" size="1" name="role">
                                            <option disabled selected>Pilih Role</option>
                                            <option value="superadmin">Super Admin</option>
                                            <option value="admintabel">Admin Tabel</option>
                                            <option value="adminroulette">Admin Roulette</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" :disabled="isPasswordValid ? false : true" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MODAL ADD NEW -->
            <!-- MODAL EDIT -->
            <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                        </div>
                        <form :action="linkUpdate" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                            @csrf
                                    <div class="form-group m-b-10">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" placeholder="Nama Peserta" name="name" v-model="data.name" />
                                    </div>
                                    <div class="form-group m-b-10">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" v-model="data.email" />
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select class="form-control" size="1" name="role" v-model="data.role">
                                            <option disabled selected>Pilih Role</option>
                                            <option value="superadmin">Super Admin</option>
                                            <option value="admintabel">Admin Tabel</option>
                                            <option value="adminroulette">Admin Roulette</option>
                                        </select>
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
            <!-- END MODAL EDIT -->
            <!-- MODAL DELETE -->
            <div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            <h4 class="modal-title" id="myModalLabel">Delete User</h4>
                        </div>
                        <form :action="linkDelete" method="post" enctype="multipart/form-data" autocomplete="off">
                            <div class="modal-body">
                            {{ method_field('delete') }}
                            @csrf
                                    Apakah anda yakin ingin menghapus data?
                                    <input type="hidden" name="id" v-model="data.id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END MODAL DELETE -->
    </div>
</section>
@endsection

@section('script')
    <script>
        Vue.config.devtools = true;
        var app = new Vue({
            el: '#app',
            data: {
                password: "",
                confirm_password: "",
                isPasswordValid: false,
                isPasswordAlert: false,
                dataUser: @json($users),
                data: {},
                linkUpdate: null,
                linkDelete: null
            },
            watch: {
                confirm_password() {
                    if(this.confirm_password != this.password) {
                        this.isPasswordAlert = true;
                    } else {
                        this.isPasswordAlert = false;
                        this.isPasswordValid = true;
                    }
                }
            },
            methods: {
                editData(id) {
                    this.data = Object.assign({}, id);
                    let urlAgree = '{{ route("settings.user.update", ":id") }}';
                    urlAgree = urlAgree.replace(':id', this.data.id);
                    this.linkUpdate = urlAgree;
                    $('#editUser').modal('show')
                },
                deleteData(id) {
                    this.data = Object.assign({}, id);
                    let urlAgree = '{{ route("settings.user.delete", ":id") }}';
                    urlAgree = urlAgree.replace(':id', this.data.id);
                    this.linkDelete = urlAgree;
                    $('#deleteUser').modal('show')
                }
            }
        })
    </script>
@endsection