@extends('layouts.template')

@push('css')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('plugins/table/datatable/datatables.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/table/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endpush

@section('content')

<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form action="" method="POST" id="delete">
                <table id="tblData" class="table dt-table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="dt-no-sorting" style="width: 30px;">id</th>
                            <th>Name</th>
                            <th>Acc Name</th>
                            <th>Acc Number</th>
                            <th>Desc</th>
                            <th class="dt-no-sorting">Action</th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-plus mr-1" data-toggle="tooltip" title="Add Data"></i>Add Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" data-toggle="tooltip" title="Close">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="name"><i class="far fa-univercity mr-1" data-toggle="tooltip" title="Bank Name"></i>Bank Name</label>
                        <input type="text" name="name" class="form-control maxlength" id="name" placeholder="Please Enter Name" minlength="3" maxlength="50" required>
                        <small id="err_name" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                    <div class="form-group mb-2">
                        <label for="acc_name"><i class="far fa-envelope mr-1" data-toggle="tooltip" title="Account Name"></i>Account Name</label>
                        <input type="text" name="acc_name" class="form-control maxlength" id="acc_name" placeholder="Please Enter Account Name" minlength="3" maxlength="50" required>
                        <small id="err_acc_name" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                    <div class="form-group mb-2">
                        <label for="acc_number"><i class="fas fa-file-invoice mr-1" data-toggle="tooltip" title="Account Number"></i>Account Number</label>
                        <input type="number" name="acc_number" class="form-control maxlength" id="acc_number" placeholder="Please Enter Account Number" required maxlength="30">
                        <small id="err_acc_number" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>

                    <div class="form-group mb-2">
                        <label for="desc"><i class="fas fa-pen-alt mr-1" data-toggle="tooltip" title="Description"></i>Description</label>
                        <textarea name="desc" id="desc" class="form-control maxlength" maxlength="200" placeholder="Please Enter Description"></textarea>
                        <small id="err_desc" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-lg btn-primary" id="trig">TRIGGER</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close</button>
                    <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal animated fade fadeInDown" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleEdit"><i class="fas fa-edit mr-1" data-toggle="tooltip" title="Edit Data"></i>Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" title="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label for="edit_name"><i class="far fa-univercity mr-1" data-toggle="tooltip" title="Bank Name"></i>Bank Name</label>
                        <input type="text" name="name" class="form-control maxlength" id="edit_name" placeholder="Please Enter Name" minlength="3" maxlength="50" required>
                        <small id="err_edit_name" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_acc_name"><i class="far fa-envelope mr-1" data-toggle="tooltip" title="Account Name"></i>Account Name</label>
                        <input type="text" name="acc_name" class="form-control maxlength" id="edit_acc_name" placeholder="Please Enter Account Name" minlength="3" maxlength="50" required>
                        <small id="err_edit_acc_name" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                    <div class="form-group mb-2">
                        <label for="edit_acc_number"><i class="fas fa-file-invoice mr-1" data-toggle="tooltip" title="Account Number"></i>Account Number</label>
                        <input type="number" name="acc_number" class="form-control maxlength" id="edit_acc_number" placeholder="Please Enter Account Number" required maxlength="30">
                        <small id="err_edit_acc_number" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>

                    <div class="form-group mb-2">
                        <label for="edit_desc"><i class="fas fa-pen-alt mr-1" data-toggle="tooltip" title="Description"></i>Description</label>
                        <textarea name="desc" id="edit_desc" class="form-control maxlength" maxlength="200" placeholder="Please Enter Description"></textarea>
                        <small id="err_edit_desc" class="form-text error invalid-feedback" style="display: hide;"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-lg btn-primary" id="trig">TRIGGER</button> -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-1" data-toggle="tooltip" title="Close"></i>Close</button>
                    <button type="button" id="edit_reset" class="btn btn-warning"><i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@push('js')

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('plugins/table/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/table/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('.maxlength').maxlength({
            placement: "top",
            alwaysShow: true
        });

        var table = $('#tblData').DataTable({
            processing: true,
            serverSide: true,
            rowId: 'id',
            ajax: "{{ route('bank.index') }}",
            dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            oLanguage: {
                "oPaginate": {
                    "sPrevious": '<i data-feather="arrow-left"></i>',
                    "sNext": '<i data-feather="arrow-right"></i>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<i data-feather="search"></i>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            lengthMenu: [
                [10, 50, 100, 500, 1000],
                ['10 rows', '50 rows', '100 rows', '500 rows', '1000 rows']
            ],
            pageLength: 10,
            lengthChange: false,
            columnDefs: [{
                targets: [0, 5],
                width: "30px",
                className: "dt-no-sorting",
                orderable: !1,
            }],
            columns: [{
                data: 'id',
                render: function(data, type, row, meta) {
                    return `<label class="new-control new-checkbox checkbox-outline-primary  m-auto">\n<input type="checkbox" name="id[]" value="${data}" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>`
                }
            }, {
                title: 'Name',
                data: 'name',
            }, {
                title: 'Acc Name',
                data: 'acc_name'
            }, {
                title: 'Acc Number',
                data: 'acc_number'
            }, {
                title: 'Desc',
                data: 'desc',
            }, {
                title: 'Action',
                data: 'id',
                render: function(data, type, row, meta) {
                    let text = `<button type="button" id="btnEdit" data-id="${data}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt text-white text-sm"></i></button>`;
                    return text;
                }
            }],
            buttons: [, {
                text: '<i class="fa fa-plus mr-1"></i>Add',
                className: 'btn btn-sm btn-primary bs-tooltip',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Add Data'
                },
                action: function(e, dt, node, config) {
                    $('#modalAdd').modal('show');
                }
            }, {
                text: '<i class="fas fa-trash mr-1"></i>Del',
                className: 'btn btn-sm btn-danger',
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Delete Selected Data'
                },
                action: function(e, dt, node, config) {
                    swal({
                        title: 'Delete Selected Data?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Yes!',
                        confirmButtonAriaLabel: 'Thumbs up, Yes!',
                        cancelButtonText: '<i class="fa fa-thumbs-down"></i> No',
                        cancelButtonAriaLabel: 'Thumbs down',
                        padding: '2em',
                        animation: false,
                        customClass: 'animated tada',
                    }).then(function(result) {
                        if (result.value) {
                            var id = $('input[name="id[]"]:checked').length;
                            if (id <= 0) {
                                swal({
                                    title: 'Failed!',
                                    text: "No Selected Data!",
                                    type: 'error',
                                })
                            } else {
                                $("#delete").submit();
                            }
                        }
                    })
                }
            }, {
                extend: "pageLength",
                attr: {
                    'data-toggle': 'tooltip',
                    'title': 'Page Length'
                },
                className: 'btn btn-sm btn-info'
            }],
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML = '<label class="new-control new-checkbox checkbox-outline-primary m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            drawCallback: function(settings) {
                feather.replace();
            },
            initComplete: function() {
                $('#tblData').DataTable().buttons().container().appendTo('#tblData_wrapper .col-sm-6:eq(0)');
                feather.replace();
            }
        });

        multiCheck(table)

        $('#reset').click(function() {
            $('#form .error.invalid-feedback').each(function(i) {
                $(this).hide();
            });
            $('#form input.is-invalid').each(function(i) {
                $(this).removeClass('is-invalid');
            });
        })

        $('#form').submit(function(event) {
            event.preventDefault();
        }).validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            submitHandler: function(form) {
                let formData = new FormData($(form)[0]);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{ route('bank.store') }}",
                    mimeType: 'application/json',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                        console.log('loading bro');
                        $('#form .error.invalid-feedback').each(function(i) {
                            $(this).hide();
                        });
                        $('#form input.is-invalid').each(function(i) {
                            $(this).removeClass('is-invalid');
                        });
                    },
                    success: function(res) {
                        table.ajax.reload();
                        $('button[type="submit"]').prop('disabled', false);
                        $('#reset').click();
                        if (res.status == true) {
                            swal({
                                title: 'Success!',
                                text: res.message,
                                type: 'success',
                            })
                        } else {
                            swal({
                                title: 'Failed!',
                                text: res.message,
                                type: 'error',
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        $('button[type="submit"]').prop('disabled', false);
                        er = xhr.responseJSON.errors
                        erlen = Object.keys(er).length
                        for (i = 0; i < erlen; i++) {
                            obname = Object.keys(er)[i];
                            $('#' + obname).addClass('is-invalid');
                            $('#err_' + obname).text(er[obname][0]);
                            $('#err_' + obname).show();
                        }
                    }
                });
            }
        });

        $('#formEdit').submit(function(event) {
            event.preventDefault();
        }).validate({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                });
                let formData = new FormData($(form)[0]);
                let url = "{{ route('bank.update', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    mimeType: 'application/json',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                        console.log('loading bro');
                        $('#formEdit .error.invalid-feedback').each(function(i) {
                            $(this).hide();
                        });
                        $('#formEdit input.is-invalid').each(function(i) {
                            $(this).removeClass('is-invalid');
                        });
                    },
                    success: function(res) {
                        table.ajax.reload();
                        $('button[type="submit"]').prop('disabled', false);
                        $('#reset').click();
                        if (res.status == true) {
                            swal({
                                title: 'Success!',
                                text: res.message,
                                type: 'success',
                            })
                        } else {
                            swal({
                                title: 'Failed!',
                                text: res.message,
                                type: 'error',
                            })
                        }
                    },
                    error: function(xhr, status, error) {
                        $('button[type="submit"]').prop('disabled', false);
                        er = xhr.responseJSON.errors
                        console.log(xhr)
                        erlen = Object.keys(er).length
                        for (i = 0; i < erlen; i++) {
                            obname = Object.keys(er)[i];
                            $('#' + obname).addClass('is-invalid');
                            $('#err_edit_' + obname).text(er[obname][0]);
                            $('#err_edit_' + obname).show();
                        }
                    }
                });
            }
        });;

        $('body').on('click', '#btnEdit', function() {
            $('#formEdit .error.invalid-feedback').each(function(i) {
                $(this).hide();
            });
            $('#formEdit input.is-invalid').each(function(i) {
                $(this).removeClass('is-invalid');
            });
            id = $(this).data('id');
            let url = "{{ route('bank.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(result) {
                    $('#edit_reset').val(result.data.id);
                    $('#edit_name').val(result.data.name);
                    $('#edit_acc_name').val(result.data.acc_name);
                    $('#edit_acc_number').val(result.data.acc_number);
                    $('#edit_desc').val(result.data.desc);
                },
                error: function(xhr, status, error) {
                    er = xhr.responseJSON.errors
                    swal({
                        title: 'Failed!',
                        text: 'Server Error',
                        type: 'error',
                    })
                }
            });
            $('#modalEdit').modal('show');
        })

        $('#edit_reset').click(function() {
            id = $(this).val();
            let url = "{{ route('bank.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(result) {
                    $('#edit_reset').val(result.data.id);
                    $('#edit_name').val(result.data.name);
                    $('#edit_acc_name').val(result.data.acc_name);
                    $('#edit_acc_number').val(result.data.acc_number);
                    $('#edit_desc').val(result.data.desc);
                },
                error: function(xhr, status, error) {
                    er = xhr.responseJSON.errors
                    swal({
                        type: 'error',
                        title: 'Failed!',
                        text: 'Server Error',
                    })
                }
            });
        })

        $('#delete').submit(function(event) {
            var form = this;
            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: "{{ route('bank.destroy') }}",
                data: $(form).serialize(),
                beforeSend: function() {
                    console.log('otw')
                },
                success: function(res) {
                    table.ajax.reload();
                    if (res.status == true) {
                        swal({
                            title: 'Success!',
                            text: res.message,
                            type: 'success',
                        })
                    } else {
                        swal({
                            title: 'Failed!',
                            text: res.message,
                            type: 'error',
                        })
                    }
                },
                error: function(xhr, status, error) {
                    table.rows('.selected').nodes().to$().removeClass('selected');
                    er = xhr.responseJSON.errors
                    console.log(er);
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Server Error',
                        type: 'error',
                    })
                }
            })

        });
    });
</script>
@endpush