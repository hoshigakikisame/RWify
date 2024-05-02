{{-- extend to layouts/app --}}
@extends('layouts.sidebar.rw-sidebar')

@push('style')
@endpush

{{-- content --}}
@section('content')
    <div class="container text-gray-900 dark:text-gray-200">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage Data Jadwal Temu</h1>
            </div>
        </div>
        <div class="row">
            <table class="table-auto">
                <thead class="bg-gray-200 dark:bg-gray-800 border-b">
                    <tr>
                        <th>ID Jadwal Temu</th>
                        <th>Nama Pemohon</th>
                        <th>Subjek</th>
                        <th>Pesan</th>
                        <th>Jadwal Temu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservasiJadwalTemuInstances as $reservasiJadwalTemu)
                        <tr class="border-b">
                            <td>
                                {{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}
                            </td>
                            <td>
                                {{ $reservasiJadwalTemu->getPemohon()->getNamaDepan() }}
                            </td>
                            <td>
                                {{ $reservasiJadwalTemu->getSubjek() }}
                            </td>
                            <td>
                                {{ $reservasiJadwalTemu->getPesan() }}
                            </td>
                            <td>
                                {{ $reservasiJadwalTemu->getJadwalTemu() }}
                            </td>
                            <td>
                                <form action="{{route('rw.manage.reservasiJadwalTemu.update')}}" method="post" autocomplete="off">
                                    @csrf
                                    <x-form.inputform title="" id="idReservasiJadwalTemu" key="idReservasiJadwalTemu" type="hidden"
                                        value="{{ $reservasiJadwalTemu->getIdReservasiJadwalTemu() }}" placeholder="" />

                                    <label for="status">Select Status:</label>
                                    <select name="status" id="status" onchange="this.form.submit()">
                                        @foreach (\App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum::getValues() as $status)
                                            <option value="{{ $status }}"
                                                {{ $status == $reservasiJadwalTemu->getStatus() ? 'selected=selected' : ''}}>
                                                {{ $status }}</option>
                                        @endforeach
                                    </select>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
