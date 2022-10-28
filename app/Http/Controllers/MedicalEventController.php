<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedEventResource;
use App\Models\MedicalEvent;
use Illuminate\Http\Request;
use App\Http\Resources\ResponseResource;
use App\Http\Resources\MedicalEventCollection;
use App\Http\Utils\Message;
use App\Interfaces\MedicalEventRepositoryInterface;
use App\Interfaces\DoctorRepositoryInterface;
use App\Interfaces\PatientsRepositoryInterface;
use App\Interfaces\CirugiaRepositoryInterface;
use App\Interfaces\AnesthesiaRepositoryInterface;
use App\Interfaces\DiagnosticRepositoryInterface;
use App\Interfaces\SourceRepositoryInterface;
use App\Interfaces\MaterialRepositoryInterface;
use App\Interfaces\ParrillaRepositoryInterface;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Date;
use App\Models\Parrilla;

use Illuminate\Support\Facades\DB;
use mysqli;

class MedicalEventController extends Controller
{
    private $repository;

    public function __construct(
        MedicalEventRepositoryInterface $repository,
        DoctorRepositoryInterface $doctorRepository,
        PatientsRepositoryInterface $patientRepository,
        CirugiaRepositoryInterface $cirugiaRepository,
        AnesthesiaRepositoryInterface $anesteshiaRepository,
        DiagnosticRepositoryInterface $diagnosticRepository,
        SourceRepositoryInterface $sourceRepository,
        MaterialRepositoryInterface $materialRepository,
        ParrillaRepositoryInterface $parrillaRepository
    ) {
        $this->repository = $repository;
        $this->doctorRepository = $doctorRepository;
        $this->patientRepository = $patientRepository;
        $this->cirugiaRepository = $cirugiaRepository;
        $this->anesteshiaRepository = $anesteshiaRepository;
        $this->diagnosticRepository = $diagnosticRepository;
        $this->sourceRepository = $sourceRepository;
        $this->materialRepository = $materialRepository;
        $this->parrillaRepository = $parrillaRepository;
    }

