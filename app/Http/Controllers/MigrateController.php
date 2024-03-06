<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auxiliar;
use App\Models\NomMigrarLote;
use PHPExcel_IOFactory;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\DB;


class MigrateController extends Controller
{
    public function index(){

        $auxiliar = Auxiliar::where('usado',0)->get();

        return view('migrate',  compact('auxiliar'));
    }

    public function subirArchivo(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'archivo' => 'required|mimes:xls,xlsx'
            ]);

            $archivo = $request->file('archivo');

            if ($archivo) {

                $nameDocument = $archivo->getClientOriginalName();
                $request->session()->put('nameDocument', $nameDocument);

                $reader = new Xlsx();

                // Cargar el archivo
                $spreadsheet = $reader->load($archivo);

                // Obtener la primera hoja del archivo
                $sheet = $spreadsheet->getActiveSheet();

                // Verificar la cantidad de columnas
                if ($sheet->getHighestColumn() != 'E') {
                    return redirect()->back()->with('error', 'El archivo no tiene la cantidad de columnas esperada.');
                }

                $data = [];
                $highestRow = $sheet->getHighestRow();

                for ($row = 2; $row <= $highestRow; $row++) {
                    $cedula = $sheet->getCell('A' . $row)->getValue();
                    $concepto = $sheet->getCell('B' . $row)->getValue();
                    $cantidad = $sheet->getCell('C' . $row)->getValue();
                    $monto = $sheet->getCell('D' . $row)->getValue();
                    $fecha = $sheet->getCell('E' . $row)->getValue();

                    $validator = Validator::make([
                        'cedula' => $cedula,
                        'concepto' => $concepto,
                        'cantidad' => $cantidad,
                        'monto' => $monto,
                        'fecha' => $fecha,
                    ], [
                        'cedula' => 'required|numeric',
                        'concepto' => 'required|max:3',
                        'cantidad' => 'required|numeric',
                        'monto' => 'required|numeric',
                        'fecha' => 'required|date_format:Y-m-d',
                    ], [
                        'cedula.required' => 'Una celda de la columna cedula esta vacio.',
                        'cedula.numeric' => 'El campo cedula debe ser numérico.',
                        'concepto.required' => 'Una celda de la columna concepto esta vacio.',
                        'concepto.max' => 'El campo concepto no puede tener más de 3 caracteres.',
                        'cantidad.required' => 'Una celda de la columna cantidad esta vacio.',
                        'cantidad.numeric' => 'El campo cantidad debe ser numérico.',
                        'monto.required' => 'Una celda de la columna  monto esta vacio.',
                        'monto.numeric' => 'El campo monto debe ser numérico.',
                        'fecha.required' => 'Una celda de la columna  fecha esta vacio.',
                        'fecha.date_format' => 'El campo fecha debe tener el formato YYYY-MM-DD.',
                    ]);

                    if ($validator->fails()) {

                        $errors = $validator->errors();
                        $errorMessage = '';

                        foreach ($errors->all() as $message) {
                            $errorMessage .= $message . ' ';
                        }

                        return redirect()->back()->with('error', $errorMessage);
                    }

                    $data[] = [
                        'cedula' => $cedula,
                        'concepto' => $concepto,
                        'cantidad' => $cantidad,
                        'monto' => $monto,
                        'fecha' => $fecha,
                    ];
                }

                foreach ($data as $row) {
                    Auxiliar::create([
                        'cedula' => $row['cedula'],
                        'codcon' => $row['concepto'],
                        'cantidad' => $row['cantidad'],
                        'monto' => $row['monto'],
                        'fecha' => $row['fecha'],
                        'usado' => 0,
                    ]);
                }

                DB::commit();

                return redirect()->back()->with('success', 'Los datos se han guardado correctamente.');

            }else{
                return redirect()->back()->with('error', 'Debe seleccionar un archivo valido');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al subir el archivo: ' . $e->getMessage());
        }

    }

    public function migrarConceptos(){

        try {

            DB::beginTransaction();

            $nameDocument = session('nameDocument');

            if (!$nameDocument) {
                return redirect()->back()->with('error', 'No se ha subido ningún archivo.');
            }

            $auxiliar = Auxiliar::where('usado',0)->get();

            if(count($auxiliar) === 0){
                return redirect()->back()->with('error', 'No se encontraron datos para migrar.');
            }

            $query = "update sigre.npasiconemp
            SET cantidad = cat.cantidad, monto=cat.monto
            FROM
                rrhh.auxiliar cat
                where   cat.cedula=(cast(sigre.npasiconemp.codemp as integer ))
            and cat.codcon=sigre.npasiconemp.codcon and
            cat.usado=0";

            $result = DB::statement($query);

            if (!$result) {
                DB::rollBack();
                return redirect()->back()->with('error', 'No se encontraron datos para migrar.');
            }

            $maxIdMigrarlote = DB::table('rrhh.nom_migrarlote')
                ->select(DB::raw('MAX(CAST(SUBSTRING(idmigrarlote, 4, 10) AS INTEGER)) + 1 AS max_id'))
                ->first();

            $maxIdMigrarloteValue = 'SA-' . $maxIdMigrarlote->max_id;

            NomMigrarLote::saveNomMigrarLote($maxIdMigrarloteValue,$nameDocument);

            Auxiliar::where('usado', '=', 0)->update(['usado' => 1]);

            DB::commit();

            session()->forget('nameDocument');

            return redirect()->back()->with('success', 'Migracion realizada exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al migrar los conceptos: ' . $e->getMessage());
        }
    }

    public function cleanData(){
        try {

            $auxiliar = Auxiliar::where('usado',0)->get();

            if(count($auxiliar) === 0){
                return redirect()->back()->with('error', 'No se encontraron datos para borrar.');
            }

            Auxiliar::where('usado', 0)->delete();

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Ocurrió un error al eliminar los datos: ' . $e->getMessage());
        }

    }
}
