<div class="popUp bg-white mx-auto rounded-lg px-10 py-5 overflow-y-auto no-scrollbar dark:bg-gray-900 w-full">
    <div class="header border-b">
        <h1 class="text-xl mb-3 dark:text-gray-200">
            {{$title}}
        </h1>
    </div>
    <div class="body">
        <!-- <form action="{{ route('rw.manage.warga.new') }}" method="POST" class="w-full "> -->
            <form>
            <!-- @csrf -->
            <section class="data-diri flex gap-2 mb-2 border-solid border-b py-3 justify-between ">
                <div class="form-wrap-header w-28">
                    <h1 class="text-md dark:text-gray-200">Data Diri</h1>
                </div>
                <div class="form-fields grow">
                    <x-form.inputform title="NKK" key="nkk" name="nkk" type="number" />
                    <x-form.inputform title="NIK" key="nik" name="nik" type="number" />
                    <x-form.inputform title="Email" key="email" name="email" type="email"  />
                    <x-form.inputform title="Password" key="password" name="password" type="password"  />
                    <div class="name flex gap-4 justify-between">
                        <x-form.inputform title="Nama Depan" key="nama_depan" name="nama_depan" type="text"  />
                        <x-form.inputform title="Nama Belakang" key="nama_belakang" name="nama_belakang" type="text" />
                    </div>
                    <div class="birthdate flex gap-4 ">
                        <x-form.inputform title="Tempat Lahir" key="tempat_lahir" name="tempat_lahir" type="text"  />
                        <x-form.inputform title="Tanggal Lahir" key="tanggal_lahir" name="tanggal_lahir" type="date" />
                    </div>
                    <div class="jenis-kelamin-dan-golongan-darah flex gap-4">
                        @php
$genderOptions = \App\Models\UserModel::getKelaminOption();
$golonganDarah = \App\Models\UserModel::getGolonganDarahOption();
                        @endphp
                        <x-form.selectinputform title="Jenis Kelamin" key="jenis_kelamin" name="jenis_kelamin" :options="$genderOptions"  />
                        <x-form.selectinputform title="Golongan Darah" key="golongan_darah" name="golongan_darah" :options="$golonganDarah" />
                    </div>
                    <x-text-area title="Alamat" key="alamat" name="alamat" />
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
                    <x-form.selectinputform title="Agama" key="agama" name="agama" :options="$agama"  />
                    <x-form.selectinputform title="Status Perkawinan" key="status_perkawinan" name="status_perkawinan" :options="$statusPerkawinan" />
                    <x-form.inputform title="Pekerjaan" key="pekerjaan" name="pekerjaan" type="text" />
                    <x-form.selectinputform title="Peran" key="role" name="role" :options="$role"  />
                    <x-form.selectinputform title="Tipe" key="tipe_warga" name="tipe_warga" :options="$tipeWarga"  />
                    <x-form.selectinputform title="RT" key="id_rukun_tetangga" name="id_rukun_tetangga" :options="$rukunTetangga"  />
                </div>
            </section>
            <section class="actionButton w-full flex gap-2 justify-end py-3 px-1">
                <button type="submit" wire:click.prevent="save" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-blue-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-blue-600 dark:hover:bg-blue-500 dark:bg-blue-600">{{$button}}</button>
                <button wire:click="$dispatch('closeModal')"  class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-gray-200 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-gray-600 dark:hover:bg-gray-500 dark:bg-gray-600">Close</button>
            </section>
        </form>
    </div>
</div>