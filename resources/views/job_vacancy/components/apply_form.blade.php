<div class="container-xxl appliction-form py-5">
    <div class="container px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                    <h2 class="mt-2">Application Form</h2>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <form action="{{route('job_vacancy.store-application')}}"  method="POST" enctype="multipart/form-data" id="create"> 
                        @csrf
                        @method('POST')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="hidden" name="vacancy_id" value="{{$vacancy->id}}">
                                <div class="form-group">
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
                                    <input type="text" class="form-control daterange" id="bd" name="bd" placeholder="yyyy - mm - dd">
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
                                    <input type="text" class="form-control" readonly="readonly" id="position" value="{{$vacancy->title}}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image">Upload Your Image</label>
                                    <input type="file" class="form-control"  accept="image/*"  id="image" name="image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="resume">Upload Your Resume <small class="text-danger">(PDF File Only)</small> </label>
                                    <input type="file" accept="application/pdf" class="form-control"  id="resume" name="resume">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>