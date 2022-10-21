<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\JobVacancy;
use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreApplicationRequest;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('job_vacancy.index');
    }

    public function ssd(Request $request){
        if($request->ajax()){
            $data = JobVacancy::query();

            if($request->key){
                $data = $data->where('title', 'LIKE', '%' . $request->key . '%')
                             ->orWhere('description','LIKE', '%' . $request->key . '%')
                             ->orWhere('requirements','LIKE','%' . $request->key . '%')
                             ->orWhere('location','LIKE','%' . $request->key . '%');
            }

            $data = collect($data->get())->chunk(3);
    
            return DataTables::of($data)
            ->addColumn('widget', function ($each) use ($request) {
                        $output = '<div class="row g-4">';
                        foreach($each as $data){
                            $output .= '<div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                            <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                                <div class="service-icon flex-shrink-0">
                                <i class="fa fa-bullhorn"></i>
                                </div>
                                <h5 class="mb-3">'.$data->title.' ('.$data->required_no.') </h5>
                                <div class="info-list-group border-0">
                                    <span class=" badge rounded-pill bg-info"><i class="fa fa-map-marker"></i> - '.$data->location.'</span>
                                    <span class="badge rounded-pill bg-warning"> <i class="fa fa-user"></i> - '.$data->required_no.' posts</span>
                                </div>
                                <p class="mt-2">'.Str::limit(str_replace('-','',$data->description),100).'</p>
                                <div class="row text-center">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                    <a class="btn px-3 text-center mt-auto mx-auto application" data-id='.$data->id.' data-title="'.$data->title.'" > Apply</a>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                    <a class="btn px-3 text-center mt-auto mx-auto"  href="'.route('job_vacancy.detail',['id'=>$data->id , 'view' => 2]).'">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                      
                    return $output . '</div>';
            })
            ->rawColumns(['widget'])
            ->make(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $vacancy = JobVacancy::find($request->id);

        if($request->view == 1){
            $html = view('job_vacancy.components.apply_form', compact('vacancy'))->render();
        }else{
            $html = view('job_vacancy.components.vacancy_detail', compact('vacancy'))->render();
        }

        return view('job_vacancy.detail',compact('html'));
    }

    public function storeApplication(StoreApplicationRequest $request){

        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $image_name = uniqid() . '_' . date('Y-m-d-H-i-s') . '.' . $image_file->getClientOriginalExtension();
            Storage::put(
                'admin/image/' . $image_name,
                file_get_contents($image_file->getRealPath())
            );
        } else {
            $image_name = null;
        }

        if ($request->hasFile('resume')) {
            $resume_file = $request->file('resume');
            $resume_name = uniqid() . '_' . date('Y-m-d-H-i-s') . '.' . $resume_file->getClientOriginalExtension();
            Storage::put(
                'admin/resume/' . $resume_name,
                file_get_contents($resume_file->getRealPath())
            );
        } else {
            $resume_name = null;
        }


        $application =  Application::create([
            'vacancy_id' => $request->vacancy_id,
            'name' => $request->name,
            'email' => $request->email,
            'bd' => Carbon::parse($request->bd)->format('Y-m-d'),
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $image_name,
            'resume' => $resume_name,
        ]);

        return redirect('/')->with('success', 'Successfully Applied.');
    }
   
}
