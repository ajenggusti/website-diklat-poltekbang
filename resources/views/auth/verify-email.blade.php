@extends('layout/mainUser')

@section('container')
<style>
    /* CSS Code */
    .card {
        margin-top: 50px;
    }

    .alert {
        max-width: 500px;
        margin: auto;
        border-radius: 10px;
    }

    .alert-heading {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .container{
        padding-bottom: 20px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notification</div>

                <div class="card-body text-center">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Success!</h4>
                        <p>Hai, email sudah terkirim.</p>
                        <hr>
                        <p class="mb-0">Terima kasih telah mendaftar. Silakan cek email Anda untuk verifikasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
