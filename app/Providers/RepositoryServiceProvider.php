<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\{
    EloquentRepositoryInterface,
    RolRepositoryInterface,
    DoctorRepositoryInterface,
    PatientsRepositoryInterface,
    SupplierRepositoryInterface,
    DiagnosticRepositoryInterface,
    CirugiaRepositoryInterface,
    AnesthesiaRepositoryInterface,
    DiagnosticDetailSpecialtysRepositoryInterface,
    DoctorxpreferenceRepositoryInterface,
    DocumenttypeRepositoryInterface,
    MaterialRepositoryInterface,
    OperatorRepositoryInterface,
    PreferenceRepositoryInterface,
    SourceRepositoryInterface,
    SpecialtyRepositoryInterface,
    UserRepositoryInterface,
    MedicalEventRepositoryInterface,
    EquipmentRepositoryInterface,
    PaymentRepositoryInterface,
    TagRepositoryInterface,
    ParrillaRepositoryInterface,
    SedeRepositoryInterface,
    SupplierMaterialDetailRepositoryInterface
};
use App\Repositories\{
    BaseRepository,
    RolRepository,
    DoctorRepository,
    PatientsRepository,
    SupplierRepository,
    DiagnosticRepository,
    CirugiaRepository,
    AnesthesiaRepository,
    DiagnosticDetailSpecialtysRepository,
    DoctorxpreferenceRepository,
    DocumenttypeRepository,
    MaterialRepository,
    OperatorRepository,
    PreferenceRepository,
    SourceRepository,
    SpecialtyRepository,
    UserRepository,
    MedicalEventRepository,
    EquipmentRepository,
    PaymentRepository,
    TagRepository,
    ParrillaRepository,
    SedeRepository,
    SupplierMaterialDetailRepository
};


class RepositoryServiceProvider extends ServiceProvider
{
    /**     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(RolRepositoryInterface::class, RolRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(PatientsRepositoryInterface::class, PatientsRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(DiagnosticRepositoryInterface::class, DiagnosticRepository::class);
        $this->app->bind(CirugiaRepositoryInterface::class, CirugiaRepository::class);
        $this->app->bind(AnesthesiaRepositoryInterface::class, AnesthesiaRepository::class);
        $this->app->bind(DoctorxpreferenceRepositoryInterface::class, DoctorxpreferenceRepository::class);
        $this->app->bind(DocumenttypeRepositoryInterface::class, DocumenttypeRepository::class);
        $this->app->bind(MaterialRepositoryInterface::class, MaterialRepository::class);
        $this->app->bind(OperatorRepositoryInterface::class, OperatorRepository::class);
        $this->app->bind(PreferenceRepositoryInterface::class, PreferenceRepository::class);
        $this->app->bind(SourceRepositoryInterface::class, SourceRepository::class);
        $this->app->bind(SpecialtyRepositoryInterface::class, SpecialtyRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MedicalEventRepositoryInterface::class, MedicalEventRepository::class);
        $this->app->bind(EquipmentRepositoryInterface::class, EquipmentRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        $this->app->bind(ParrillaRepositoryInterface::class, ParrillaRepository::class);
        $this->app->bind(SedeRepositoryInterface::class, SedeRepository::class);
        $this->app->bind(SupplierMaterialDetailRepositoryInterface::class, SupplierMaterialDetailRepository::class);
        $this->app->bind(DiagnosticDetailSpecialtysRepositoryInterface::class, DiagnosticDetailSpecialtysRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Observers
    }
}
