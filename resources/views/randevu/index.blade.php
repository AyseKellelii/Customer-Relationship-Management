@extends('layout.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h2 class="fw-bold py-3 mb-4">CRM-Randevu Kayıtları</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Randevu Detayları</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="aramaTable">
                    <thead>
                    <tr>
                        <th>Sıra No</th>
                        <th>TC Kimlik</th>
                        <th>Doktor Adı</th>
                        <th>Bölüm</th>
                        <th>Randevu Tarihi</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody" class="table-border-bottom-0">
                    @foreach($randevular as $rnd)
                        <tr>
                            <td>{{ $rnd->sira_no }}</td>
                            <td>{{ $rnd->tc_kimlik_no }}</td>
                            <td>{{ $rnd->doktor->adi_soyadi ?? 'Ulaşılamıyor' }}</td>
                            <td>{{ $rnd->doktor->bolum }}</td> <!-- Doktorun bolumunu al -->
                            <td>{{ $rnd->rnd_tarih }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