    public function create(Request $request)
    {
        $config = (object)array("tipo" => 0);
        $iddoctor = $request->iddoctor;
        $idpatient = $request->idpatient;
        $idcirugia = $request->idcirugia;
        $idanesthesia = $request->idanesthesia;
        $iddiagnostic = $request->iddiagnostic;
        $idmaterial = $request->idmaterial;
        $idsource = $request->idsource;
        $nombrecirujano = "";
        $nombrecirugia = "";

        if ($request->iddoctor == null || $request->iddoctor == 'null') {
            $createDoctor = $this->doctorRepository->create(["first_lastname" => $request->firstLastnamedoctor, "second_lastname" => $request->secondLastnamedoctor, "name" => $request->namedoctor, "idspecialty" => $request->idspecialty]);
            $iddoctor = $createDoctor->iddoctor;
            $nombrecirujano = $createDoctor->name . ' ' . $createDoctor->first_lastname . ' ' . $createDoctor->second_lastname;
        } else {
            $cirujano = $this->doctorRepository->findById($request->iddoctor);
            $nombrecirujano = $cirujano->name . ' ' . $cirujano->first_lastname . ' ' . $cirujano->second_lastname;
        }
        if ($request->idpatient  == null || $request->idpatient  == 'null') {
            $createPatient = $this->patientRepository->create(["first_name" => $request->firstnamepatient, "last_name" => $request->lastnamepatient, "age" => $request->agepacient]);
            $idpatient = $createPatient->idpatient;
        }
        if ($request->idcirugia  == null || $request->idcirugia  == 'null') {
            $createCirugia = $this->cirugiaRepository->create(["description" => $request->descriptioncirugia]);
            $idcirugia = $createCirugia->idcirugia;
            $nombrecirugia = $createCirugia->description;
        } else {
            $cirugia = $this->cirugiaRepository->findById($request->idcirugia);
            $nombrecirugia = $cirugia->description;
        }
        if ($request->idanesthesia  == null || $request->idanesthesia  == 'null') {
            $createAnesthesia = $this->anesteshiaRepository->create(["description" => $request->descriptionanesthesia]);
            $idanesthesia = $createAnesthesia->idanesthesia;
        }
        if ($request->iddiagnostic  == null || $request->iddiagnostic  == 'null') {
            $createDiagnostic = $this->diagnosticRepository->create(["description" => $request->descriptiondiagnostic]);
            $iddiagnostic = $createDiagnostic->iddiagnostic;
        }
        if ($request->idsource  == null || $request->idsource  == 'null') {
            $createSource = $this->sourceRepository->create(["description" => $request->descriptiondiagnostic]);
            $idsource = $createSource->idsource;
        }

        if ($request->idmaterial  == null || $request->idmaterial  == 'null') {
            $createMaterial = $this->materialRepository->create(["name_material" => $request->descripcionmaterial]);
            $idmaterial = $createMaterial->idmaterial;
        }


        $medicalEvent = array(
            "title" => $nombrecirujano . ' - ' . $nombrecirugia,
            "start" => $request->start,
            "duration" => $request->duration,
            "end" => $request->end,
            "calendar" => intval($request->resourceId),
            "resourceId" => $request->resourceId,
            "iddoctor" => $iddoctor,
            "idpatient" => $idpatient,
            "idequipment" => $request->idequipment,
            "idcirugia" => $idcirugia,
            "idanesthesia" => $idanesthesia,
            "hospital_days" => $request->hospital_days,
            "iddiagnostic" => $iddiagnostic,
            "idsource" => $idsource,
            "idmaterial" => $idmaterial,
            "observations" => $request->observations
        );

        $wheresqlraw = "((start<'" . $request->start . "' and end >'" . $request->start . "' ) OR (start < '" . $request->end . "' and end > '" . $request->end . "') OR (start >= '" . $request->start . "' and end <= '" . $request->end . "')) and (resourceId = " . $request->resourceId . ")";
        $existing = DB::table("medical_event")->whereRaw($wheresqlraw)->get();
        if (count($existing) > 0) {
            error_log("-existente");
            return json_encode(
                array(
                    "id" => 0,
                    "message" => "No se puede reservar una sala dentro de un rango de programación ya existente.",
                    "code" => "-1"
                ),
                JSON_PRETTY_PRINT
            );
        }

        $wheresqlraw = "((start<'" . $request->start . "' and end >'" . $request->start . "' ) OR (start < '" . $request->end . "' and end > '" . $request->end . "') OR (start >= '" . $request->start . "' and end <= '" . $request->end . "')) and (resourceId != " . $request->resourceId . " and idequipment = " . $request->idequipment . ")";
        $existing = DB::table("medical_event")->whereRaw($wheresqlraw)->get();
        $message = "";
        if (count($existing) > 0) {
            $message = json_encode(
                array(
                    "id" => 0,
                    "message" => "El mismo equipo será utilizado en otra sala a la misma hora.",
                    "code" => "-2"
                ),
                JSON_PRETTY_PRINT
            );
        }

        if ($message != "") {
            error_log("create C");
            $this->repository->create($medicalEvent);
            return $message;
        }

        return  ResponseResource::Response($this->repository->create($medicalEvent), $config);

    }

