<div class="container-xxl py-5">
    <div class="vacancy-icon flex-shrink-0">
        <i class="fa fa-bullhorn"></i>
    </div>
    <div class="container card  px-lg-5">
        <div class="section-title position-relative pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h3 class="mt-5">{{$vacancy->title}}</h3>
            <div class="pb-2">
                <span class=" badge rounded-pill bg-info"><i class="fa fa-map-marker"></i> {{$vacancy->location}}</span>
                <span class="badge rounded-pill bg-warning"> <i class="fa fa-user"></i> {{$vacancy->required_no}} posts</span>
            </div>
        </div>
        <div class="section-description">
            <h4>Job Description</h4>
            <p class="text-left">
                {{$vacancy->description}}
            </p>
        </div>
        <div class="section-requirement">
            <h4>Job Requirements</h4>
            <p class="text-left">
                {{$vacancy->requirements}}
            </p>
        </div>
        <div class="float-left mb-3">
            <a class="btn btn-secondary btn-outline-info text-white px-3 text-center mt-auto mx-auto" href="{{route('job_vacancy.detail',['id'=>$vacancy->id , 'view' => 1])}}">Apply Now</a>
        </div>
    </div>
</div>