@extends('layout.index')

@section('content')



    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="fw-bold py-3 mb-4">CRM-Arama Kayıtları</h3>

        <!-- Butonu sağa hizala -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
                Filtrele
            </button>
        </div>

        <!-- Modal -->
        <!-- Modal -->
        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filterModalLabel">Filtreleme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="filterForm" action="{{ route('arama.filtered') }}" method="GET">
                            <div class="mb-3">
                                <label for="kacinci_arama" class="form-label">Kaçıncı Arama</label>
                                <input type="number" id="kacinci_arama" name="kacinci_arama" class="form-control" placeholder="Kaçıncı Arama" value="{{ request('kacinci_arama') }}" min="1" required>
                                <div id="error-message" class="text-danger mt-2" style="display: none;">0 değeri giremezsiniz.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrele</button>
                            <a href="{{ route('aramaYap') }}" class="btn btn-secondary ms-2">
                                Tüm Kayıtlar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Başarı mesajını gösterme -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <h5 class="card-header">Arananlar</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="aramaTable">
                    <thead>
                    <tr>
                        <th id="siraNoHeader" class="sorting sorting_asc"  tabindex="0" aria-controls="HastaKayitTable" rowspan="1" colspan="1" aria-label="Sıra No: activate to sort column descending" style="width: 100px;" aria-sort="ascending">Sıra No</th>
                        <th>Başlangıç Tarihi</th>
                        <th>Bitiş Tarihi</th>
                        <th>Kaçıncı Arama</th>
                        <th>Arama Notu</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody" class="table-border-bottom-0">
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->sira_no }}</td> <!-- Sıra No -->
                            <td>{{ $record->baslangic_tarihi }}</td> <!-- Başlangıç Tarihi -->
                            <td>{{ $record->bitis_tarihi }}</td> <!-- Bitiş Tarihi -->
                            <td>{{ $record->kacinci_arama }}</td> <!-- Kaçıncı Arama -->
                            <td>{{ $record->arama_notu }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var siraNoHeader = document.getElementById('siraNoHeader');
            var table = document.getElementById('aramaTable');
            var tbody = table.querySelector('tbody');

            siraNoHeader.addEventListener('click', function() {
                var rows = Array.from(tbody.querySelectorAll('tr'));
                var isAscending = siraNoHeader.getAttribute('aria-sort') === 'ascending';

                rows.sort(function(rowA, rowB) {
                    var siraNoA = parseInt(rowA.querySelector('td').textContent.trim());
                    var siraNoB = parseInt(rowB.querySelector('td').textContent.trim());

                    return isAscending ? siraNoA - siraNoB : siraNoB - siraNoA;
                });

                // Clear existing rows and append sorted rows
                tbody.innerHTML = '';
                rows.forEach(function(row) {
                    tbody.appendChild(row);
                });

                // Toggle sort direction
                siraNoHeader.setAttribute('aria-sort', isAscending ? 'descending' : 'ascending');
                siraNoHeader.classList.toggle('sorting_asc', isAscending);
                siraNoHeader.classList.toggle('sorting_desc', !isAscending);
            });
        });

    </script>

    <style>
        h2, h5 {
            color: #363440; /* Daha koyu başlık rengi */
            font-weight: 700; /* Başlıkları kalınlaştır */
        }

    </style>





@endsection
