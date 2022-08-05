@extends('layouts.main')

@section('title', 'Jadwal')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Jadwal') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Jadwal') }}</li>
        </ol>
    </div>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">


@endsection

@section('main')
    @if (session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('Data Jadwal') }}
                    </h3>
                </div>
                <div class="card-body">

                        <div class="table-responsive">

                            <table id="mytable" class="table table-hover">
                                <thead>
                                <tr>
                                    <th >NO</th>
                                    <th >Peserta</th>
                                    <th >Jemput </th>
                                    <th >Jadwal</th>
                                    <th >Aksi</th>
                                </tr>
                                </thead>

                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div  id="modalEdit" class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update" >
                    <div class="modal-body">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                            <label >Peserta</label>
                            <select name="id_peserta" id="id_peserta" class="form-control" required>
                                <option value="">Pilih </option>
                                @foreach($peserta as $list)
                                    <option value="{{ $list->id }}">{{ $list->name}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Jemput</label>
                                    <select class="form-control" id="jemput" name="jemput" required>
                                        <option value="1"> Ya</option>
                                        <option value="0"> Tidak </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Biaya Jemput</label>
                                    <input type="text" class="form-control biaya_jemput" name="biaya_jemput" placeholder="Biaya Jemput" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SIM</label>
                                    <select class="form-control" id="sim" name="sim" required>
                                        <option value="1"> Ya</option>
                                        <option value="0"> Tidak </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label >Biaya SIM</label>
                                    <input type="text" class="form-control biaya_sim" name="biaya_sim" placeholder="Biaya SIM" >
                                </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <label >Diskon</label>
                            <input type="text" class="form-control diskon" name="diskon" placeholder="Diskon" >
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1"> Aktif</option>
                                <option value="0"> Tidak Aktif </option>
                            </select>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Update </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal </button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div  id="modalEditBayar" class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="update" >
                    <div class="modal-body">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                            <label >Jumlah Bayar</label>
                            <input type="text" class="form-control jumlah" name="jumlah"  id="jumlah"placeholder="Jumlah" required>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Update </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal </button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div  id="modalAdd" class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="store" data-toggle="validator" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="id_kursus" class="id_kursus" id="id_kursus">

                        <div class="form-group">
                            <label >Instruktur</label>
                            <select name="id_instruktur" id="id_instruktur" class="form-control" required>
                                <option value="">Pilih </option>
                                @foreach($instruktur as $list)

                                    <option value="{{ $list->id }} ">{{ $list->name}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label >Mobil</label>
                            <select name="id_mobil" id="id_mobil" class="form-control" required>
                                <option value="">Pilih </option>
                                @foreach($mobil as $list)

                                    <option value="{{ $list->id }} ">{{ $list->merk_mobil}}</option>

                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control tanggal" id="tanggal" placeholder="Tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" class="form-control jam_mulai" id="jam_mulai" placeholder="Jam Mulai" required>
                        </div>
                        <div class="form-group">
                            <label for="jam_akhir">jam Akhir</label>
                            <input type="time" class="form-control jam_akhir" id="jam_akhir" placeholder="Jam Akhir" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Aktif"> Aktif</option>
                                <option value="Tidak Aktif"> Tidak Aktif </option>
                            </select>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal </button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>




    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">

        "use strict";

        $(function () {
           // $('#jam_mulai').datetimepicker();
           // $('#jam_akhir').datetimepicker();

            $('#mytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('jadwal.get_data') }}",
                columns: [
                    {data:'DT_RowIndex'},
                    {data:'peserta'},
                    {data:'jemput'},
                    {data:'jadwal'},
                    {data:'action', orderable:false, searchable:false},
                ]
            });

            function refresh() {
                var table = $('#mytable').DataTable();
                table.ajax.reload(null, false);
            }

            function cleaner() {
                $('.id').val('');
                $('.kategori').val('');
                $('.program').val('');
                $('.aktif').val('');
            }

            function token() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            //create
            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                cleaner();
                $('#modalAdd').modal('show');
                $('.modal-title').text('Tambah Data');
            });

            //edit
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                token();

                $.ajax({
                    url: 'kursus/' + id + '/edit',
                    method: 'get',
                    success: function (result) {

                        if (result.success) {
                            let json = jQuery.parseJSON(result.data);

                            $('.id').val(json.id);
                            $('.id_peserta').val(json.id_peserta);
                            $('.biaya').val(json.biaya);
                            $('#jemput').val(json.jemput);
                            $('.biaya_jemput').val(json.biaya_jemput);
                            $('#sim').val(json.sim);
                            $('.biaya_sim').val(json.biaya_sim);
                            $('.diskon').val(json.diskon);


                            $('#modalEdit').modal('show');
                            $('.modal-title').text('Update Data');
                        }

                    }
                });


            });

            //edit
            $(document).on('click', '.tambah', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                token();

                $.ajax({
                    url: 'jadwal/' + id + '/edit',
                    method: 'get',
                    success: function (result) {

                        if (result.success) {
                            let json = jQuery.parseJSON(result.data);

                            $('#id_kursus').val(json.id);

                            $('#modalAdd').modal('show');
                            $('.modal-title').text("Input Jadwal");
                        }

                    }
                });


            });
            //edit
            $(document).on('click', '.editbayar', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                token();

                $.ajax({
                    url: 'jadwal/' + id + '/editbayar',
                    method: 'get',
                    success: function (result) {

                        if (result.success) {
                            let json = jQuery.parseJSON(result.data);

                            $('#id').val(json.id);

                            $('#modalEditBayar').modal('show');
                            $('.modal-title').text("Input Pembayaran");
                        }

                    }
                });


            });


            //store
            $(document).on('submit', '#modalAdd', function (e) {
                e.preventDefault();
                token();
                $.ajax({
                    url: "jadwal",
                    method: 'post',
                    data: {id_kursus:$("#id_kursus").val(),
                        id_instruktur:$("#id_instruktur").val(),
                        id_mobil:   $("#id_mobil").val(),
                        tanggal:    $("#tanggal").val(),
                        jam_mulai:  $("#jam_mulai").val(),
                        jam_akhir:  $("#jam_akhir").val(),
                        status:     $("#status").val(),
                        "_token":   $('input[name=_token]').val()},
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            $('#modalAdd').modal('hide');
                            toastr.success(result.success);
                        }
                    }
                });


            });

            $(document).on('submit', '#modalEditBayar', function (e) {
                e.preventDefault();

                var id= $("#id").val();

                var jumlah =$("#jumlah").val();


                token();


                $.ajax({
                    url: "jadwal/" + id,
                    method: 'PUT',
                    data: {id:id,jumlah:jumlah,"_token": $('input[name=_token]').val()},
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            $('#modalEditBayar').modal('hide');
                            toastr.success(result.success);
                        }
                    }
                });


            });

            //update
            $(document).on('submit', '#modalEdit', function (e) {
                e.preventDefault();

                var formData = $("form#update").serializeArray();

                token();

                var id = formData[0].value
                var data = {
                    '_token': $('input[name=_token]').val(),
                    id_peserta: formData[1].value,
                    biaya: formData[2].value,
                    jemput: formData[3].value,
                    biaya_jemput: formData[4].value,
                    sim: formData[5].value,
                    biaya_sim: formData[6].value,
                    diskon: formData[7].value,
                };

                $.ajax({
                    url: "kursus/" + id,
                    method: 'PUT',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            cleaner();
                            $('#modalEdit').modal('hide');
                            toastr.success(result.success);

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        toastr.error("Gagal update Data");
                    }

                });
            });


            //delete data
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                swal.fire({
                    title: 'Anda Yakin?',
                    text: "Anda Yakin Hapus Data ini?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#5bc0de',
                    cancelButtonColor: '#f0ad4e',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                        if (result.value) {

                            token();

                            $.ajax({
                                url: 'kursus/' + id,
                                method: 'DELETE',
                                dataType: 'json',
                                data: {id:id,"_token": "{{ csrf_token() }}"},

                                success: function (result) {
                                    if (result.success) {
                                        refresh();
                                        cleaner();
                                        toastr.success(result.success);
                                    }else {
                                        toastr.success("Gagal Hapus Data");
                                    }
                                }
                            });
                        }
                    }
                );

            });
        });
    </script>
@endsection