    public function update($id, Request $request)
    {

        //Vali
        $wheresqlraw = "((start<'".$request->start."' and end >'".$request->start."') OR (start < '" . $request->end . "' and end > '" . $request->end . "') OR (start >= '" . $request->start . "' and end <= '" . $request->end . "')) and (id <> " . $request->id . " and resourceId != " . $request->resourceId . " and idequipment = " . $request->idequipment . ")";
        error_log($wheresqlraw);
        error_log("befsql");
        $existing = DB::table("medical_event")->whereRaw($wheresqlraw)->get();

            error_log("inup");
        $message = "";
        if (count($existing) > 0) {
            $message = json_encode(
                array(
                    "id" => $id,
                    "message" => "El mismo equipo será utilizado en otra sala a la misma hora.",
                    "code" => "-2"
                ),
                JSON_PRETTY_PRINT
            );
        }

        if ($id == 0 || $id == '0') {
            $model = $this->create($request);
            return $model;
        } else {
            //$sqlraw = "SELECT * FROM medical_event WHERE (start<'".$request->start."' and end >'".$request->start."' ) OR (start < '".$request->end."' and end > '".$request->end."') OR (start >= '".$request->start."' and end <= '".$request->end."') and id <> ".$request->id." and resourceId = ".$request->resourceId."";
            $wheresqlraw = "((start<'" . $request->start . "' and end >'" . $request->start . "' ) OR (start < '" . $request->end . "' and end > '" . $request->end . "') OR (start >= '" . $request->start . "' and end <= '" . $request->end . "')) and (id <> " . $request->id . " and resourceId = " . $request->resourceId . ")";
            $existing = DB::table("medical_event")->whereRaw($wheresqlraw)->get();
            if (count($existing) > 0) {
                return json_encode(
                    array(
                        "id" => $id,
                        "message" => "No se puede reservar una sala dentro de un rango de programación ya existente.",
                        "code" => "-1"
                    ),
                    JSON_PRETTY_PRINT
                );
            }



            $config = (object)array("id" => $id, "tipo" => 1);
            $iddoctor = $request->iddoctor;
            $idpatient = $request->idpatient;
            $idcirugia = $request->idcirugia;
            $idanesthesia = $request->idanesthesia;
            $iddiagnostic = $request->iddiagnostic;
            $idmaterial = $request->idmaterial;
            $idsource = $request->idsource;
            $nombrecirujano = "";
            $nombrecirugia = "";

            if ($request->iddoctor == null || $request->iddoctor == 'null') {
                $createDoctor = $this->doctorRepository->create(["first_lastname" => $request->firstLastnamedoctor, "second_lastname" => $request->secondLastnamedoctor, "name" => $request->namedoctor]);
                $iddoctor = $createDoctor->iddoctor;
                $nombrecirujano = $createDoctor->name . ' ' . $createDoctor->first_lastname . ' ' . $createDoctor->second_lastname;
            } else {
                $cirujano = $this->doctorRepository->findById($request->iddoctor);
                $nombrecirujano = $cirujano->name . ' ' . $cirujano->first_lastname . ' ' . $cirujano->second_lastname;
            }
            if ($request->idpatient  == null || $request->idpatient  == 'null') {
                $createPatient = $this->patientRepository->create(["first_name" => $request->firstnamepatient, "last_name" => $request->lastnamepatient, "age" => $request->agepacient]);
                $idpatient = $createPatient->idpatient;
            }
            if ($request->idcirugia  == null || $request->idcirugia  == 'null') {
                $createCirugia = $this->cirugiaRepository->create(["description" => $request->descriptioncirugia]);
                $idcirugia = $createCirugia->idcirugia;
                $nombrecirugia = $createCirugia->description;
            } else {
                $cirugia = $this->cirugiaRepository->findById($request->idcirugia);
                $nombrecirugia = $cirugia->description;
            }
            if ($request->idanesthesia  == null || $request->idanesthesia  == 'null') {
                $createAnesthesia = $this->anesteshiaRepository->create(["description" => $request->descriptionanesthesia]);
                $idanesthesia = $createAnesthesia->idanesthesia;
            }
            if ($request->iddiagnostic  == null || $request->iddiagnostic  == 'null') {
                $createDiagnostic = $this->diagnosticRepository->create(["description" => $request->descriptiondiagnostic]);
                $iddiagnostic = $createDiagnostic->iddiagnostic;
            }
            if ($request->idsource  == null || $request->idsource  == 'null') {
                $createSource = $this->sourceRepository->create(["description" => $request->descriptiondiagnostic]);
                $idsource = $createSource->idsource;
            }

            if ($request->idmaterial  == null || $request->idmaterial  == 'null') {
                $createMaterial = $this->materialRepository->create(["name_material" => $request->descripcionmaterial]);
                $idmaterial = $createMaterial->idmaterial;
            }


            $medicalEvent = array(
                "title" => $nombrecirujano . ' - ' . $nombrecirugia,
                "start" => $request->start,
                "duration" => $request->duration,
                "end" => $request->end,
                "calendar" => intval($request->resourceId),
                "resourceId" => $request->resourceId,
                "iddoctor" => $iddoctor,
                "idpatient" => $idpatient,
                "idcirugia" => $idcirugia,
                "idanesthesia" => $idanesthesia,
                "hospital_days" => $request->hospital_days,
                "iddiagnostic" => $iddiagnostic,
                "idsource" => $idsource,
                "idmaterial" => $idmaterial,
                "idequipment" => $request->idequipment,
                "observations" => $request->observations
            );

            if ($message != "") {
                $this->repository->update($id, $medicalEvent);
                return $message;
            }

            return  ResponseResource::Response($this->repository->update($id, $medicalEvent), $config);
        }
     
    }

