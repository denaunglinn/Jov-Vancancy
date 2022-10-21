@extends('layouts.app')
@section('title')
Xsphere
@endsection
@section('content')
<div class="container-fluid bg-white p-0 mb-5">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="container-fluid bg-secondary p-5 px-lg-5">
            <div class="row align-items-center" style="height: 250px;">
                <div class="col-12 col-md-6 text-center ">
                    @if(request()->view == 1)
                    <h1 class="text-white animated zoomIn">Application Form</h1>
                    <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Application Form</li>
                        </ol>
                    </nav>
                    @else 
                    <h1 class="text-white animated zoomIn">Vacancy Detail</h1>
                    <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Vacancy Detail</li>
                        </ol>
                    </nav>
                    @endif
                </div>
                <div class="col-md-6 text-center mb-n5 d-none d-md-block">
                    <img class="img-fluid mt-3" style="height: 400px;" src="{{asset('img/designer.png')}}">
                </div>
            </div>
        </div>
    </div>

    <div>
        {!!$html!!}
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{!! JsValidator::formRequest('App\Http\Requests\StoreApplicationRequest', '#create'); !!}
<script>
$(document).ready(function(){
    
    if("{{ session('errors') }}"){
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '"{{ session('errors') }}"',
        });
    }

    $('.daterange').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
                format: 'YYYY-MM-DD'
        }
    });
});
</script>
@endsection