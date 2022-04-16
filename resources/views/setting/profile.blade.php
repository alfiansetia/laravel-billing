@extends('layouts.template')

@push('css')
<link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/users/account-setting.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/css/elements/alert.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="row layout-spacing">
    <!-- Content -->
    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Info</h3>
                    <a href="javascript:void(0);" class="mt-2 edit-profile" id="editProfile">
                        <i data-feather="edit-3" data-toggle="tooltip" title="Edit"></i>
                    </a>
                </div>
                <div class="text-center user-info">
                    <img src="{{ asset('assets/img/profile') }}/{{ $user->foto == '' ? 'default.png' : $user->foto }}" style="width: 30%;height: 30%;" alt="{{ $user->name }}">
                    <p class="">{{ $user->name }}</p>
                </div>
                <div class="user-info-list">

                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <i data-feather="coffee" data-toggle="tooltip" title="Role"></i>
                                {{ $user->roles[0]->name }}
                            </li>
                            <li class="contacts-block__item">
                                <a href="mailto:{{ $user->email }}">
                                    <i data-feather="mail" data-toggle="tooltip" title="Email"></i>
                                    {{ $user->email }}
                                </a>
                            </li>
                            <li class="contacts-block__item">
                                <i data-feather="phone" data-toggle="tooltip" title="Phone"></i>
                                {{ $user->phone }}
                            </li>
                            <li class="contacts-block__item">
                                <i data-feather="calendar" data-toggle="tooltip" title="Created At"></i>
                                {{ date('M d Y', strtotime($user->created_at)) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

        <div class="skills layout-spacing ">
            <div class="widget-content widget-content-area">
                <h3 class="mb-3">Update Profile</h3>
                <div class="alert alert-gradient mb-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                    <strong>Leave blank Photo & Passw!</strong> if you don't want to change.
                </div>
                <form id="form" action="{{ route('user.profileUpdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name"><i class="far fa-user mr-1" data-toggle="tooltip" title="Full Name"></i>Full Name</label>
                        <input type="text" name="name" class="form-control maxlength @error('name') is-invalid @enderror" id="name" placeholder="Please Enter Name" value="{{ $user->name }}" minlength="3" maxlength="50" required>
                        @error('name')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email"><i class="far fa-envelope mr-1" data-toggle="tooltip" title="Email User"></i>Email</label>
                        <input type="email" name="email" class="form-control maxlength" id="email" placeholder="Please Enter Email" value="{{ $user->email }}" minlength="3" maxlength="50" disabled required>
                        @error('email')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password"><i class="fas fa-fingerprint mr-1" data-toggle="tooltip" title="Password"></i>Password</label>
                        <input type="text" name="password" class="form-control maxlength @error('password') is-invalid @enderror" id="password" placeholder="Please Enter Password" minlength="8" maxlength="200">
                        @error('password')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password2"><i class="fas fa-fingerprint mr-1" data-toggle="tooltip" title="Confirm Password"></i>Confirm Password</label>
                        <input type="text" name="password2" class="form-control maxlength @error('password2') is-invalid @enderror" id="password2" placeholder="Please Confirm Password" minlength="8" maxlength="200">
                        @error('password2')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone"><i class="fas fa-phone mr-1" data-toggle="tooltip" title="Telephone"></i>Phone</label>
                        <input type="number" name="phone" class="form-control maxlength @error('phone') is-invalid @enderror" id="phone" placeholder="08xxx" value="{{ $user->phone }}" required maxlength="15">
                        @error('phone')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="foto"><i class="fas fa-image mr-1" data-toggle="tooltip" title="Foto User"></i>Foto</label>
                        <div class="custom-file mb-2">
                            <input type="file" name="foto" id="foto" class="custom-file-input @error('foto') is-invalid @enderror">
                            <label class="custom-file-label" for="foto">Choose file</label>
                        </div>
                        @error('foto')
                        <div class="alert alert-danger mb-3 mt-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="ml-auto">
                            <button type="reset" id="reset" class="btn btn-warning"><i class="fas fa-undo mr-1" data-toggle="tooltip" title="Reset"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-1" data-toggle="tooltip" title="Save"></i>Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script src="{{ asset('plugins/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-maxlength/custom-bs-maxlength.js') }}"></script>

<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>

<script>
    $(document).ready(function() {
        bsCustomFileInput.init();

        $('#editProfile').click(function() {
            $('#name').focus();
        })

        $('.maxlength').maxlength({
            placement: "top",
            alwaysShow: true
        });

        $('#form').submit(function(event) {
            // event.preventDefault();
            $('button[type="submit"]').prop('disabled', true);
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
            }
        });
    })
</script>

@if(session()->has('success'))
<script>
    swal(
        'Success',
        "{{ session('success') }}",
        'success'
    )
</script>
@elseif(session()->has('error'))
<script>
    swal(
        'Failed!',
        "{{ session('error') }}",
        'error'
    )
</script>
@endif
@endpush