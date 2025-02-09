@extends('social.index')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8" id="member-content">
                <div class="members" id="members">
                    <h1 class="page-header">Members</h1>
                    @php
                    @endphp
                    @foreach ($members as $key=>$member)
                    <div class="row member-row">
                        <div class="col-md-3">
                            <img src="img/user.png" class="img-thumbnail">
                            <div class="text-center">{{$member['name'].' '.$member['family']}}</div>
                        </div>
                        <div class="col-md-3">
                            @php
                            $status='Add Friend';
                            $background = 'btn-success';
                            switch($member->status){
                            case 'sent_request';
                            $status = 'sent request';
                            $background='btn-primary';
                            break;
                            case 'recived_request';
                            $status='accept request';
                            $background = 'btn-info';
                            break;
                            case 'friend';
                            $status ='your friend';
                            $background ='btn-light';
                            }
                            @endphp
                            <p>
                                @if ($status!='your friend')
                                <a class="btn {{$background}} btn-block btn.{{$key}}"
                                    onclick="sendFriendRequest($key,{{$member->id}})"><i class="fa fa-users"></i>
                                    {{{$status}}}</a>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-3">
                            <p><a href="#" class="btn btn-default btn-block"><i class="fa fa-envelope"></i> Send
                                    Message</a></p>
                        </div>
                        <div class="col-md-3">
                            <p><a href="#" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> View Profile</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
                <a id="show-more-button" class="btn btn-primary d-flex" href="#" onclick="showMoreMembers({{$last_id}})">View All
                    Friends</a>
            </div>
            <!--col-md-8 end-->
            <div class="col-md-4">
                <div class="panel panel-default friends">
                    <div class="panel-heading">
                        <h3 class="panel-title">My Friends</h3>
                    </div>
                    <div class="panel-body">
                        <ul>
                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>
                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>

                            <li><a class="thumbnail" href="profile.html"><img src="img/user.png"></a></li>



                        </ul>
                        <div class="clearfix"></div>
                        <a class="btn btn-primary" href="#">View All Friends</a>
                    </div>
                </div><!-- friends end-->

                <div class="panel panel-default groups">
                    <div class="panel-heading">
                        <h3 class="panel-title">Latest Groups</h3>
                    </div>
                    <div class="panel-body">
                        <div class="group-item">
                            <img src="img/group.png">
                            <h4><a href="#">Sample Group One</a></h4>
                            <p>This is a Dobble Social network sample group</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="group-item">
                            <img src="img/group.png">
                            <h4><a href="#">Sample Group Two</a></h4>
                            <p>This is a Dobble Social network sample group</p>
                        </div>
                        <div class="clearfix"></div>
                        <div class="group-item">
                            <img src="img/group.png">
                            <h4><a href="#">Sample Group Three</a></h4>
                            <p>This is a Dobble Social network sample group</p>
                        </div>

                        <div class="clearfix"></div>
                        <a class="btn btn-primary" href="#">View All Friends</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>


    function handleRequest(item,user_id,status){
        var url = '';
        switch(status){
            case 0:
                url = "{{Route('send.friend.request')}}";
                break;
                case 2:
                    url="{{Route('accept.friend.request')}}";
                    break;
        }
        var user = user_id;
       var data = {
            'user' :user ,
            '_token' : '{{csrf_token()}}'
        };
        $.post(url,data,function(msg){
            switch(msg['status']){
            case 'friend':
                $('#members .btn'+item).text('your friend');
                $('#members .btn'+item).addClass('btn-light');
                break;
                case 'sent':
                    $('#members .btn'+item).addClass('btn-primay');
                    $('#members .btn'+item).text('request sent');
                    break;
        }
        });
    }

    function showMoreMembers(last_id) {
        const url = "{{Route('show.more.member')}}";
        var last_id = last_id;
        var last_id_counter = last_id+=1;
        var data = {
            'last_id_counter': last_id_counter,
            '_token': '{{csrf_token()}}'
        };
        $.post(url, data, function(msg) {
            var msg_last_id = msg['Last_id'];
            var msg_members = msg['members'];
            console.log(msg['last_id']);
            for(const [key,member] of Object.entries(msg_members)){
            var status = 0;
                status_title='Add Friend';
                var background = 'btn-success';
                switch (member['status']) {
                    case 'sent_request':
                        status = 1;
                        status_title='sent_request';
                        background='btn-primary'
                        break;
                    case 'recived_request':
                        status =2;
                        status_title='accept request';
                        background = 'btn-info';
                        break;
                        case 'friend':
                            status_title = 'your friend';
                            background = 'btn-light';
                        break;
                };
                var status_firend = '<a class="btn '+background+' btn-block btn'+key+'" id="friend-button" onclick="handleRequest('+key+','+member['id']+','+status+')"><i class="fa fa-users"></i>'+status_title+'</a>';
                var member_div = $('#members');
                var element ='<div class="row member-row"><div class="col-md-3"><img src="img/user.png" class="img-thumbnail"><div class="text-center">'+member['name']+' '+member['family']+'</div></div><div class="col-md-3"><p>'+status_firend+'</p></div><div class="col-md-3"><p><a href="#" class="btn btn-default btn-block"><i class="fa fa-envelope"></i> SendMessage</a></p></div><div class="col-md-3"><p><a href="#" class="btn btn-primary btn-block"><i class="fa fa-edit"></i> View Profile</a></p></div></div>';
                member_div.append(element);          }
            // msg.forEach((member,key) => {
               
            // });
            $('#show-more-button').remove();
            var show_more_button = '<a id="show-more-button" class="btn btn-primary d-flex" href="#" onclick="showMoreMembers('+msg['last_id']+')">View All Friends</a>';
            $('#member-content').append(show_more_button);
        });
    }
    </script>

</section>

@endsection