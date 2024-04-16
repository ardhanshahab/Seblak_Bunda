@extends('layouts.backend.cashier')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-warning mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Hi,{{ auth()->user()->name }}</h5>
                            <span>{{ Date('D,d F Y') }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                    placeholder="Cari Produk">
                                <div class="input-group-append">
                                    <button class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-warning p-2" >
                <div class="row mb-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-warning" data-filter="all">Semua</button>
                        @foreach ($data['category'] as $category)
                            <button type="button" class="btn btn-warning"
                                data-filter=".{{ $category->slug }}">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="row" data-ref="mixitup-container" id="daftar-produk">
                    @foreach ($data['product'] as $product)
                        <div class="col-md-3 mix {{ $product->category->slug }}" data-ref="mixitup-target">
                            <div class="card shadow">
                                <div class="card-body p-2">
                                    <img src="{{ $product->thumbnail_path }}" alt="" srcset=""
                                        class="w-100 rounded" style="height: 160px;object-fit:cover">
                                    <h6 class="mt-2" style="color: #1f1f1f">{{ $product->name }}</h6>
                                    <h5 class="text-warning">{{ $product->price_rupiah }}</h5>
                                    <a href="javascript:;" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-image="{{ $product->thumbnail_path }}"  data-price="{{ $product->price }}" class="btn btn-sm btn-block btn-warning btn-add">TAMBAH</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-warning mb-3" style="height: 400px;">
                <div class="card-header">
                    <h3 class="card-title">Rincian Pesanan</h3>
                </div>
                <div class="card-body py-4" id="list-detail">
                    <div class="row" id="daftar-pesanan">

                    </div>
                </div>
            </div>
            <div class="card card-warning">
               <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6>Subtotal</h6>
                    <h6>25.000</h6>
                </div>
                <div class="d-flex justify-content-between">
                    <h6>PPN (10%)</h6>
                    <h6>25.000</h6>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <h6>25.000</h6>
                </div>
                <div class="text-right">
                    <a href="" class="btn btn-warning">Proses Pembayaran</a>
                </div>
               </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .aktif {
            box-shadow: 0 2px 6px #ffffff;
            background-color: #ffffff;
            border-color: #ffa426;
            color: #ffa426;
        }

        .posisi-relative {
            position: relative;
        }

        .posisi-top-kanan {
            position: absolute;
            top: 0;
            right: 0
        }

        .posisi-bottom-kiri {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 95px
        }

        .gambar-detail {
            height: 65px;
            width: 65px;
            object-fit: cover;
            float: left;
            margin-right: 5px
        }

        .judul-detail {
            color: #1f1f1f;
            font-weight: 700;
            font-size: 18px
        }

        .harga-detail {
            font-weight: bold;
            font-size: 16px;
            position: absolute;
            bottom: 0;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('mixitup/mixitup.min.js') }}"></script>
    <script>
         $("#list-detail").css({
            height: 300,
        }).niceScroll();
        $("#daftar-produk").css({
            height: 400,
        }).niceScroll();
        var containerEl = document.querySelector('[data-ref~="mixitup-container"]');

        var mixer = mixitup(containerEl, {
            selectors: {
                target: '[data-ref~="mixitup-target"]'
            }
        });
        var arrayId = [];
        $('.btn-add').on('click', function() {
            var name = $(this).data('name')
            var image = $(this).data('image')
            var price = $(this).data('price')
            var id = 'id-' + $(this).data('id')
            let hasKey = arrayId.includes(id); 
            var content = `
                <div class="col-12 posisi-relative mb-3 `+id+`" >
                            <img src="`+image+`" alt="" srcset=""
                                class="rounded gambar-detail">
                            <span class="mt-2 text-bold judul-detail">`+name+` </span> <br>
                            <span class="text-warning harga-detail">`+price+`</span>
                            <button type="button" onclick="hapus('`+id+`')" class="btn btn-danger btn-sm px-2 posisi-top-kanan" ><i class="fa fa-times"></i></button>
                            <div class="input-group posisi-bottom-kiri">
                                <div class="input-group-prepend">
                                    <button class="btn btn-warning btn-sm shadow-none " type="button">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm" placeholder="" aria-label=""
                                    value="1" style="text-align: center">
                                <div class="input-group-append">
                                    <button class="btn btn-warning btn-sm shadow-none " type="button">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                `;
            if (hasKey) {
                
            } else {
                arrayId.push(id);
                $('#daftar-pesanan').append(content);
            }
         
            
        });
        function hapus(id){
            $('.' + id).remove();
            var newArray = arrayId.filter(function(f) { return f !== ''+id+'' })
            arrayId = [];
            arrayId = newArray
            console.log(arrayId)
        }

    </script>
@endpush
