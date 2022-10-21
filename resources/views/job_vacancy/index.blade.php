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
                <div class="col-12 col-md-6 ">
                    <h3 class="text-white">
                        We are hiring for several positions.
                    </h3>
                    <small class="text-white">Are you ready to join us?</small>
                    <div class="position-relative w-100 mt-3">
                        <input class="form-control job_search border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Search job" style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i class="fa fa-search text-primary fs-4"></i></button>
                    </div>
                </div>
                <div class="col-md-6 text-center mb-n5 d-none d-md-block">
                    <img class="img-fluid mt-3" style="height: 400px;" src="{{asset('img/designer.png')}}">
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Our Opening Positions</h6>
                <h2 class="mt-2">We’d love to meet you!</h2>
            </div>

            <div class="row result-body">
                <div class="col-12">
                    <table class="align-middle mb-0 table data-table" style="width:100%;">
                        <thead>
                            <th class="no-sort" hidden>Widget</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
</div>
@endsection
@section('script')
{!! JsValidator::formRequest('App\Http\Requests\StoreApplicationRequest', '#create'); !!}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/index.js')}}"></script>
<script>
     if("{{ session('success') }}"){
        Swal.fire({
        iconHtml: '<img src="../img/successed.png" height="100px">',
        customClass: {
        title: 'swal2-popup',
        },
        title: `You have successfully applied !`,
        text: "Please keep in touch with us , we will contact you back .",  
        showConfirmButton: true,
        })
    }
</script>
@endsection