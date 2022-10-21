<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class JobVacanciesData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vacancies_data = config('custom_vacancy_data.default');
        foreach ($vacancies_data as $data) {
            JobVacancy::firstOrCreate([
                'title' => $data['title'],
                'description' => $data['description'],
                'requirements' => $data['requirements'],
                'location' => $data['location'],
                'required_no' => $data['required_no'],
            ]);
        }
    }
}
