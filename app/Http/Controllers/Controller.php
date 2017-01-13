<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\LogSystem as LOG;
use Carbon\Carbon AS TM;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
   
    
    // public function runSqlFile($){
    //     $sql =   file_get_contents("sql/");
    //     $lines = explode("\n", $sql); 
    //     $create_table = $status = $output = ""; 
    //     $linecount = count($lines); 
    //     $create=$next=0;
    //     for($i = 0; $i < $linecount; $i++) 
    //      { 
    //         if(starts_with($lines[$i], "CREATE") )
    //         {
    //             $create_table .= $lines[$i];
    //             $status .=1;
    //             $create=$i;
    //         }
    //         if(starts_with($lines[$i],'--'))
    //          {
    //             $create =0;
    //          }
    //         if($create>0 && $create<$i)
    //         {
    //               $create_table .= $lines[$i];
    //         }
    //     if(starts_with($lines[$i], "INSERT") )
    //             {
    //                 $output .= $lines[$i];
    //                 $next = $i;
    //                 $status .=2;
    //             }
    //              if($next>0 && $i>$next)
    //             {
    //                 if(str_contains($lines[$i], ['--','ALTER','ADD','/*','MODIFY']))
    //                      { $next=0;}
    //                  else{
    //                          $output .= $lines[$i];
    //                     }
    //             } 
    //      }            
    //         try{
    //         DB::select($create_table);
    //         }catch(\Exception $e)
    //         {
    //             if($e->getCode() =="42S01")
    //             {
    //             }
    //         }
    //         if($status !='12')
    //         {
    //         return ['status'=>'error','message'=>"Not exist create & Inset"];
    //         } 
    //         else{   
    //                 try{
    //                     DB::select($output);
    //                     return ['status'=>'sucess','message'=>"Sql file Import Successfully"];

    //                 }catch(\Exception $e){ 
    //                     if($e->getCode()==23000)
    //                         {                                             
    //                         return ['status'=>'error','message'=>"Duplicate entry"];
    //                         }  
    //                 }
    //             }       
    // }
public function putInLog($ip, $user_id, $email, $name, $query , $value, $time)
{
	  				$Lg             =   new LOG;
                    $Lg->user_id    =   $user_id;
                    $Lg->type       =   "model";            
                    $Lg->text       =   json_encode(['query'=>$query ,'email'=>$email ,'name'=>$name,'value'=>$value ,'time'=> $time]);
                    $Lg->ip_address =   $ip;
                    $Lg->save(); 
}


    public function __destruct()
    {	
    	$user = Auth::user();
 		$uid = $user->id; 
 		$email =$user->email;
 		$name =$user->name;


        foreach (DB::getQueryLog() as $key => $value){ 
			if(str_contains($value['query'], 'log_systems') ==true || str_contains($value['query'], 'count(*)')==true){

   				 }else{
                $log    = LOG::orderBy('id','desc')->where('user_id',$uid)->first();
                $logAr  = json_decode($log->text,true);
                $insertTime = $log->created_at;
                $currentTime = TM::now();
                $addSecond = $insertTime->addSeconds(10);
                if(array_key_exists('query', $logAr))
                {
                  if($addSecond > $currentTime  && $logAr['query'] == $value['query'])
                  {
                  // dump('not insert log forthis');
                  }else{

                $this->putInLog($this->ipAdress, $uid, $email, $name, $value['query'], $value['bindings'], $value['time'] );
                  
                  }
                }else{
                    $this->putInLog($this->ipAdress, $uid, $email,$name, $value['query'], $value['bindings'], $value['time'] );
                }
          }

        }
    }
   } 



  //   	$user = Auth::user(); 
  //       $uid =  $user->id; 
  //       $cTime = TM::now();
		// $cTime->subSeconds(60); 

		// $logs = LOG::orderBy('id','desc')->where('created_at','>',$cTime)->where('user_id',$uid)->limit(10)->get();
		// if(count($logs)>0)
		// 	{
		// 	foreach ($logs as $log) {
		// 		foreach (DB::getQueryLog() as $key => $value){ 
		// 			dump('all query'.$value['query']);
		// 			// if(str_contains($value['query'], 'log_systems') ==true || str_contains($value['query'], 'count(*)')==true)
		// 			// {//NOT PUT LOG SYSTEM QUERY && COUNT
		// 			// }	
		// 			// else

		// 			// {

		// 				$logAr  = json_decode($log->text,true);

		// 						if(array_key_exists('query', $logAr))
		// 						{

									
		// 							if($logAr['query'] != $value['query'])
		// 							{
		// 								dump('putt new');		
		// 								$Lg             =   new LOG;
		// 								$Lg->user_id    =   $uid;
		// 								$Lg->type       =   "model";            
		// 								$Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
		// 								$Lg->ip_address =   $this->ipAdress;
		// 								$Lg->save(); 

		// 							}
		// 						}
		// 						else{
		// 								dump('Query not here');
		// 							$Lg             =   new LOG;
		// 							$Lg->user_id    =   $uid;
		// 							$Lg->type       =   "model";            
		// 							$Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
		// 							$Lg->ip_address =   $this->ipAdress;
		// 							$Lg->save(); 
		// 						}
		// 					}
		// 				}else{

		// 				dump("new time put in else");
		// 					$Lg             =   new LOG;
		// 					$Lg->user_id    =   $uid;
		// 					$Lg->type       =   "model";            
		// 					$Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
		// 					$Lg->ip_address =   $this->ipAdress;
		// 					$Lg->save(); 
		// 				}



		// 			//}


		// 		}
       // }
    

          // if($value['query'] =="insert into `log_systems` (`user_id`, `type`, `text`, `ip_address`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?)" || $value['query'] =="select * from `log_systems` where `user_id` = ? order by `id` desc limit 1" || $value['query']=="select * from `users` where `users`.`id` = ? limit 1" ||  str_contains($value['query'], 'count(*)')==true)
          // {  //Not put in log
          // }else{
          //       $log    = LOG::orderBy('id','desc')->where('user_id',$uid)->first();
          //       $logAr  = json_decode($log->text,true);
          //       $insertTime = $log->created_at;
          //       $currentTime = TM::now();
          //       $addSecond = $insertTime->addSeconds(10);
          //       if(array_key_exists('query', $logAr))
          //       {
          //         if($addSecond > $currentTime  && $logAr['query'] == $value['query'])
          //         {
          //         // dump('not insert log forthis');
          //         }else{
          //           $Lg             =   new LOG;
          //           $Lg->user_id    =   $uid;
          //           $Lg->type       =   "model";            
          //           $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
          //           $Lg->ip_address =   $this->ipAdress;
          //           $Lg->save(); 
          //         }
          //       }else{
          //           $Lg             =   new LOG;
          //           $Lg->user_id    =   $uid;
          //           $Lg->type       =   "model";            
          //           $Lg->text       =   json_encode(['query'=>$value['query'] , 'value'=>$value['bindings'] ,'time'=> $value['time'],'email'=>$user->email]);
          //           $Lg->ip_address =   $this->ipAdress;
          //           $Lg->save(); 
          //       }
          // }
        //}   

  					// $Lg             =   new LOG;
       //              $Lg->user_id    =   Auth::user()->id;
       //              $Lg->type       =   "model";            
       //              $Lg->text       =   json_encode(['query'=>"query" , 'value'=>'bind' ,'time'=> '13']);
       //              $Lg->ip_address =   $this->ipAdress;
       //              $Lg->save(); 
                   
    //}


		
//}
