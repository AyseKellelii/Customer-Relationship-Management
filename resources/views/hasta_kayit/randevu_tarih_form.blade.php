@extends('layout.index')

@section('content')
    <div class="container">
        <!-- Filtreleme Butonu -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary me-4 mt-3" data-bs-toggle="modal" data-bs-target="#dateRangeModal">
                Tarih Seç
            </button>
        </div>

        <!-- Modal yapısı -->
        <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="dateRangeModalLabel">Tarih Aralığı Seçin</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="dateRangeForm" method="GET" action="{{ route('randevu.filter.data') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Başlangıç Tarihi</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Bitiş Tarihi</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrele</button>
                            <a href="{{ route('hastakayit') }}" class="btn btn-secondary ms-2">
                                Tüm Kayıtlar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables tablosu -->

        <div class="card">
            <h5 class="card-header"> Tarih Aralığındaki Kayıtlar</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="aramaTable">
                    <thead>
                    <tr>
                        <th>Sıra No</th>
                        <th>Tarih</th>
                        <th>Hasta Adı Soyadı</th>
                        <th>Takip Türü</th>
                        <th>Takip Açıklaması</th>
                        <th>Sorumlu Personel</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody" class="table-border-bottom-0">
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->sira_no }}</td>
                            <td>{{ $item->tarih }}</td>
                            <td>{{ $item->hasta_adsoyad }}</td>
                            <td>{{ $item->takip_turu }}</td>
                            <td>{{ $item->takip_aciklamasi }}</td>
                            <td>{{ $item->sorumlu_personel }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection

@section('scripts')
            <script>
                $(document).ready(function() {
                    $('#dateRangeForm').on('submit', function(e) {
                        e.preventDefault();

                        var startDate = $('#start_date').val();
                        var endDate = $('#end_date').val();

                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'GET',
                            data: $(this).serialize(),
                            success: function(response) {
                                // Modal içeriğini güncelle
                                $('#dateRangeModal').modal('hide');

                                // HTML tablosunu güncelle
                                $('#tableBody').html(response.data); // AJAX yanıtından verileri güncelle

                                // Başlık kısmını güncelle
                                $('#dateRangeHeader').text('Seçilen Tarih Aralığı: ' + startDate + ' - ' + endDate);
                            }
                        });
                    });
                });
            </script>
@endsection
