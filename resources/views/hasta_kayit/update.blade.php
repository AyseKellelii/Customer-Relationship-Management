@extends('layout.index')

@section('content')
    burası güncelleme sayfası
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dateRangeModal">
        Tarih Aralığını Seç
    </button>

    <!-- Modal yapısı -->
    <div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateRangeModalLabel">Bilgileri güncelleyin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dateRangeForm" action="{{ route('randevu.filter.data') }}" method="POST">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Başlangıç Tarihi</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Bitiş Tarihi</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                        <a href="{{route('randevu.filter')}}" type="button" id="submitDateRange" class="btn btn-primary" >Filtrele</a>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

@endsection
