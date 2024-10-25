@extends('layout.index')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h3 class="fw-bold py-3 mb-4">Filtrelenmiş Arama Kayıtları</h3>


        <div class="card">
        <h5 class="card-header">Arananlar</h5>
        <div class="table-responsive text-nowrap">
            <table class="table" id="aramaTable">
                <thead>
                <tr>
                    <th id="siraNoHeader" class="sorting sorting_asc" tabindex="0" aria-controls="HastaKayitTable" rowspan="1" colspan="1" aria-label="Sıra No: activate to sort column descending" style="width: 100px;" aria-sort="ascending">Sıra No</th>
                    <th>Başlangıç Tarihi</th>
                    <th>Bitiş Tarihi</th>
                    <th>Kaçıncı Arama</th>
                    <th>Arama Notu</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>


@endsection


@section('script')
            <script>
                $(document).ready(function() {
                    var table = $('#aramaTable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '{{ route('arama.filtered') }}',
                            data: function (d) {
                                d.kacinci_arama = $('#kacinci_arama').val(); // Formdan seçilen değeri ekleyin
                            }
                        },
                        columns: [
                            { data: 'sira_no', title: 'Sıra No' },
                            { data: 'baslangic_tarihi', title: 'Başlangıç Tarihi' },
                            { data: 'bitis_tarihi', title: 'Bitiş Tarihi' },
                            { data: 'kacinci_arama', title: 'Kaçıncı Arama' },
                            { data: 'arama_notu', title: 'Arama Notu' }
                        ]
                    });

                    $('#filterForm').on('submit', function(e) {
                        e.preventDefault();
                        table.ajax.reload(); // DataTables'ı yenileyin
                    });
                });
            </script>

@endsection
