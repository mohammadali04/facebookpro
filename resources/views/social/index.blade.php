<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Dobble Social Network</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('files/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('files/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('files/css/style.css')}}" rel="stylesheet">


</head>

<body>
    @include('social.header')

    @include('social.nav')

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @yield('content')
                </div>
                <!--col-md-8 end-->
                @include('social.friends')

            </div>

        </div>

    </section>
    @include('social.footer')
    <script src="{{asset('files/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('files/js/bootstrap.js')}}"></script>

    <script>
    function like(post_id, item) {
        var tag = $(item);
        var post = post_id;
        var data = {
            'post_id': post,
            '_token':'{{csrf_token()}}',
        };
        var url = "{{Route('add.like')}}";

        $.post(url, data, function(msg) {
            tag.parents('.post').find('.row-child-1').find('.row-child-2').find('.likes-span').text(msg);
        });

    }
    </script>
</body>

</html>