<?php

namespace App\Http\Controllers;

use App\Models\Documentacion;
use App\Http\Requests\StoreDocumentacionRequest;
use App\Http\Requests\UpdateDocumentacionRequest;
use  App\Models\Documentacions;
use App\Models\Certificacion;

use App\Models\TipoDocumentacions;
use App\Models\Logs;
use App\Models\User;
use App\Models\Paises;
use App\Models\Especie;
use App\Models\Variedad;
use ZipArchive;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Svg\Tag\Rect;

class DocumentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productores=User::where('csg','!=',null)->get();
        $paises=Paises::has('TipoDocumentacion')->get();
        $productores=User::where('csg','!=',null)->get();
        $especies=Especie::has('TipoDocumentacion')->get();
        $tipos=TipoDocumentacions::with('especie','pais')->where('estado',1)->get();
        $documentos=Documentacions::with("TipoDocumentacion")->get();

        return view('documentacions.index',compact('documentos','tipos','paises','especies','productores'));
    }
public function actualizardocto(Request $request){
    $documentacion=Documentacions::where('id',$request->ids)->first();


    return response()->json($documentacion);
}
public function obtenerDocumentoxProductor(Request $request)
{
    $paises=Paises::has('TipoDocumentacion')->get();
        $tiposGlobales=Documentacions::where('user_id', $request->ids)
        ->whereHas('TipoDocumentacion', function ($query) {
            $query->where('global', 1);
        })
        ->get();
        $especies=Especie::has('TipoDocumentacion')->get();
        $tipos=TipoDocumentacions::with('especie','pais')->where('estado',1)->get();
        $documentos=Documentacions::with("TipoDocumentacion")->where('user_id',$request->ids)->get();

        return response()->json([
            'paises' => $paises,
            'especies' => $especies,
            'tipos' => $tipos,
            'documentos' => $documentos,
            'tiposGlobales'=>$tiposGlobales
        ]);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposGlobales=TipoDocumentacions::where('global',1)->where('estado',1)->get();
        $paises=Paises::has('TipoDocumentacion')->get();
        $productores=User::where('csg','!=',null)->OrderBy('name','ASC')->get();
        $especies=Especie::has('TipoDocumentacion')->get();
        $tipodocumentacions=TipoDocumentacions::where('estado',1)->where('global',0)->with('especie','pais')->get();
        //$documentacion=TipoDocumentacions::where('estado',1)->with('especie','pais')->has('Documentacions')->where('user_id',$user->id)->get();
        $documentacion=Documentacions::with(['TipoDocumentacion','TipoDocumentacion.especie', 'TipoDocumentacion.pais'])->get();

        return view('documentacions.create',compact('documentacion','tipodocumentacions','paises','especies','productores','tiposGlobales'));
        //
    }
    public function descargaSeleccionados(Request $request){
     //   dd($request->seleccionados);
        // Crear un nombre único para el archivo ZIP
    $zipFileName = str_replace(' ', '_', $request->nombre) . '_' . time() . '.zip';

    // Ruta completa del archivo ZIP (lo guardaremos temporalmente en el almacenamiento local)
    $zipFilePath = storage_path('app/public/' . $zipFileName);
    $usuario="";
    // Inicializar ZipArchive
    $zip = new ZipArchive;
    if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
        foreach ($request->seleccionados as $docto_id)
        {

            $documentacion=Documentacions::find($docto_id);
             // Obtener la ruta del archivo

             $filePath = storage_path('app/public/' . $documentacion->file);

             // Verificar si el archivo existe
             if (file_exists($filePath)) {
                 // Agregar el archivo al ZIP (con su nombre original)
                 $zip->addFile($filePath, basename($filePath));
             }
        }
         // Cerrar el archivo ZIP
         $zip->close();
        //dd($zipFilePath);
         // Forzar la descarga del archivo ZIP
         return response()->json(['url' => asset('storage/'.$zipFileName)]); // Eliminar el ZIP después de la descarga
     } else {
         return response()->json(['error' => 'No se pudo crear el archivo ZIP'], 500);
     }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDocumentacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd($request);
        if(isset($request->id) && $request->id!='' || $request->id!=null){
            $documentacion=Documentacions::find($request->id);
            $documentacion->tipo_documentacion_id=$request->tipo;
            $documentacion->user_id=$request->user_id;
            $documentacion->nombre=$request->nombre;
            $documentacion->fecha_vigencia=$request->fecha_vigencia;
            $documentacion->descripcion=$request->descripcion;
        }
        else
        {
            $documentacion=new Documentacions();
            $documentacion->tipo_documentacion_id=$request->tipo;
            $documentacion->user_id=$request->user_id;
            $documentacion->nombre=$request->nombre;
            $documentacion->fecha_vigencia=$request->fecha_vigencia;
            $documentacion->descripcion=$request->descripcion;
        }




       if ($request->hasFile('file')) {
        $user=User::find($request->user_id);
        // Guardar el archivo en la carpeta 'uploads' dentro de 'storage/app/public'
        $nombre_archivo=$request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $tipodocto=TipoDocumentacions::find($request->tipo);
        $nombre_archivo=$tipodocto->nombre_guardado.".".$extension;

        $filePath = $request->file('file')->storeAs("documentacion/".str_replace(' ', '-', $user->name)."/", str_replace(' ', '-',$nombre_archivo), 'public');
        $documentacion->file=$filePath;
        }

       // dd($documentacion,$request);
       try{
        $documentacion->save();
        Logs::create([
            'user_id'=>auth()->user()->id,
            'descripcion'=>'Creacion de Documento',
            'tabla'=>'Documentacion',
            'subject_id'=>$documentacion->id,
            'subject_type'=>'App\Models\Documentacion',
            'host'=>request()->ip(),
            'properties'=>json_encode($documentacion->all()),
        ]);
        $mensaje="El Documento fue creado con exito :) !!!!!.";
        }catch(\Exception $e){
            $mensaje="El Documento no fue creado :'( !!!!!.";
            Logs::create([
                'user_id'=>auth()->user()->id,
                'descripcion'=>'Error Creacion de Documento',
                'tabla'=>'Documentacion',
                'subject_id'=>$documentacion->id,
                'subject_type'=>'App\Models\Documentacion',
                'host'=>request()->ip(),
                'properties'=>json_encode($documentacion->all()),
            ]);
        }
        $productores=User::where('csg','!=',null)->get();
        $paises=Paises::has('TipoDocumentacion')->get();
        $productores=User::where('csg','!=',null)->get();
        $especies=Especie::has('TipoDocumentacion')->get();
        $tipos=TipoDocumentacions::with('especie','pais')->where('estado',1)->get();
        $documentos=Documentacions::with("TipoDocumentacion")->get();

        return view('documentacions.index',compact('documentos','tipos','paises','especies','productores'))->with('info',$mensaje.' !!!!!.');



    }
    public function storeDesdeProductor(Request $request)
    {
      //  dd($request);
        if(isset($request->id) && $request->id!='' || $request->id!=null){
            $documentacion=Documentacions::find($request->id);
            $documentacion->tipo_documentacion_id=$request->tipo;
            $documentacion->user_id=$request->user_id;
            $documentacion->nombre=$request->nombre;
            $documentacion->fecha_vigencia=$request->fecha_vigencia;
            $documentacion->descripcion=$request->descripcion;
        }
        else
        {
            $documentacion=new Documentacions();
            $documentacion->tipo_documentacion_id=$request->tipo;
            $documentacion->user_id=$request->user_id;
            $documentacion->nombre=$request->nombre;
            $documentacion->fecha_vigencia=$request->fecha_vigencia;
            $documentacion->descripcion=$request->descripcion;
        }




       if ($request->hasFile('file')) {
        $user=User::find($request->user_id);
        // Guardar el archivo en la carpeta 'uploads' dentro de 'storage/app/public'
        $nombre_archivo=$request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $tipodocto=TipoDocumentacions::find($request->tipo);
        $nombre_archivo=$tipodocto->nombre_guardado.".".$extension;

        $filePath = $request->file('file')->storeAs("documentacion/".str_replace(' ', '-', $user->name)."/", str_replace(' ', '-',$nombre_archivo), 'public');
        $documentacion->file=$filePath;
        }

       // dd($documentacion,$request);
       try{
        $documentacion->save();
        Logs::create([
            'user_id'=>auth()->user()->id,
            'descripcion'=>'Creacion de Documento',
            'tabla'=>'Documentacion',
            'subject_id'=>$documentacion->id,
            'subject_type'=>'App\Models\Documentacion',
            'host'=>request()->ip(),
            'properties'=>json_encode($documentacion->all()),
        ]);
        $mensaje="El Documento fue creado con exito :) !!!!!.";
        }catch(\Exception $e){
            $mensaje="El Documento no fue creado :'( !!!!!.";
            Logs::create([
                'user_id'=>auth()->user()->id,
                'descripcion'=>'Error Creacion de Documento',
                'tabla'=>'Documentacion',
                'subject_id'=>$documentacion->id,
                'subject_type'=>'App\Models\Documentacion',
                'host'=>request()->ip(),
                'properties'=>json_encode($documentacion->all()),
            ]);
        }

        $certificacions=Certificacion::where('rut',$user->rut)->get();
        $especies=Especie::all()->pluck('name','id');
        $variedades=Variedad::all()->pluck('name','id');
        $tipodocumentacions=TipoDocumentacions::where('estado',1)->where('global',0)->with('especie','pais')->get();
        $documentacion=Documentacions::where('user_id',$user->id)->with(['TipoDocumentacion','TipoDocumentacion.especie', 'TipoDocumentacion.pais'])->get();
        $tiposGlobales=TipoDocumentacions::where('estado',1)->where('global',1)->get();
        //dd($documentacion);
        return view('admin.agronomos.editproductor',compact('user','certificacions','especies','variedades','documentacion','tipodocumentacions','tiposGlobales'))->with('info',$mensaje);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Documentacions $documentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $paises=Paises::has('TipoDocumentacion')->get();
        $productores=User::where('id','=',$request->user_id)->first();
        $tiposGlobales=TipoDocumentacions::where('global',1)->where('estado',1)->get();
        //dd($productores,$request->user_id);
        $especies=Especie::has('TipoDocumentacion')->get();
        $tipodocumentacions=TipoDocumentacions::where('estado',1)->where('global',0)->with('especie','pais')->get();
        //$documentacion=TipoDocumentacions::where('estado',1)->with('especie','pais')->has('Documentacions')->where('user_id',$user->id)->get();
        $documento=Documentacions::find($request->id);
        $documentacion=Documentacions::with(['TipoDocumentacion','TipoDocumentacion.especie', 'TipoDocumentacion.pais'])->get();
       // dd($documento,$documentacion);
        return view('documentacions.edit',compact('documento','documentacion','tipodocumentacions','paises','especies','productores','tiposGlobales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentacionRequest  $request
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

       $documentacion=Documentacions::find($request->id);
       $documentacion->tipo_documentacion_id=$request->tipo;
       $documentacion->user_id=$request->user_id;
       $documentacion->nombre=$request->nombre;
       $documentacion->fecha_vigencia=$request->fecha_vigencia;
       $documentacion->descripcion=$request->descripcion;

       if ($request->hasFile('file')) {
        $user=User::find($request->user_id);
        // Guardar el archivo en la carpeta 'uploads' dentro de 'storage/app/public'
        $nombre_archivo=$request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $tipodocto=TipoDocumentacions::find($request->tipo);
        $nombre_archivo=$tipodocto->nombre_guardado.".".$extension;
        $filePath = $request->file('file')->storeAs("documentacion/".str_replace(' ', '-', $user->name)."/", str_replace(' ', '-',$nombre_archivo), 'public');
        $documentacion->file=$filePath;
        }

       // dd($documentacion,$request);
       try{
       $documentacion->save();
       Logs::create([
        'user_id'=>auth()->user()->id,
        'descripcion'=>'Modificación de Documento',
        'tabla'=>'Documentacion',
        'subject_id'=>$documentacion->id,
        'subject_type'=>'App\Models\Documentacion',
        'host'=>request()->ip(),
        'properties'=>json_encode($documentacion->all()),
    ]);
       return redirect()->back()->with('info','El Documento fue actualizado con exito :) !!!!!.');
       }catch(\Exception $e){
        return redirect()->back()->with('info',"El Documento no fue actualizado :'( !!!!!.");
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documentacion  $documentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->seleccionados as $id){
            $documentacion=Documentacions::find($id);

            $documentacion->delete();
        }
        Logs::create([
            'user_id'=>auth()->user()->id,
            'descripcion'=>'Eliminación de Documento',
            'tabla'=>'Documentacion',
            'subject_id'=>$documentacion->id,
            'subject_type'=>'App\Models\Documentacion',
            'host'=>request()->ip(),
            'properties'=>json_encode($documentacion->all()),
        ]);
        return response()->json(['success'=>'El Documento fue eliminado con exito :) !!!!!.']);
        //
    }

}
