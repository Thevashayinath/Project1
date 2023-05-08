
    <form method="post" action="{{ route('login') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <h1 class="h3 mb-3 fw-normal">Login</h1>


        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="email" required="required" autofocus>
            <label for="email">Email</label>
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" required="required">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

    </form>