    public function listAll(Request $request)
    {
        return new  MedicalEventCollection($this->repository->all(['*']));
    }

    public function delete($id)
    {
        $enable = ["enable" => 0];
        $config = (object)array("id" => $id, "tipo" => 2);
        return  ResponseResource::Response($this->repository->update($id, $enable), $config);
    }

    public function findById($id)
    {
        $config = (object)array("id" => $id, "tipo" => 4);
        return  ResponseResource::Response($this->repository->findById($id), $config);
    }

    public function findByIdSala($calendar)
    {
        $idsala = MedicalEvent::where('calendar', $calendar)->get();
        if ($idsala->count()) {
            return response()->json([
                'status' => true,
                'data' => $idsala,
                'count' => $idsala->count()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'No existe registro en sala ' . $calendar . '. Sala ' . $calendar . ' no existe.'
            ], 404);
        }
        // return response()->json($idsala);
    }

    public function CadenaProgramacion($inicio, $fin, $sala)
    {

        /* fecha inicio
        hora inicio
        fecha fin
        hora fin */

        $inicio = new DateTime($inicio);
        $fin    = new DateTime($fin);
        $inicio_u = date_timestamp_get($inicio);
        $fin_u = date_timestamp_get($fin);
        $duracion_um = (($fin_u - $inicio_u) / 60) / 30;
        $cadena_duracion = str_pad("", $duracion_um, "1");


        $fecha_inicio_u = mktime(0, 0, 0, $inicio->format('m'), $inicio->format('d'), $inicio->format('Y'));
        $fecha_fin_u = mktime(0, 0, 0, $fin->format('m'), $fin->format('d'), $fin->format('Y'));
        $dias = (($fecha_fin_u - $fecha_inicio_u) / 86400) + 1;
        $pos_inicial = (($inicio_u - $fecha_inicio_u) / 60) / 30;

        $cadena_vacia = "000000000000000000000000000000000000000000000000";


        //leer en la base de datos la cadena del primer dia y, si existe, actualizar cadena
        $cadena_db = Parrilla::select('programacion')
            ->where('fecha', $inicio->format('Y-m-d'))
            ->where('sala', $sala)
            ->first();
        $cadena = (isset($cadena_db['programacion'])) ? $cadena_db->programacion : $cadena_vacia;
        $cadena_inicio_update = isset($cadena_db['programacion']);




        // if caso dias = 2  ///////////////////////////////////////////////////////////////
        // se define la cadena_siguiente
        if ($dias == 2) {

            //leer en la base de datos la cadena del segundo dia y, si existe, actualizar cadena_siguiente

            $cadena_db = Parrilla::select('programacion')
                ->where('fecha', $fin->format('Y-m-d'))
                ->where('sala', $sala)
                ->first();
            $cadena .= (isset($cadena_db['programacion'])) ? $cadena_db->programacion : $cadena_vacia;
            $cadena_fin_update = isset($cadena_db['programacion']);
        }

        //en este punto, cadena tiene la programacion del dia/dias involucrado en 48 o 96 caracteres

        //es libre para ingresar la programacion??

        $programacion_actual = substr($cadena, $pos_inicial, $duracion_um);

        if (preg_match('/[1]+/', $programacion_actual)) {
            //NO se puede programar
            return false;
        } else {
            //es libre, programar!!
            $programacion_actual = substr_replace($cadena, $cadena_duracion, $pos_inicial, $duracion_um);

            $cadena_inicial = array(
                "fecha" => $inicio->format('Y/m/d'),
                "sala" => $sala,
                "programacion" => substr($programacion_actual, 0, 48)
            );

            $cadena_final = array(
                "fecha" => $fin->format('Y/m/d'),
                "sala" => $sala,
                "programacion" => substr($programacion_actual, -48)
            );


            //actualizar tabla base de datos
            //            if ($cadena_inicio_update) {
            $cadena_inicio_actualizada = Parrilla::updateOrCreate(["fecha" => $inicio->format('Y/m/d'), "sala" => $sala]);
            $cadena_inicio_actualizada->programacion = substr($programacion_actual, 0, 48);
            $cadena_inicio_actualizada->save();
            //            }
            //            else {
            //                $this->parrillaRepository->create($cadena_inicial);
            //            }

            if ($dias == 2) {
                // if ($cadena_fin_update) {
                $cadena_fin_actualizada = Parrilla::updateOrCreate(["fecha" => $fin->format('Y/m/d'), "sala" => $sala]);
                $cadena_fin_actualizada->programacion = substr($programacion_actual, -48);
                $cadena_fin_actualizada->save();
                // }
                // else {
                //     $this->parrillaRepository->create($cadena_final);
                // }
            }
        }


        return true;
    }

