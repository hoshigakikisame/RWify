{{-- extend to layouts/app --}}
@extends('layouts.sidebar')

@push('style')

@endpush

{{-- content --}}
@section('content')
<div class="container dark:text-gray-100 text-gray-900">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Manage Data Template Dokumen</h1>
        </div>
    </div>
    <div class="row">
        <table class="table-auto ">
            <thead class="border-b bg-gray-200 dark:bg-gray-800">
                <tr>
                    <th>ID Template Dokumen</th>
                    <th>Nama Template</th>
                    <th>Path Template</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($templateDokumenInstances as $templateDokumen)
                <tr class="border-b">
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