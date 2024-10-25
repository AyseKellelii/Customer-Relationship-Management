@extends('layout.index')

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Yeni Hasta Kayıt</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Hasta Kayıt Bilgileri </h5>
                        <small class="text-muted float-end">CRM-Hasta Kayıt</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('create_add_hasta') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="hasta_adsoyad">Ad Soyad</label>
                                <input type="text" class="form-control" id="hasta_adsoyad" name="hasta_adsoyad" placeholder="Ad Soyad Giriniz">
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
                                <label class="form-label" for="takip_aciklamasi">Takip Açıklaması</label>
                                <textarea id="takip_aciklamasi" class="form-control" name="takip_aciklamasi" placeholder="Açıklama Giriniz"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sorumlu_personel">Sorumlu Personel</label>
                                <textarea id="sorumlu_personel" class="form-control" name="sorumlu_personel" placeholder="Sorumlu Personel"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
