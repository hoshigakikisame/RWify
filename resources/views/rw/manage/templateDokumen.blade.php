{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

@push('style')
<style>
    table, th, td {
        border: 1px solid white;
        color: white;
    }
</style>
@endpush

{{-- content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Manage Data Template Dokumen</h1>
            </div>
        </div>
        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th>ID Template Dokumen</th>
                        <th>Nama Template</th>
                        <th>Path Template</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($templateDokumenInstances as $templateDokumen)
                    <tr>
                        <td>
                            {{ $templateDokumen->getIdTemplateDokumen() }}
                        </td>
                        <td>
                            {{ $templateDokumen->getNamaTemplate() }}
                        </td>
                        <td>
                            {{ $templateDokumen->getPathTemplate() }}
                        </td>
                        <td>
                            <div class="d-flex" id="action_wrapper">
                                <a href="">Update</a>
                                <a href="">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
