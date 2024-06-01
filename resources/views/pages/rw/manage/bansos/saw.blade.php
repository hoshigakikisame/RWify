@extends(request()->user()->getSidebarView())
@section('content')
    <h1>SPK SAW</h1>
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
                        <td class="border border-gray-200">Tipe</td>
                        @foreach ($criteriaWeights as $key => $value)
                            <td class="border border-gray-200">{{ $value['type'] }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="border border-gray-200">Bobot</td>
                        @foreach ($criteriaWeights as $key => $value)
                            <td class="border border-gray-200">{{ $value['weight'] }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- initialized table --}}
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

                    @foreach ($raw as $key => $value)
                        <tr>
                            <td class="border border-gray-200">{{ $key }}</td>
                            @foreach ($value as $key2 => $value2)
                                <td class="border border-gray-200">{{ $value2 }}</td>
                            @endforeach
                        </tr>
                    @endforeach

                    <tr>
                        <td class="border border-gray-200">Pembagi</td>
                        @foreach ($divisors as $key => $value)
                            <td class="border border-gray-200">{{ $value }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br><br><br>

    {{-- normalized table --}}
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

                    @foreach ($normalized as $key => $value)
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
