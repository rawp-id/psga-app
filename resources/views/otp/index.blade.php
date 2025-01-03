@extends('layouts.app')
@section('content')

<div class="container text-center mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card borderless shadow" style="border-radius: 15px;">
                <div class="card-body">
                    <form action="/send-otp" method="POST">
                        @csrf
                        <p>Silahkan Masukan Nomor Telepon Yang Terhubung dengan Whatsapp Untuk Verifikasi OTP</p>
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="number" name="number_phone" class="form-control" placeholder="Nomor Telepon"
                                        aria-label="Nomor Telepon" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-outline-primary" style="border-radius: 10px">
                                    <i class="fa-solid fa-circle-chevron-right" style="font-size: 20px"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const phoneInput = document.querySelector("input[placeholder='Nomor Telepon']");

        phoneInput.addEventListener("input", function() {
            phoneInput.value = phoneInput.value.replace(/^0+/, '');
            
            phoneInput.value = phoneInput.value.replace(/[^0-9]/g, '');
        });
    });
</script>
@endsection