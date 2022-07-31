@extends('layouts.main')

@section('title', 'Mobil')

@section('breadcump')
    <div class="col-sm-6">
        <h1 class="m-0">{{ __('Mobil') }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Mobil') }}</li>
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
                        {{ __('Data Mobil') }}
                    </h3>
                </div>
                <div class="card-body">
                    @can('tambah Mobil')
                        <div class="text-right mb-3">
                            <button  class="btn btn-primary pull-right create">
                                <i class="fas fa-plus-circle mr-2"></i>
                                {{ __('Tambah Mobil') }}
                            </button>
                        </div>
                    @endcan
                    <div class="table-responsive">

                        <table class="table table-hover table-condensed" id="mytable">
                            <thead>
                            <th>No</th>
                            <th>Country name</th>
                            <th>Capital City</th>
                            <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.country') }}" method="post" id="add-country-form" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="">Country name</label>
                            <input type="text" class="form-control" name="country_name" placeholder="Enter country name">
                            <span class="text-danger error-text country_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Capital city</label>
                            <input type="text" class="form-control" name="capital_city" placeholder="Enter capital city">
                            <span class="text-danger error-text capital_city_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">SAVE</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade editCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= route('update.country.details') ?>" method="post" id="update-country-form">
                        @csrf
                        <input type="hidden" name="cid">
                        <div class="form-group">
                            <label for="">Country name</label>
                            <input type="text" class="form-control" name="country_name" placeholder="Enter country name">
                            <span class="text-danger error-text country_name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Capital city</label>
                            <input type="text" class="form-control" name="capital_city" placeholder="Enter capital city">
                            <span class="text-danger error-text capital_city_error"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

        toastr.options.preventDuplicates = true;

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });


        $(function(){

            //ADD NEW COUNTRY
            $('#add-country-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $(form)[0].reset();
                            //  alert(data.msg);
                            $('#counties-table').DataTable().ajax.reload(null, false);
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //GET ALL COUNTRIES
            var table =  $('#mytable').DataTable({
                processing:true,
                info:true,
                ajax:"{{ route('get.countries.list') }}",
                columns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'country_name', name:'country_name'},
                    {data:'capital_city', name:'capital_city'},
                    {data:'actions', name:'actions', orderable:false, searchable:false},
                ]
            }).on('draw', function(){
                $('input[name="country_checkbox"]').each(function(){this.checked = false;});
                $('input[name="main_checkbox"]').prop('checked', false);
                $('button#deleteAllBtn').addClass('d-none');
            });

            $(document).on('click','#editCountryBtn', function(){
                var country_id = $(this).data('id');
                $('.editCountry').find('form')[0].reset();
                $('.editCountry').find('span.error-text').text('');
                $.post('<?= route("get.country.details") ?>',{country_id:country_id}, function(data){
                    //  alert(data.details.country_name);
                    $('.editCountry').find('input[name="cid"]').val(data.details.id);
                    $('.editCountry').find('input[name="country_name"]').val(data.details.country_name);
                    $('.editCountry').find('input[name="capital_city"]').val(data.details.capital_city);
                    $('.editCountry').modal('show');
                },'json');
            });


            //UPDATE COUNTRY DETAILS
            $('#update-country-form').on('submit', function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend: function(){
                        $(form).find('span.error-text').text('');
                    },
                    success: function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix, val){
                                $(form).find('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#counties-table').DataTable().ajax.reload(null, false);
                            $('.editCountry').modal('hide');
                            $('.editCountry').find('form')[0].reset();
                            toastr.success(data.msg);
                        }
                    }
                });
            });

            //DELETE COUNTRY RECORD
            $(document).on('click','#deleteCountryBtn', function(){
                var country_id = $(this).data('id');
                var url = '<?= route("delete.country") ?>';

                swal.fire({
                    title:'Are you sure?',
                    html:'You want to <b>delete</b> this country',
                    showCancelButton:true,
                    showCloseButton:true,
                    cancelButtonText:'Cancel',
                    confirmButtonText:'Yes, Delete',
                    cancelButtonColor:'#d33',
                    confirmButtonColor:'#556ee6',
                    width:300,
                    allowOutsideClick:false
                }).then(function(result){
                    if(result.value){
                        $.post(url,{country_id:country_id}, function(data){
                            if(data.code == 1){
                                $('#counties-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                            }else{
                                toastr.error(data.msg);
                            }
                        },'json');
                    }
                });

            });




            $(document).on('click','input[name="main_checkbox"]', function(){
                if(this.checked){
                    $('input[name="country_checkbox"]').each(function(){
                        this.checked = true;
                    });
                }else{
                    $('input[name="country_checkbox"]').each(function(){
                        this.checked = false;
                    });
                }
                toggledeleteAllBtn();
            });

            $(document).on('change','input[name="country_checkbox"]', function(){

                if( $('input[name="country_checkbox"]').length == $('input[name="country_checkbox"]:checked').length ){
                    $('input[name="main_checkbox"]').prop('checked', true);
                }else{
                    $('input[name="main_checkbox"]').prop('checked', false);
                }
                toggledeleteAllBtn();
            });


            function toggledeleteAllBtn(){
                if( $('input[name="country_checkbox"]:checked').length > 0 ){
                    $('button#deleteAllBtn').text('Delete ('+$('input[name="country_checkbox"]:checked').length+')').removeClass('d-none');
                }else{
                    $('button#deleteAllBtn').addClass('d-none');
                }
            }


            $(document).on('click','button#deleteAllBtn', function(){
                var checkedCountries = [];
                $('input[name="country_checkbox"]:checked').each(function(){
                    checkedCountries.push($(this).data('id'));
                });

                var url = '{{ route("delete.selected.countries") }}';
                if(checkedCountries.length > 0){
                    swal.fire({
                        title:'Are you sure?',
                        html:'You want to delete <b>('+checkedCountries.length+')</b> countries',
                        showCancelButton:true,
                        showCloseButton:true,
                        confirmButtonText:'Yes, Delete',
                        cancelButtonText:'Cancel',
                        confirmButtonColor:'#556ee6',
                        cancelButtonColor:'#d33',
                        width:300,
                        allowOutsideClick:false
                    }).then(function(result){
                        if(result.value){
                            $.post(url,{countries_ids:checkedCountries},function(data){
                                if(data.code == 1){
                                    $('#counties-table').DataTable().ajax.reload(null, true);
                                    toastr.success(data.msg);
                                }
                            },'json');
                        }
                    })
                }
            });




        });

    </script>
@endsection

