@extends(request()->user()->getSidebarView())
@section('content')
    @php
        $userImage =
            request()
                ->user()
                ->getImageUrl() ?? Vite::asset('resources/assets/images/avatar.jpg');
        $image = Vite::asset('resources/assets/images/profileImage.jpg');
    @endphp

    <div class="mx-14 mt-8">
        <div class="relative h-full">
            <div class="background-display relative">
                <img src="{{ $image }}" alt="backgroundImage" class="h-64 w-full rounded-xl bg-cover" />
            </div>
            <div class="user relative flex h-32 gap-12" x-data="{}">
                <div id="userImage" class="user-avatar relative -top-20 left-14">
                    <div
                        class="h-44 w-44 rounded-full border-4 border-white bg-white bg-cover bg-center dark:border-gray-900 dark:bg-darkBg"
                        style="background-image: url('{{ $userImage }}')"
                    ></div>

                    <form id="userImageChangeForm" action="" method="POST">
                        @csrf
                        <label for="image">
                            <input
                                type="file"
                                aria-current="submitButton"
                                class="hidden"
                                name="image"
                                id="image"
                                accept="image/*"
                                x-effect="
                                    window.utils.Request.actionRequest(
                                        '{{ route('user.profile.updateImage') }}',
                                        '#userImage',
                                        '#userImageChangeForm',
                                        true,
                                    )
                                "
                            />
                            <div
                                class="absolute -bottom-10 right-5 cursor-pointer rounded-full bg-gray-500/80 fill-gray-300 p-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                    <path
                                        d="M22.853 1.148a3.626 3.626 0 0 0-5.124 0L1.465 17.412A4.97 4.97 0 0 0 0 20.947V23a1 1 0 0 0 1 1h2.053a4.97 4.97 0 0 0 3.535-1.464L22.853 6.271a3.626 3.626 0 0 0 0-5.123M5.174 21.122A3.02 3.02 0 0 1 3.053 22H2v-1.053a2.98 2.98 0 0 1 .879-2.121L15.222 6.483l2.3 2.3ZM21.438 4.857l-2.506 2.507-2.3-2.295 2.507-2.507a1.623 1.623 0 1 1 2.295 2.3Z"
                                    />
                                </svg>
                            </div>
                            <ul id="error" class="z-40 space-y-1 text-sm text-red-600 dark:text-red-400"></ul>
                        </label>
                    </form>
                </div>
                <div class="user-info relative ml-8 mt-2 text-gray-950 dark:text-gray-50">
                    <h1 class="font-Poppins text-2xl font-semibold">
                        {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }}
                    </h1>
                    <h5 class="font-Inter text-sm font-medium text-gray-800 dark:text-gray-300">
                        {{ $user->getRole() }}
                    </h5>
                    <p class="font-Inter text-xs text-gray-400 dark:text-gray-500">{{ $user->getEmail() }}</p>
                </div>
            </div>
        </div>
        <nav class="relative mb-2 px-2 py-1 pt-0">
            <ul
                class="flex gap-1 text-sm dark:text-gray-100"
                x-data="{
                    isPanelActive: false,
                    activeClass:
                        'rounded-t-md text-blue-500 dark:text-blue-400 border-blue-500 border-b-2',
                }"
            >
                <li :class="isPanelActive ? '' : activeClass" class="px-4 py-2">
                    <button @click="appendProfile({{ $user }});isPanelActive= !isPanelActive" ariaLabel="Profile">
                        Profile
                    </button>
                </li>
                <li :class="!isPanelActive ? '' : activeClass" class="px-4 py-2">
                    <button @click="appendPassword();isPanelActive= !isPanelActive" ariaLabel="changePassword">
                        Change Password
                    </button>
                </li>
            </ul>
            <hr />
        </nav>
        <div class="body-profile ms-2" x-data="{}">
            <div class="container flex pb-10" id="panel" x-effect="appendProfile({{ $user }})">
                <!-- append elemet go here -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function appendPassword() {

                const passwordElement = /*html*/ `
            <div id="passwordUpdate" class="change-password">
                        <div class="panel dark:text-gray-100 w-80">
                            <div class="panel-heading mb-2">
                                <h1 class="text-xl leading-7">Change Password</h1>
                                <p class="text-[10px] dark:text-gray-400">Change your password for {{ $user->getNamaDepan() . ' ' . $user->getNamaBelakang() }} in the system</p>
                            </div>
                            <div id="panel-body">
                                <form id="passwordUpdateForm" class="form-horizontal " method="POST" action="">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="current_password" class="text-sm text-gray-500 dark:text-gray-400">Current Password</label>
                                        <div class="mt-1">
                                            <input id="current_password" type="password" class="w-full rounded border-1 border-gray-500/50
                                            text-gray-700 dark:text-gray-200 dark:bg-darkBg @error('current_password') is-invalid @enderror" name="current_password" required>
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
                                            <input id="new_password" type="password" class="w-full rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-darkBg @error('new_password') is-invalid @enderror" name="new_password" required>

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
                                            <input id="new_password_confirmation" type="password" class="w-full rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-darkBg @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" required>

                                            @error('new_password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="">
                                            <button type="submit" aria-current="directSubmitButton" @click.prevent="window.utils.Request.actionRequest('{{ route('user.profile.updatePassword') }}','#passwordUpdate','#passwordUpdateForm')" class="px-4 py-2 bg-blue-500 rounded-md text-sm text-white">
                                                <span>Update Password</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            `
                appendProfileElement(passwordElement)
            }

            function appendProfile(user) {

                const profileElement = /*html */ `
            <div id="profileUpdate" class="user-information">
                        <div class="panel panel-default dark:text-gray-100">
                            <div class="panel-heading mb-2">
                                <h1 class="text-xl leading-7">Profile</h1>
                                <p class="text-[10px] dark:text-gray-400">All information for ${user.nama_depan +' '+ user.nama_belakang} in the system</p>
                            </div>
                            <div id="panel-body" class="w-fit">
                                <form id="profileUpdateForm" class="mb-5" method="POST" action="">
                                    @csrf
                                    <div class="flex gap-5 mb-3">
                                        <x-form.input-profile title="Nama Depan" key="nama_depan" type="text" value="${user.nama_depan}" disabled="true"/>
                                        <x-form.input-profile title="Nama Belakang" key="nama_belakang" type="text" value="${user.nama_belakang}" disabled="true"/>
                                    </div>

                                    <div class="flex gap-5 mb-3">
                                    <x-form.input-profile title="NIK" key="nik" type="text" value="${user.nik}" disabled="true"/>
                                    <x-form.input-profile title="NKK" key="nkk" type="text" value="${user.nkk}" disabled="true"/>
                                    </div>


                                    <div class="form-group w-full mb-3">
                                        <label for="email" class="text-sm text-gray-500 dark:text-gray-400">Email <span class="text-xs ${ user.email_verified_at ? 'text-green-500/80' : 'text-rose-500/90' }">
                                                (${ user.email_verified_at ? 'Email Verified' : 'Email Not Verified' })
                                            </span>
                                        </label>
                                        <div class="w-full flex text-nowrap gap-5 items-center mt-1">
                                            <input id="email" type="email" class="rounded border-1 border-gray-500/50 text-gray-700 dark:text-gray-200 dark:bg-darkBg" name="email" value="${ user.email }" required>
                                            @if ($user->getEmailVerifiedAt() == null)
                                            <a href="{{ route('user.verification.send') }}" class="text-xs text-green-800 dark:text-green-500 px-3 py-1 bg-green-500/20 bg-green-600/20 rounded-full">Send Email
                                                Verification</a>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="flex gap-5 mb-3">
                                        <x-form.input-profile title="Tempat Lahir" key="tempat_lahir" type="text" value="${user.tempat_lahir}" disabled="true"/>
                                        <x-form.input-profile title="Tanggal Lahir" key="tanggal_lahir" type="date" value="${user.tanggal_lahir}" disabled="true" class="w-full" />
                                        <x-form.input-profile title="Golongan Darah" key="golongan_darah" type="text" value="${user.golongan_darah}" disabled="true"/> 
                                    </div>

                                    <div class="mb-3">
                                        <x-form.input-profile title="Alamat" key="alamat" type="text" value="${user.alamat}" disabled="" class="w-full" />
                                    </div>
                                    <div class="flex gap-5 mb-3">
                                    <x-form.input-profile title="Jenis Kelamin" key="jenis_kelamin" type="text" value="${user.jenis_kelamin}" disabled="true" />
                                    <x-form.input-profile title="Agama" key="agama" type="text" value="${user.agama}" disabled="false" />
                                    </div>

                                    <div class="flex gap-5 mb-3">
                                    <x-form.input-profile title="Pekerjaan" key="pekerjaan" type="text" value="${user.pekerjaan}" disabled="" /> 
                                    <x-form.input-profile title="Status Perkawinan" key="status_perkawinan" type="text" value="${user.status_perkawinan}" disabled="true"/>
                                    </div>

                                    <div class="flex gap-5 mb-3">
                                    <x-form.input-profile title="Role" key="role" type="text" value="${user.role}" disabled="true" />

                                    </div>

                                    <div class="form-action mb-4">
                                        <div class="flex">
                                            <button type="submit" class="px-4 py-2 bg-blue-500 rounded-md text-sm text-white" aria-current="directSubmitButton" @click.prevent="window.utils.Request.actionRequest('{{ route('user.profile.update') }}','#profileUpdate','#profileUpdateForm')">
                                                <span>Save Profile</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            `
                appendProfileElement(profileElement)
            }


            function appendProfileElement(element) {
                $("#panel").fadeOut(500, () => {
                    $("#panel").html(element)
                })

                $("#panel").fadeIn(500, () => {
                    $("#panel").html(element)
                })
            }
    </script>
@endpush
