<x-auth>

    @slot('title')
        Login
    @endslot


    @slot('style')
        <!-- CSS Libraries -->
        <link rel="stylesheet"
            href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">
    @endslot
    
    @slot('main')
        <div class="card card-primary">
            <div class="card-header">
                <h4>Login</h4>
            </div>
    
            <div class="card-body">
                <form method="POST"
                    action="/login">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email"
                            type="email"
                            class="form-control"
                            name="email"
                            tabindex="1"
                            placeholder="Masukkan email anda ..."
                            required
                            autofocus>
                    </div>
    
                    <div class="form-group">
                        <div class="d-block">
                            <label for="password"
                                class="control-label">Password</label>
                        </div>
                        <input id="password"
                            type="password"
                            class="form-control"
                            name="password"
                            placeholder="Masukkan password anda ..."
                            tabindex="2"
                            required
                            autofocus>
                    </div>
    
    
                    <div class="form-group">
                        <button type="submit"
                            class="btn btn-primary btn-lg btn-block"
                            tabindex="4">
                            Login
                        </button>
                    </div>
                </form>
    
            </div>
        </div>
    @endslot
    
    @slot('script')
        <!-- JS Libraies -->
    
        <!-- Page Specific JS File -->
    @endslot
    
</x-auth>
