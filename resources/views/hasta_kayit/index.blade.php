@extends('layout.index')

@section('content')

    <!-- Filtreleme Butonu -->
    <div class="d-flex justify-content-end mb-3">
        <button type="button" class="btn btn-primary me-4 mt-3" data-bs-toggle="modal" data-bs-target="#dateRangeModal">
            Tarih Seçiniz
        </button>

        <a href="{{route('create_hasta')}}"  class="btn btn-primary me-4 mt-3">
           +
        </a>
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            {{session('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Düzenle Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Bilgileri Güncelleyin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="{{ route('hasta-kayit.update') }}" method="POST">
                        @csrf
                        <input type="hidden" id="sira_no" name="sira_no">
                        <div class="mb-3">
                            <label for="hasta_adsoyad" class="form-label">Hasta Ad Soyad</label>
                            <input type="text" class="form-control" id="hasta_adsoyad" name="hasta_adsoyad" required>
                        </div>
                        <div class="mb-3">
                            <label for="takip_turu" class="form-label">Takip Türü</label>
                            <select class="form-control" id="takip_turu" name="takip_turu" required>
                                <option value="">Seçiniz</option>
                                <option value="1">Tedavi</option>
                                <option value="2">İlaç </option>
                                <option value="3">Muayene</option>
                                <option value="4">Kontrol</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="takip_aciklamasi" class="form-label">Takip Açıklaması</label>
                            <input type="text" class="form-control" id="takip_aciklamasi" name="takip_aciklamasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="sorumlu_personel" class="form-label">Sorumlu Personel</label>
                            <input type="text" class="form-control" id="sorumlu_personel" name="sorumlu_personel" required>
                        </div>
                        <!-- Diğer form alanları -->
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Arama Notu Güncelle Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Arama Yapılıyor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="record_id" name="id">
                        <div class="mb-3">
                            <label for="baslangic_tarihi" class="form-label">Başlangıç Tarihi</label>
                            <input type="text" class="form-control" id="baslangic_tarihi" name="baslangic_tarihi" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="arama_notu" class="form-label">Arama Notu</label>
                            <input type="text" class="form-control" id="arama_notu" name="arama_notu" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Randevu oluştur Modal -->

    <div class="modal fade" id="randevuModal" tabindex="-1" aria-labelledby="randevuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="randevuModalLabel">Randevu Oluşturun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="randevuForm">
                        @csrf
                        <input type="hidden" id="sira_no" name="sira_no">

                        <div class="mb-3">
                            <label for="rnd_tarih" class="form-label">Randevu Tarihi</label>
                            <input type="text" class="form-control" id="rnd_tarih" name="rnd_tarih" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tc_kimlik_no" class="form-label">TC Kimlik No</label>
                            <input type="text" class="form-control" id="tc_kimlik_no" name="tc_kimlik_no" maxlength="11" pattern="\d{11}" title="Lütfen 11 haneli bir TC Kimlik No giriniz." required>
                        </div>
                        <div class="mb-3">
                            <label for="bolum" class="form-label">Bölüm</label>
                            <select class="form-control" id="bolum" name="bolum" required>
                                <option value="">Seçiniz</option>
                                <option value="75">Acil</option>
                                <option value="90">Laboratuvar</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dr_kodu" class="form-label">Doktor</label>
                            <select class="form-control" id="dr_kodu" name="dr_kodu" required>
                                <option value="">Seçiniz</option>
                                <option value="1">Aysun Çoşkunoğlu Tuncer</option>
                                <option value="2">İbrahim GÖKPINAR</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Randevu Oluştur</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>





    <div class="container">
        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class=""><br>
                <h3>Hasta Bilgileri </h3>

                <table class="table" id="HastaKayitTable">
                    <thead>
                    <tr>
                        <th>Sıra No</th>
                        <th>Tarih</th>
                        <th>Ad Soyad</th>
                        <th>Takip Türü</th>
                        <th>Takip Açıklaması</th>
                        <th>Sorumlu Personel</th>
                        <th>Düzenle</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>


@endsection

@section('script')

    <script>
        $(document).ready(function() {
            // DataTable sadece bir kez başlatılıyor
            var table = $('#HastaKayitTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('hastakayit.fetch') !!}', // AJAX URL
                    data: function (d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },
                columns: [
                    { data: 'sira_no' },
                    { data: 'tarih' },
                    { data: 'hasta_adsoyad' },
                    { data: 'takip_turu' },
                    { data: 'takip_aciklamasi' },
                    { data: 'sorumlu_personel' },
                    {
                        data: 'sira_no',
                        render: function (data, type, row) {
                            return `<button type="button" class="btn btn-success btn-sm btn-update" data-sira_no="${data}">Düzenle</button>
                        <button type="button" class="btn btn-danger btn-sm btn-primary" data-sira_no="${data}">Randevu Oluştur</button>
                        <button type="button" class=" btn btn-danger btn-sm btn-group-vertical" data-sira_no="${data}">Ara</button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });




            // Düzenle butonuna tıklanınca
            $('#HastaKayitTable').on('click', '.btn-update', function() {
                var siraNo = $(this).data('sira_no');

                // AJAX ile bilgileri getirin
                $.ajax({
                    url: `/hasta-kayit/get/${siraNo}`, // URL'yi doğru biçimde kullanın
                    type: 'GET',
                    success: function(response) {
                        // Modal içindeki form alanlarına gelen verileri doldurun
                        $('#sira_no').val(response.sira_no);
                        $('#hasta_adsoyad').val(response.hasta_adsoyad);
                        $('#takip_turu').val(response.takip_turu);
                        $('#takip_aciklamasi').val(response.takip_aciklamasi);
                        $('#sorumlu_personel').val(response.sorumlu_personel);

                        // Modalı açın
                        $('#updateModal').modal('show');
                    },
                    error: function(xhr) {
                        // Hata mesajı
                        alert('Veri alınırken bir hata oluştu.');
                    }
                });
            });



            // Ara butonuna tıklanınca yeni kayıt oluşturma modal'ini açar
            $('#HastaKayitTable').on('click', '.btn-group-vertical', function() {
                // Sıra numarasını al
                var siraNo = $(this).data('sira_no');

                // Türkiye saat diliminde başlangıç tarihini al
                var now = new Date();
                var startDate = now.toLocaleString('sv-SE', { timeZone: 'Europe/Istanbul', hour12: false }).replace('T', ' '); // yyyy-mm-dd hh:mm:ss formatında


                // Modal içindeki gizli alanları doldur
                $('#createModal #record_id').val(siraNo); // Record ID alanını doldur
                $('#createModal #baslangic_tarihi').val(startDate);// Başlangıç tarihini doldur


                // Modal'ı göster
                $('#createModal').modal('show');
            });

            $('#createForm').on('submit', function(e) {
                e.preventDefault();

                // Türkiye saat diliminde bitiş tarihini al
                var now = new Date();
                var endDate = now.toLocaleString('sv-SE', { timeZone: 'Europe/Istanbul', hour12: false }).replace('T', ' '); // yyyy-mm-dd hh:mm:ss formatında

                // Form verilerini oluştur
                var formData = $(this).serializeArray();
                formData.push({ name: 'bitis_tarihi', value: endDate }); // Bitiş tarihini ekle

                // AJAX isteği
                $.ajax({
                    url: '{{ route("arama.store") }}', // Doğru route ismini kullan
                    type: 'POST',
                    data: $.param(formData), // Form verilerini uygun formatta gönder
                    success: function(response) {
                        $('#createModal').modal('hide'); // Modal'ı kapat
                        console.log('Success:', response);
                        if (response.success) {
                            alert(response.success); // Başarı mesajı göster
                        } else {
                            alert('Kayıt oluşturulamadı.');
                        }
                        $('#HastaKayitTable').DataTable().ajax.reload(); // Eğer DataTable kullanıyorsanız tabloyu yenileyin
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                        alert('Yeni kayıt oluşturulamadı. Lütfen tekrar deneyin.');
                    }
                });
            });

            // Randevu oluştur butonuna tıklama işlemi
            $('#HastaKayitTable').on('click', '.btn-primary', function() {
                var siraNo = $(this).data('sira_no');
                var drKodu = $(this).data('dr_kodu');

                // Türkiye saat diliminde başlangıç tarihini ve saatini ayarla
                var now = new Date();
                var startDate = now.toLocaleString('sv-SE', { timeZone: 'Europe/Istanbul', hour12: false }).replace('T', ' '); // yyyy-mm-dd hh:mm:ss formatında

                // Modal içindeki form alanlarını güncelle
                $('#randevuModal #sira_no').val(siraNo);
                $('#randevuModal #rnd_tarih').val(startDate);
                $('#randevuModal #dr_kodu').val(drKodu);
                $('#randevuModal').modal('show');
            });

// Form gönderimi işlemi
            $('#randevuForm').on('submit', function(e) {
                e.preventDefault();

                // Form verilerini topla
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route("randevu.store") }}', // Doğru route ismini kullan
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#randevuModal').modal('hide');
                        console.log('Success:', response);
                        if (response.success) {
                            alert('Randevu başarıyla oluşturuldu.');
                            $('#HastaKayitTable').DataTable().ajax.reload(); // DataTable kullanıyorsanız tabloyu yenileyin
                        } else {
                            alert('Randevu oluşturulamadı.');
                        }
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                        alert('Yeni kayıt oluşturulamadı. Lütfen tekrar deneyin.');
                    }
                });
            });

        });
    </script>



    <style>
        /* Sayfalama kontrollerini gizler */
        #HastaKayitTable_length, #HastaKayitTable_paginate {
            display: none;
        }
    </style>

    <style>
        /* Arama kutusu ve etiketini gizler */
        #HastaKayitTable_filter,
        #HastaKayitTable_filter label {
            display: none;
        }
    </style>

@endsection

