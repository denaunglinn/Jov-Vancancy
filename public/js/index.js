$(document).ready(function(){

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
                            text: "Please keep in touch with us , we will contact you back soon .",  
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
