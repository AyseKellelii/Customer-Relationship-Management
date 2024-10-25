@extends('layout.index')

@section('content')

    <div class="alert alert-primary" role="alert">
        <h2>
            MedData - Müşteri İlişkileri Yönetimi Sayfasına Hoşgeldiniz
        </h2></div>

    <div class="row mb-5">
        <div class="col-md">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="card-img card-img-left" src="{{asset('sign_in/assets/img/elements/12.jpg')}}" alt="Card image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">CRM Hasta Kayıt</h4>
                            <p class="card-text">
                                {{ $randevuSayisi }}
                            </p>

                            <a href="{{route('create_hasta')}}" class="btn btn-primary">Yeni Kayıt</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-title">Yapılan Arama Sayısı</h4>
                            <p class="card-text">
                                {{ $aramaSayisi }}
                            </p>
                            <a href="{{route('aramaYap')}}" class="btn btn-primary">
                               Arama Kayıtları
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img class="card-img card-img-right" src="{{asset('sign_in/assets/img/elements/1.jpg')}}" alt="Card image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Bilgileriniz </h5>
                        <p class="mb-4">
                          <span style="font-weight: bold;">  Kulanıcı Adı: </span> {{Auth::user()->loginame}}  <br>
                            <span style="font-weight: bold;">  Adı: </span> {{ Auth::user()->adi }} <br>
                            <span style="font-weight: bold;"> Soyadı: </span>{{ Auth::user()->soyadi }} <br>
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{asset('sign_in/assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
