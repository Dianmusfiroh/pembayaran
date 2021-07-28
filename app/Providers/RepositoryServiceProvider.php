<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\ProvinceRepository::class, \App\Repositories\ProvinceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\KabupatenRepository::class, \App\Repositories\KabupatenRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\KecamatanRepository::class, \App\Repositories\KecamatanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DesaRepository::class, \App\Repositories\DesaRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VillagesRepository::class, \App\Repositories\VillagesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\JabatanRepository::class, \App\Repositories\JabatanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\KlasterRepository::class, \App\Repositories\KlasterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\JenjangPendidikanRepository::class, \App\Repositories\JenjangPendidikanRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SkRepository::class, \App\Repositories\SkRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StatusRepository::class, \App\Repositories\StatusRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GttRepository::class, \App\Repositories\GttRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AddressRepository::class, \App\Repositories\AddressRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CandidateProfileRepository::class, \App\Repositories\CandidateProfileRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudyProgramRepository::class, \App\Repositories\StudyProgramRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DepartmentRepository::class, \App\Repositories\DepartmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EducationRepository::class, \App\Repositories\EducationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionRepository::class, \App\Repositories\InstitutionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\QualificationRepository::class, \App\Repositories\QualificationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CertificationRepository::class, \App\Repositories\CertificationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AssesmentRepository::class, \App\Repositories\AssesmentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AssesmentOptionRepository::class, \App\Repositories\AssesmentOptionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AssesmentScoreRepository::class, \App\Repositories\AssesmentScoreRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AssesmentFormRepository::class, \App\Repositories\AssesmentFormRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BankAccountRepository::class, \App\Repositories\BankAccountRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FormationRepository::class, \App\Repositories\FormationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FormationNeedsRepository::class, \App\Repositories\FormationNeedsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstituteRepository::class, \App\Repositories\InstituteRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SkDetailRepository::class, \App\Repositories\SkDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceRepository::class, \App\Repositories\InvoiceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoicePeriodRepository::class, \App\Repositories\InvoicePeriodRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\EducationalStageRepository::class, \App\Repositories\EducationalStageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClusterRepository::class, \App\Repositories\ClusterRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepository::class, \App\Repositories\RoleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SumberRepository::class, \App\Repositories\SumberRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PaguRepository::class, \App\Repositories\PaguRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InvoiceDetailRepository::class, \App\Repositories\InvoiceDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BiodataRepository::class, \App\Repositories\BiodataRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PositionCategoryRepository::class, \App\Repositories\PositionCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AssessmentDetailRepository::class, \App\Repositories\AssessmentDetailRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\IncentiveRepository::class, \App\Repositories\IncentiveRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SettingsRepository::class, \App\Repositories\SettingsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FormationCategoryRepository::class, \App\Repositories\FormationCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GttsRepository::class, \App\Repositories\GttsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OpsekolahRepository::class, \App\Repositories\OpsekolahRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\KinerjaRepository::class, \App\Repositories\KinerjaRepositoryEloquent::class);
        //:end-bindings:
    }
}
