<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ForumController extends Controller {


public function handleChat()
{

	// if(!Auth::check())
	// 		{
	// 			return response()->json(['error' => true, 'description' => 'not allowed']);
	// 		}


		$function=Input::get('function');



    $log = array();
    switch($function) {
       case('getStateAndLoad'):

					$comments=App\Message::all();

          $count=count($comments);
           $log['state'] = $count;
					$log['messages']=$comments;

           break;

       case('update'):
					$countofuser=0;
          $state = Input::get('state');
					$comments=App\Message::all();
          $user=App\User::all()->toArray();
          $email=Auth::user()->email;
          $object=Carbon::now();
          $date=Carbon::parse(''.$object);
          $user_to_change_update_at_time=App\User::find($email);

          $user_to_change_update_at_time->updated_at=$date;
					$user_to_change_update_at_time->save();
				//	return response()->json(['error' => true, 'description' => 'message:'.$user_to_change_update_at_time]);

          $names=array();
$time=array();
          for($i=0;$i<sizeof($user);$i++)
          {
						$object=Carbon::now();
             $date=Carbon::parse(''.$object);
//currenttime
              $timeinms=$date->timestamp;


// users last updated time
              $object=$user[$i];
							if($object['email']==$email)
							{
								continue;
							}
              $last_update=$object['updated_at'];
              $last_updated_date=Carbon::parse($last_update);

              $last_updated_time_in_ms=$last_updated_date->timestamp;
						//	$time[$i]=($timeinms-$last_updated_time_in_ms).$object['name'];


              if(($timeinms-$last_updated_time_in_ms)<30)
              {
								$time[$countofuser]=($timeinms-$last_updated_time_in_ms).''.$object['name'];
                $names[$countofuser]=$object['name'];
									$countofuser++;
              }

          }

					$count=count($comments);

          if ($state == $count){
             $log['state'] = $state;
             $log['text'] = false;
          } else {

							$noofRowsToFetch=$count-$state;

						if($noofRowsToFetch)
						{
							$lastRows=App\Message::orderBy('created_at', 'desc')->take($noofRowsToFetch)->get();
							$log['state'] = $state +'this is count' +count($lastRows);
             $log['msg'] = $lastRows;
						}
						else {
							$log['state'] = $state;
							$log['text'] = false;
						}



          }
//          $names=array();

          // for($i=0;$i<sizeof($user);$i++)
          // {
          //   $nameofuser=$user[$i];
          //   $names[$i]=$nameofuser['name'];
          // }
          $log['user']=$names;

					$log['time']=$time;

          break;

       case('send'):
			$message=Input::get("message");
			$email=Auth::user()->email;
      $username=Auth::user()->name;
				if($message=='')
				{
					return response()->json(['error' => true, 'description' => 'message:'.$message]);
								}
		$k=	App\Message::create(array('message' =>$message,'email'=>$email,'username'=>$username));



         break;
    }

    echo json_encode($log);
	}
}