    public function LimpiarCadenaProgramacion($inicio, $fin, $sala)
    {

        /* fecha inicio
        hora inicio
        fecha fin
        hora fin */

        $inicio = new DateTime($inicio);
        $fin    = new DateTime($fin);
        $inicio_u = date_timestamp_get($inicio);
        $fin_u = date_timestamp_get($fin);
        $duracion_um = (($fin_u - $inicio_u) / 60) / 30;
        $cadena_duracion = str_pad("", $duracion_um, "0");


        $fecha_inicio_u = mktime(0, 0, 0, $inicio->format('m'), $inicio->format('d'), $inicio->format('Y'));
        $fecha_fin_u = mktime(0, 0, 0, $fin->format('m'), $fin->format('d'), $fin->format('Y'));
        $dias = (($fecha_fin_u - $fecha_inicio_u) / 86400) + 1;
        $pos_inicial = (($inicio_u - $fecha_inicio_u) / 60) / 30;

        $cadena_vacia = "000000000000000000000000000000000000000000000000";


        //leer en la base de datos la cadena del primer dia y, si existe, actualizar cadena
        $cadena_db = Parrilla::select('programacion')
            ->where('fecha', $inicio->format('Y-m-d'))
            ->where('sala', $sala)
            ->first();
        $cadena = (isset($cadena_db['programacion'])) ? $cadena_db->programacion : $cadena_vacia;



        //esta pasando un array como pk pero tiene que ser un entero como id


        // if caso dias = 2  ///////////////////////////////////////////////////////////////
        // se define la cadena_siguiente
        if ($dias == 2) {

            //leer en la base de datos la cadena del segundo dia y, si existe, actualizar cadena_siguiente

            $cadena_db = Parrilla::select('programacion')
                ->where('fecha', $fin->format('Y-m-d'))
                ->where('sala', $sala)
                ->first();
            $cadena .= (isset($cadena_db['programacion'])) ? $cadena_db->programacion : $cadena_vacia;
        }


        //en este punto, cadena tiene la programacion del dia/dias involucrado en 48 o 96 caracteres


        $programacion_actual = substr_replace($cadena, $cadena_duracion, $pos_inicial, $duracion_um);

        $cadena_inicial = array(
            "fecha" => $inicio->format('Y/m/d'),
            "sala" => $sala,
            "programacion" => substr($programacion_actual, 0, 48)
        );

        $cadena_final = array(
            "fecha" => $fin->format('Y/m/d'),
            "sala" => $sala,
            "programacion" => substr($programacion_actual, -48)
        );

        //actualizar tabla base de datos
        $cadena_inicio_actualizada = Parrilla::updateOrCreate(["fecha" => $inicio->format('Y/m/d'), "sala" => $sala]);
        $cadena_inicio_actualizada->programacion = substr($programacion_actual, 0, 48);
        $cadena_inicio_actualizada->save();

        if ($dias == 2) {
            $cadena_fin_actualizada = Parrilla::updateOrCreate(["fecha" => $fin->format('Y/m/d'), "sala" => $sala]);
            $cadena_fin_actualizada->programacion = substr($programacion_actual, -48);
            $cadena_fin_actualizada->save();
        }

        return true;
    }
}
