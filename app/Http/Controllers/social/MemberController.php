<?php

namespace App\Http\Controllers\social;

use App\Http\Controllers\Controller;
use App\Models\FriendRequest;
use Auth;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Collection\Collection;
use App\Models\Friend;
class MemberController extends Controller
{
    public function showMembers(){
    //    $users=User::all()->pluck('id');
    //    $request_users=User::sentFriendRequests()->pluck('target_user');
    //    $users = $users->(items: $request_users);
    $users = User::get()->except(Auth::user()->id);
    $members = $this->checkUsersInFriends($users, 0);
    $last_id=$members->keys()->last();
        return view('social.member.members',compact('members','last_id'));
    }

    function showMoreMembers(Request $request){
        $users = User::get()->except(Auth::user()->id);
        $last_id = $users->keys()->last();
        $members = $this->checkUsersInFriends($users,$request->last_id_counter);

        return response()->json(['members'=>$members,'last_id'=>$members->keys()->last()]);
    }
    public function sendFriendRequest(Request $request){
        $origin_user=Auth::user()->id;
        $request->merge(['origin_user'=>$origin_user]);
        $newFriendShipRequest=['origin_user'=> $origin_user,'target_user'=> $request->user];
       $request_success = FriendRequest::create($newFriendShipRequest);
       if($request_success){
        return response()->json(['status' => 'sent']);
       }
       return response()->json(['status' => 'field']);
    }
    public function acceptFriendRequest(Request $request){
        $target_user = Auth::user()->id;
        $origin_user = $request->user;
        $request -> merge(['target_user'=>$target_user]);
        $request_success = FriendRequest::where('origin_user',$origin_user)->where('target_user',$target_user)->update(['status'=>1]);
        $newFriendShip=['user_1'=> $origin_user,'user_2'=> $target_user];

        Friend::create($newFriendShip);
        return response()->json(['status' => 'friend']);

    }
    public function checkUsersInFriends($users,$last_id){
        
        $users_slice = $users->slice($last_id,2);
        $last_id = $users_slice->keys()->last();
        $sent_friend_requests = User::sentFriendRequests()->pluck('target_user');
        $recived_friend_requests = User::recivedFriendRequests()->pluck('origin_user');
        $friends_1 = User::friends()->pluck('user_1');
        $friends_2 = User::friends()->pluck('user_2');
       
        $friends = $friends_1->merge($friends_2)->unique();
      
        $friends = $friends->filter(function($value,int $key){
            $user_id = Auth::user()->id;

            return $value != $user_id;
            });
     
        foreach($users_slice as $user){
            $check_user = $sent_friend_requests->contains($user->id);
            if($check_user==true){
                $user['status']='sent_request';
            }
            
        }
        foreach($users_slice as $user){
            $check_user = $recived_friend_requests->contains($user->id);
            if($check_user==true){
                $user['status']='recived_request';
            }
        }
        foreach($users_slice as $user){
            $check_user = $friends->contains($user->id);
            if($check_user==true){
                $user['status']='friend';
            }
        }

        return $users_slice;
    }

    public function sendMessage(){

    }
    public function viewProfile(){

    }
}
