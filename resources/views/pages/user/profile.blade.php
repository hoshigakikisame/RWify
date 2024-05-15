@extends(request()->user()->getSidebarView())
@section('content')
@php
$userImage = request()->user()->getImageUrl() ?? Vite::asset('resources/assets/images/avatar.jpg');
$image = Vite::asset('resources/assets/images/profileImage.jpg');
@endphp
<div class="mt-8 mx-14">
    <div class="relative h-full">
        <div class="background-display relative">
            <img src="{{ $image }}" alt="backgroundImage" class="h-64 w-full bg-cover rounded-xl">
        </div>
        <div class="user flex gap-12 relative">
            <div class="user-avatar relative left-14 -top-20">
                <div class="w-44 rounded-full border-4 bg-white dark:bg-gray-900 border-white dark:border-gray-900 h-44 bg-cover bg-center" style="background-image: url('{{ $userImage }}')">
                </div>
                <form action="{{ route('user.profile.updateImage') }}" method="post" id="formImage" enctype="multipart/form-data">
                    @csrf
                    <label>
                        <input type="file" class="hidden" name="image" id="inputImage" accept="image/*">
                        <div class="absolute -translate-y-1/4 right-5 bottom-0 bg-gray-500/80 p-2 rounded-full fill-gray-300 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                <path d="M22.853 1.148a3.626 3.626 0 0 0-5.124 0L1.465 17.412A4.97 4.97 0 0 0 0 20.947V23a1 1 0 0 0 1 1h2.053a4.97 4.97 0 0 0 3.535-1.464L22.853 6.271a3.626 3.626 0 0 0 0-5.123M5.174 21.122A3.02 3.02 0 0 1 3.053 22H2v-1.053a2.98 2.98 0 0 1 .879-2.121L15.222 6.483l2.3 2.3ZM21.438 4.857l-2.506 2.507-2.3-2.295 2.507-2.507a1.623 1.623 0 1 1 2.295 2.3Z" />
                            </svg>
                        </div>
                    </label>
                </form>
            </div>
            <div class="user-info relative mt-2 ml-8 dark:text-gray-50 text-gray-950">
                <h1 class="text-2xl font-Poppins font-semibold ">
                    {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }}
                </h1>
                <h5 class="text-sm font-Inter font-medium text-gray-800 dark:text-gray-300">{{ $user->getRole() }}</h5>
                <p class="text-xs font-Inter text-gray-400 dark:text-gray-500">{{ $user->getEmail() }}</p>
            </div>
        </div>
    </div>
    <nav class="py-1 px-2 mb-2 relative">
        <ul class="flex gap-1 text-sm dark:text-gray-100">
            <li class="py-2 px-4 ">
                <button onclick="append(event);" ariaLabel="Profile">Profile</button>
            </li>
            <li class="py-2 px-4 ">
                <button onclick="append(event);" ariaLabel="changePassword">Change Password</button>
            </li>
        </ul>
        <hr>
    </nav>
    <div class="body-profile ms-2">
        <div class="container flex pb-10" id="panel">
            <!-- <div class="user-information">
                                                        <div class="panel panel-default ">
                                                            <div class="panel-heading mb-2">
                                                                <h1 class="text-xl leading-7">Profile</h1>
                                                                <p class="text-[10px]">All information for {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }} in the system</p>
                                                            </div>
                                                            <div id="panel-body" class="w-fit">
                                                                <form class="mb-5" method="POST" action="{{ route('user.profile.update') }}">
                                                                    @csrf
                                                                    <div class="flex gap-5 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="nama_depan" class="text-sm text-gray-700">Nama Depan</label>
                                                                            <div class="mt-1">
                                                                                <input id="nama_depan" type="text" class="rounded border-1 border-gray-500/50 text-gray-700 " name="nama_depan" value="{{ old('nama_depan', $user->getNamaDepan()) }}" disabled>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="nama_belakang" class="text-sm text-gray-700">Nama Belakang</label>
                                                                            <div class="mt-1">
                                                                                <input id="nama_belakang" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="nama_belakang" value="{{ old('nama_belakang', $user->getNamaBelakang()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="flex gap-5 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="nik" class="text-sm text-gray-700">NIK</label>

                                                                            <div class="mt-1">
                                                                                <input id="nik" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="nik" value="{{ old('nik', $user->getNik()) }}" disabled>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="nkk" class="text-sm text-gray-700">NKK</label>

                                                                            <div class="mt-1">
                                                                                <input id="nkk" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="nkk" value="{{ old('nkk', $user->getNkk()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group w-full mb-3">
                                                                        <label for="email" class="text-sm text-gray-700">Email <span class="text-xs {{ $user->getEmailVerifiedAt() ? 'text-green-500/80' : 'text-rose-500/90' }}">
                                                                                ({{ $user->getEmailVerifiedAt() ? 'Email Verified' : 'Email Not Verified' }})
                                                                            </span>
                                                                        </label>
                                                                        <div class="w-full flex text-nowrap gap-5 items-center mt-1">
                                                                            <input id="email" type="email" class="rounded border-1 border-gray-500/50 text-gray-700" name="email" value="{{ old('email', $user->getEmail()) }}" required>
                                                                            @if ($user->getEmailVerifiedAt() == null)
    <a href="{{ route('user.verification.send') }}" class="text-xs text-green-800 px-3 py-1 bg-green-500/20 rounded-full">Send Email
                                                                                Verification</a>
    @endif
                                                                        </div>
                                                                    </div>


                                                                    <div class="flex gap-5 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="tempat_lahir" class="text-sm text-gray-700">Tempat Lahir</label>

                                                                            <div class="mt-1">
                                                                                <input id="tempat_lahir" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="tempat_lahir" value="{{ old('tempat_lahir', $user->getTempatLahir()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group w-full">
                                                                            <label for="tanggal_lahir" class="text-sm text-gray-700">Tanggal Lahir</label>
                                                                            <div class="mt-1">
                                                                                <input id="tanggal_lahir" type="date" class="w-full rounded border-1 border-gray-500/50 text-gray-700" name="tanggal_lahir" value="{{ old('tempat_lahir', $user->getTanggalLahir()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="golongan_darah" class="text-sm text-gray-700">Golongan Darah</label>

                                                                            <div class="mt-1">
                                                                                <input id="golongan_darah" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="golongan_darah" value="{{ old('golongan_darah', $user->getGolonganDarah()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="alamat" class="text-sm text-gray-700">Alamat</label>

                                                                        <div class="mt-1">
                                                                            <input id="alamat" type="text" class="w-full rounded border-1 border-gray-500/50 text-gray-700" name="alamat" value="{{ old('alamat', $user->getAlamat()) }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex gap-5 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="jenis_kelamin" class="text-sm text-gray-700">Jenis Kelamin</label>

                                                                            <div class="mt-1">
                                                                                <input id="jenis_kelamin" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="jenis_kelamin" value="{{ old('jenis_kelamin', $user->getJenisKelamin()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="agama" class="text-sm text-gray-700">Agama</label>

                                                                            <div class="mt-1">
                                                                                <input id="agama" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="agama" value="{{ old('agama', $user->getAgama()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="flex gap-5 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="pekerjaan" class="text-sm text-gray-700">Pekerjaan</label>

                                                                            <div class="col-md-6">
                                                                                <input id="pekerjaan" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="pekerjaan" value="{{ old('pekerjaan', $user->getPekerjaan()) }}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="status_perkawinan" class="text-sm text-gray-700">Status Perkawinan</label>

                                                                            <div class="col-md-6">
                                                                                <input id="status_perkawinan" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="status_perkawinan" value="{{ old('status_perkawinan', $user->getStatusPerkawinan()) }}" disabled>
                                                                            </div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="flex gap-5 mb-3">

                                                                        <div class="form-group">
                                                                            <label for="role" class="text-sm text-gray-700">Role</label>

                                                                            <div class="col-md-6">
                                                                                <input id="role" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="role" value="{{ old('role', $user->getRole()) }}" disabled>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="id_rukun_tetangga" class="text-sm text-gray-700">Rukun Tetangga</label>

                                                                            <div class="col-md-6">
                                                                                <input id="id_rukun_tetangga" type="text" class="rounded border-1 border-gray-500/50 text-gray-700" name="id_rukun_tetangga" value="{{ old('id_rukun_tetangga', $user->getRukunTetangga()->getNomorRukunTetangga()) }}" disabled>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-action">
                                                                        <div class="flex justify-end">
                                                                            <button type="submit" class="px-4 py-2
                                     bg-blue-500 rounded-md text-sm text-white">
                                                                                <span>Save Profile</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div> -->
            <!-- <div class="change-password">
                                                        <div class="panel">
                                                            <div class="panel-heading mb-2">
                                                                <h1 class="text-xl leading-7">Change Password</h1>
                                                                <p class="text-[10px]">Change your password for {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }} in the system</p>
                                                            </div>
                                                            <div id="panel-body">
                                                                <form class="form-horizontal" method="POST" action="{{ route('user.profile.updatePassword') }}">
                                                                    @csrf
                                                                    <div class="form-group mb-3">
                                                                        <label for="current_password" class="text-sm text-gray-700">Current Password</label>

                                                                        <div class="col-md-6">
                                                                            <input id="current_password" type="password" class="rounded border-1 border-gray-500/50 text-gray-700 @error('current_password') is-invalid @enderror" name="current_password" required>
                                                                            @error('current_password')
        <span class="invalid-feedback" role="alert">
                                                                                                                    <strong>{{ $message }}</strong>
                                                                                                                </span>
    @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-2">
                                                                        <label for="new_password" class="text-sm text-gray-700">New Password</label>

                                                                        <div class="col-md-6">
                                                                            <input id="new_password" type="password" class="rounded border-1 border-gray-500/50 text-gray-700 @error('new_password') is-invalid @enderror" name="new_password" required>

                                                                            @error('new_password')
        <span class="invalid-feedback" role="alert">
                                                                                                                    <strong>{{ $message }}</strong>
                                                                                                                </span>
    @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group mb-3">
                                                                        <label for="new_password_confirmation" class="text-sm text-gray-700">New Password Confirmation</label>
                                                                        <div class="col-md-6">
                                                                            <input id="new_password_confirmation" type="password" class="rounded border-1 border-gray-500/50 text-gray-700 @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required>

                                                                            @error('new_password_confirmation')
        <span class="invalid-feedback" role="alert">
                                                                                                                    <strong>{{ $message }}</strong>
                                                                                                                </span>
    @enderror
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-6 col-md-offset-4">
                                                                            <button type="submit" class="px-4 py-2
                                     bg-blue-500 rounded-md text-sm text-white">
                                                                                <span>Update Password</span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const passwordElement = /*html*/ `
    <div class="change-password">
                <div class="panel dark:text-gray-100 w-80">
                    <div class="panel-heading mb-2">
                        <h1 class="text-xl leading-7">Change Password</h1>
                        <p class="text-[10px] dark:text-gray-400">Change your password for {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }} in the system</p>
                    </div>
                    <div id="panel-body">
                        <form class="form-horizontal " method="POST" action="{{ route('user.profile.updatePassword') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="current_password" class="text-sm text-gray-500 dark:text-gray-400">Current Password</label>
                                <div class="mt-1">
                                    <input id="current_password" type="password" class="w-full rounded border-1 border-gray-500/50
                                    text-gray-700 dark:text-gray-200 dark:bg-gray-900 @error('current_password') is-invalid @enderror" name="current_password" required>
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="new_password" class="text-sm text-gray-500 dark:text-gray-400">New Password</label>

                                <div class="mt-1">
                                    <input id="new_password" type="password" class="w-full rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-gray-900 @error('new_password') is-invalid @enderror" name="new_password" required>

                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="new_password_confirmation" class="text-sm text-gray-500 dark:text-gray-400">New Password Confirmation</label>
                                <div class="mt-1">
                                    <input id="new_password_confirmation" type="password" class="w-full rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-gray-900 @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required>

                                    @error('new_password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <div class="">
                                    <button type="submit" class="px-4 py-2
                                     bg-blue-500 rounded-md text-sm text-white">
                                        <span>Update Password</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    `

    const profileElement = /*html */ `
    <div class="user-information">
                <div class="panel panel-default dark:text-gray-100">
                    <div class="panel-heading mb-2">
                        <h1 class="text-xl leading-7">Profile</h1>
                        <p class="text-[10px] dark:text-gray-400">All information for {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }} in the system</p>
                    </div>
                    <div id="panel-body" class="w-fit">
                        <form class="mb-5" method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            <div class="flex gap-5 mb-3">
                                <x-form.input-profile title="Nama Depan" key="nama_depan" type="text" value="{{ old('nama_depan', $user->getNamaDepan()) }}" disabled="true"/>
                                <x-form.input-profile title="Nama Belakang" key="nama_belakang" type="text" value="{{ old('nama_belakang', $user->getNamaBelakang()) }}" disabled="true"/>
                            </div>

                            <div class="flex gap-5 mb-3">
                            <x-form.input-profile title="NIK" key="nik" type="text" value="{{ old('nik', $user->getNik()) }}" disabled="true"/>
                            <x-form.input-profile title="NKK" key="nkk" type="text" value="{{ old('nkk', $user->getNkk()) }}" disabled="true"/>
                            </div>


                            <div class="form-group w-full mb-3">
                                <label for="email" class="text-sm text-gray-500 dark:text-gray-400">Email <span class="text-xs {{ $user->getEmailVerifiedAt() ? 'text-green-500/80' : 'text-rose-500/90' }}">
                                        ({{ $user->getEmailVerifiedAt() ? 'Email Verified' : 'Email Not Verified' }})
                                    </span>
                                </label>
                                <div class="w-full flex text-nowrap gap-5 items-center mt-1">
                                    <input id="email" type="email" class="rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-gray-900" name="email" value="{{ old('email', $user->getEmail()) }}" required>
                                    @if ($user->getEmailVerifiedAt() == null)
                                    <a href="{{ route('user.verification.send') }}" class="text-xs text-green-800 dark:text-green-500 px-3 py-1 bg-green-500/20 bg-green-600/20 rounded-full">Send Email
                                        Verification</a>
                                    @endif
                                </div>
                            </div>


                            <div class="flex gap-5 mb-3">
                                <x-form.input-profile title="Tempat Lahir" key="tempat_lahir" type="text" value="{{ old('tempat_lahir', $user->getTempatLahir()) }}" disabled="true"/>
                                <x-form.input-profile title="Tanggal Lahir" key="tanggal_lahir" type="date" value="{{ old('tempat_lahir', $user->getTanggalLahir()) }}" disabled="true" class="w-full" />
                                <x-form.input-profile title="Golongan Darah" key="golongan_darah" type="text" value="{{ old('golongan_darah', $user->getGolonganDarah()) }}" disabled="true"/> 
                            </div>

                            <div class="mb-3">
                                <x-form.input-profile title="Alamat" key="alamat" type="text" value="{{ old('alamat', $user->getAlamat()) }}" disabled="true" class="w-full" />
                            </div>
                            <div class="flex gap-5 mb-3">
                            <x-form.input-profile title="Jenis Kelamin" key="jenis_kelamin" type="text" value="{{ old('jenis_kelamin', $user->getJenisKelamin()) }}" disabled="true" />
                            <x-form.input-profile title="Agama" key="agama" type="text" value="{{ old('agama', $user->getAgama()) }}" disabled="true" />
                            </div>

                            <div class="flex gap-5 mb-3">
                            <x-form.input-profile title="Pekerjaan" key="pekerjaan" type="text" value="{{ old('pekerjaan', $user->getPekerjaan()) }}" disabled="true" /> 
                            <x-form.input-profile title="Status Perkawinan" key="status_perkawinan" type="text" value="{{ old('status_perkawinan', $user->getStatusPerkawinan()) }}" disabled="true" />
                            </div>

                            <div class="flex gap-5 mb-3">
                            <x-form.input-profile title="Role" key="role" type="text" value="{{ old('role', $user->getRole()) }}" disabled="true" />
                            <x-form.input-profile title="Rukun Tetangga" key="id_rukun_tetangga" type="text" value="{{ old('id_rukun_tetangga', $user->getRukunTetangga()->getNomorRukunTetangga()) }}" disabled="true" />
                            
                            </div>

                            <div class="form-action mb-4">
                                <div class="flex">
                                    <button type="submit" class="px-4 py-2
                                     bg-blue-500 rounded-md text-sm text-white">
                                        <span>Save Profile</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    `

    function appendProfileElement(element) {
        $("#panel").fadeOut(500, () => {
            $("#panel").html(element)
        })

        $("#panel").fadeIn(500, () => {
            $("#panel").html(element)
        })
    }

    let active = "rounded-t-md text-blue-500 dark:text-blue-400 border-blue-500 border-b-2"

    function append(event, style = active) {
        $(event.target).parents('ul').children().each((i, e) => {
            $(e).removeClass(style)
        })

        $($(event.target).parent()).addClass(style)

        if (event.target.attributes.arialabel.value === "changePassword") {
            appendProfileElement(passwordElement)
        } else {
            appendProfileElement(profileElement)
        }
    }
</script>
<script type="module">
    $(window).on('load', () => {
        $($("[ariaLabel='Profile']").parent()).addClass(active)
        appendProfileElement(profileElement)
    })

    $('document').ready(() => {
        $('#inputImage').change(() => {
            $('#formImage').submit();
        });
    });
</script>
@endpush