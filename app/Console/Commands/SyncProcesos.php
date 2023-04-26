<?php

namespace App\Console\Commands;

use App\Models\Proceso;
use App\Models\Sync;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncProcesos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:procesos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Procesos Sincronizados Con Éxito';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   $procesos=Http::post('https://apigarate.azurewebsites.net/api/v1.0/Produccion/ObtenerProduccion');
        $procesos = $procesos->json();

        $ri=Proceso::all();
        $totali=$ri->count();

        foreach ($procesos as $proceso){
            $agricola=Null;//1
            $n_proceso=Null;//2
            $especie=Null;//3
            $variedad=Null;//4
            $kilos_netos=Null;//5
            $categoria=Null;//6
            //7
            $id_empresa=Null;//8
            
            $m=1;
            foreach ($proceso as $item){
                
                if($m==1){
                    $agricola=$item;
                }
                if($m==2){
                    $n_proceso=$item;
                }
                if($m==3){
                    $especie=$item;
                }
                if($m==4){
                    $variedad=$item;
                }
                if($m==5){
                    $fecha=$item;
                }
                if($m==6){
                    $kilos_netos=$item;
                }
                if($m==7){
                    $categoria=$item;
                }
                if($m==8){
                    $id_empresa=$item;
                }
                if($m==9){
                    $estado=$item;
                }
               if($m==9){

                        $cont=Proceso::where('n_proceso',$n_proceso)->first();
                        if($cont){
                            if($categoria=='Sin Procesar'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'kilos_netos' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Exportacion'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'exp' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Mercado Interno'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'comercial' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }elseif($categoria=='Desecho'){
                                $cont->forceFill([
                                    'agricola' => $agricola,//1
                                    'n_proceso' => $n_proceso,//2
                                    'especie' => $especie,//3
                                    'variedad' => $variedad,//4
                                    'fecha' => $fecha,//5
                                    'desecho' => $kilos_netos,//6
                                    'id_empresa' => $id_empresa,//8
                                ])->save();
                            }
                            
                        }else{
                            
                            if($estado=='Finalizado'){
                                if($categoria=='Sin Procesar'){
                                    $rec=Proceso::create([
                                        'agricola' => $agricola,//1
                                        'n_proceso' => $n_proceso,//2
                                        'especie' => $especie,//3
                                        'variedad' => $variedad,//4
                                        'fecha' => $fecha,//5
                                        'kilos_netos' => $kilos_netos,//6
                                        'exp' => 0,//6
                                        'comercial' => 0,//6
                                        'desecho' => 0,//6
                                        'merma' => 0,//6
                                        'id_empresa' => $id_empresa,//8
                                    ]);
                                }elseif($categoria=='Exportacion'){
                                    $rec=Proceso::create([
                                        'agricola' => $agricola,//1
                                        'n_proceso' => $n_proceso,//2
                                        'especie' => $especie,//3
                                        'variedad' => $variedad,//4
                                        'fecha' => $fecha,//5
                                        'kilos_netos' => 0,//6
                                        'exp' => $kilos_netos,//6
                                        'comercial' => 0,//6
                                        'desecho' => 0,//6
                                        'merma' => 0,//6
                                        'id_empresa' => $id_empresa,//8
                                    ]);
                                }elseif($categoria=='Mercado Interno'){
                                    $rec=Proceso::create([
                                        'agricola' => $agricola,//1
                                        'n_proceso' => $n_proceso,//2
                                        'especie' => $especie,//3
                                        'variedad' => $variedad,//4
                                        'fecha' => $fecha,//5
                                        'kilos_netos' => 0,//6
                                        'exp' => 0,
                                        'comercial' => $kilos_netos,//6
                                        'desecho' => 0,//6
                                        'merma' => 0,//6
                                        'id_empresa' => $id_empresa,//8
                                    ]);
                                }elseif($categoria=='Desecho'){
                                        
                                        $rec=Proceso::create([
                                            'agricola' => $agricola,//1
                                            'n_proceso' => $n_proceso,//2
                                            'especie' => $especie,//3
                                            'variedad' => $variedad,//4
                                            'fecha' => $fecha,//5
                                            'kilos_netos' => 0,//6
                                            'exp' => 0,
                                            'comercial' => 0,//6
                                            'desecho' => $kilos_netos,//6
                                            'merma' => 0,//6
                                            'id_empresa' => $id_empresa,//8
                                        ]);
                                        
                                }	
                            }
                        }
                    
                }
                $m+=1;
                
            } 
        }

        
        $rf=Proceso::all();
        $total=$rf->count()-$ri->count();
        Sync::create([
            'tipo'=>'PROGRAMADA',
            'entidad'=>'PROCESOS',
            'fecha'=>Carbon::now(),
            'cantidad'=>$total
        ]);

        return Command::SUCCESS;
    }
}
