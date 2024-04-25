<section id="addPopup" x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">

        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" x-show="modalOpen" x-cloak @click="modalOpen = false"></div>
        <div class="popUp inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl" x-show="modalOpen">
            <div class="header border-b">
                <h1 class="text-xl mb-3 dark:text-gray-200">
                    Add Data Warga
                </h1>
            </div>
            <div class="body">
                <form action="{{ $actionUrl }}" method="POST" class="w-full ">
                    @csrf
                    <section class="data-diri flex gap-2 mb-2 border-solid border-b py-3 justify-between ">
                        <div class="form-wrap-header w-28">
                            <h1 class="text-md dark:text-gray-200">Data Diri</h1>
                        </div>
                        <div class="form-fields grow">
                            <x-inputform title="NKK" key="nkk" name="nkk" type="number" validation="required" />
                            <x-inputform title="NIK" key="nik" name="nik" type="number" validation="required" />
                            <x-inputform title="Email" key="email" name="email" type="email" validation="required" />
                            <x-inputform title="Password" key="password" name="password" type="password" validation="required" />
                            <div class="name flex gap-4 justify-between">
                                <x-inputform title="Nama Depan" key="nama_depan" name="nama_depan" type="text" validation="required" />
                                <x-inputform title="Nama Belakang" key="nama_belakang" name="nama_belakang" type="text" validation="required" />
                            </div>
                            <div class="birthdate flex gap-4 ">
                                <x-inputform title="Tempat Lahir" key="tempat_lahir" name="tempat_lahir" type="text" validation="required" />
                                <x-inputform title="Tanggal Lahir" key="tanggal_lahir" name="tanggal_lahir" type="date" validation="required" />
                            </div>
                            <div class="jenis-kelamin-dan-golongan-darah flex gap-4">
                                @php
                                $genderOptions = \App\Models\UserModel::getKelaminOption();
                                $golonganDarah = \App\Models\UserModel::getGolonganDarahOption();
                                @endphp
                                <x-selectinputform title="Jenis Kelamin" key="jenis_kelamin" name="jenis_kelamin" :options="$genderOptions" validation="required" />
                                <x-selectinputform title="Golongan Darah" key="golongan_darah" name="golongan_darah" :options="$golonganDarah" validation="required" />
                            </div>
                            <x-text-area title="Alamat" key="alamat" name="alamat" validation="required" />
                        </div>
                    </section>
                    <section class="status flex gap-2 border-solid border-b py-3 justify-between ">
                        <div class="form-wrap-header w-28">
                            <h1 class="text-md dark:text-gray-200">Status</h1>
                        </div>
                        <div class="form-fields grow">
                            @php
                            $agama = \App\Models\UserModel::getAgamaOption();
                            $statusPerkawinan = \App\Models\UserModel::getStatusPerkawinanOption();
                            $role = \App\Models\UserModel::getRoleOption();
                            $tipeWarga = \App\Models\UserModel::getTipeWargaOption();
                            $rukunTetangga = \App\Models\UserModel::getRukunTetanggaOption();
                            @endphp
                            <x-selectinputform title="Agama" key="agama" name="agama" :options="$agama" validation="" />
                            <x-selectinputform title="Status Perkawinan" key="status_perkawinan" name="status_perkawinan" :options="$statusPerkawinan" validation="required" />
                            <x-inputform title="Pekerjaan" key="pekerjaan" name="pekerjaan" type="text" validation="" />
                            <x-selectinputform title="Peran" key="role" name="role" :options="$role" validation="required" />
                            <x-selectinputform title="Tipe" key="tipe_warga" name="tipe_warga" :options="$tipeWarga" validation="required" />
                            <x-selectinputform title="RT" key="rukun_tetangga" name="rukun_tetangga" :options="$rukunTetangga" validation="required" />
                        </div>
                    </section>
                    <section class="actionButton w-full flex gap-2 justify-end py-3 px-1">
                        <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">Save</button>
                        <button class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-gray-200 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-gray-600 dark:hover:bg-gray-500 dark:bg-gray-600" onclick="$('#addPopup').remove()">Close</button>
                    </section>
                </form>
            </div>
        </div>
    </div>
</section>