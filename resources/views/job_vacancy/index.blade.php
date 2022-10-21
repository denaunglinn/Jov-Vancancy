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
<script>
$(document).ready(function(){

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

    var table = $('.data-table').DataTable({
        processing: false,
        serverSide: true,
        bFilter : false,
        lengthChange: false,
        bPaginate: false,
        sDom: "lfr",
        ajax:`/job_vacancy/datatable/ssd`,
        columns: [
        {data: 'widget', name: 'widget', defaultContent: "-"}
        ],
        order: [
        // [0, 'desc']
        ],
        columnDefs: [
        {targets: "no-sort", orderable: false},
        {targets: "hidden", visible: false}
        ],
        language: {
            emptyTable:'<div class="processing_data text-center"><h3 class="text-secondary">No Result Found</h3> <img src="/img/no_result.svg" width="30%"> </div>'
        }
    });

    var timeout = null;
    $(".job_search").keyup(function(){
        var key = $(this).val();
        clearTimeout(timeout);
        timeout = setTimeout(function() {
        table.ajax.url(`/job_vacancy/datatable/ssd?key=${key}`).load();
        },300);
    });

    $(document).on('click', '.application', function(e) {
            e.preventDefault();
            var title = $(this).data('title');
            Swal.fire({
                title: `<div class="section-title position-relative text-center mb-3 " >
                    <h2 class="mt-2">Application Form</h2>
                </div>`,
                width: '600px',
                html: `<form  class="application_form p-3" action="{{route("job_vacancy.store-application")}}" autocomplete="off" method="POST" enctype="multipart/form-data" id="create"> 
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label for="name"> Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"> Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Birthday</label>
                                        <input type="date" class="form-control daterange" id="bd" name="bd" placeholder="mm / dd / yyyy">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message">Address</label>
                                        <textarea class="form-control" placeholder="Address" rows="5" id="address" name="address" ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="position">Applied Position</label>
                                        <input type="text" class="form-control" readonly="readonly" id="position" value="${title}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image">Upload Your Image</label>
                                        <input type="file" class="form-control"  id="image" name="image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="resume">Upload Your Resume <span style="color:red !important; font-size: 0.8rem !important;">( PDF File Only)</span></label>
                                        <input type="file" accept="application/pdf" class="form-control"  id="resume" name="resume">
                                    </div>
                                </div>
                            </div>
                        </form>`,
                showCancelButton: true,
                reverseButtons: true,
                focusConfirm: false,
                confirmButtonText: 'Apply',
                cancelButtonText: 'Close',
               
            }).then((result) => {
                if (result.value) {
                    var formData = new FormData();                    
                    var id = $(this).data('id');
                    var name = $('.application_form #name').val();
                    var email = $('.application_form #email').val();
                    var bd = $('.application_form #bd').val();
                    var phone = $('.application_form #phone').val();
                    var address = $('.application_form #address').val();
                    var image = $('.application_form #image')[0].files[0];
                    var resume = $('.application_form #resume')[0].files[0];
                    formData.append("image" ,image);
                    formData.append("resume" ,resume);

                    $.ajax({
                        contentType: false,
                        processData: false,
                        url: `/job_vacancy/store-application/?vacancy_id=${id}&name=${name}&email=${email}&bd=${bd}&phone=${phone}&address=${address}&image=${image}&resume=${resume}`,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data:formData,
                        type: 'POST',
                        success: function () {
                            Swal.fire({
                            iconHtml: '<img src="../img/successed.png" height="100px">',
                            customClass: {
                            title: 'swal2-popup',
                            },
                            title: `You have successfully applied for ${title} position !`,
                            text: "Please keep in touch with us , we will contact you back .",  
                            showConfirmButton: true,
                            })
                        },
                        error: function(res) {
                            Swal.fire({
                            iconHtml: '<img src="../img/error.png" height="100px">',
                            customClass: {
                            title: 'swal2-popup',
                            },
                            title: `Something Wrong !`,
                            text: "Please check & fill all the required input field !.",  
                            showConfirmButton: false,
                            timer: 2000
                            })
                        }
                    });
                }
            });
        });
});
</script>
@endsection