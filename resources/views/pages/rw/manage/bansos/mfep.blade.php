@extends(request()->user()->getSidebarView())
@section('content')
    <h1>SPK MFEP</h1>
    {{-- criteria weight table --}}
    <div class="flex flex-col w-full">
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200">Kriteria</th>
                        @foreach ($criteriaWeights as $key => $value)
                            <th class="border border-gray-200">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-200">Bobot</td>
                        @foreach ($criteriaWeights as $key => $value)
                            <td class="border border-gray-200">{{ $value }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- raw table --}}
    <div class="flex flex-col w-full">
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200">Alt/Kriteria</th>
                        @foreach ($criteriaWeights as $key => $value)
                            <th class="border border-gray-200">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($raw as $key => $value)
                        <tr>
                            <td class="border border-gray-200">{{ $key }}</td>
                            @foreach ($value as $key2 => $value2)
                                <td class="border border-gray-200">{{ $value2 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- factored table --}}
    <div class="flex flex-col w-full">
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200">Alt/Faktor</th>
                        @foreach ($criteriaWeights as $key => $value)
                            <th class="border border-gray-200">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($factored as $key => $value)
                        <tr>
                            <td class="border border-gray-200">{{ $key }}</td>
                            @foreach ($value as $key2 => $value2)
                                <td class="border border-gray-200">{{ $value2 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- weighted table --}}
    <div class="flex flex-col w-full">
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200">Alt/Bobot</th>
                        @foreach ($criteriaWeights as $key => $value)
                            <th class="border border-gray-200">{{ $key }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weighted as $key => $value)
                        <tr>
                            <td class="border border-gray-200">{{ $key }}</td>
                            @foreach ($value as $key2 => $value2)
                                <td class="border border-gray-200">{{ $value2 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- ranking table --}}
    <div class="flex flex-col w-full">
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-200">Ranking</th>
                        <th class="border border-gray-200">Alternatif</th>
                        <th class="border border-gray-200">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $key => $value)
                        <tr>
                            <td class="border border-gray-200">{{ $key + 1 }}</td>
                            <td class="border border-gray-200">{{ $value['instance']->getNkk() }}</td>
                            <td class="border border-gray-200">{{ $value['preference'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection