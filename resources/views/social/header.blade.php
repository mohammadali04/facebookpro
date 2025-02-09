<header>
        <div class="container">
            <img src="files/img/logo.png" class="logo">
            @if(!Auth::user())
            <form action="{{Route('user.authenticate')}}" class="form-inline">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                </div>

                <button type="submit" class="btn btn-default">Sign in</button><br>

                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </form>
@endif
        </div>
    </header>