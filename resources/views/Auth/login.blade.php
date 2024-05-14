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
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" class="form-control"
                                    placeholder="Masukkan Password Baru ..." id="password"
                                    name="password">
                                <button type="button" class="btn btn-outline-primary toggle-password">
                                    <i class="fa fa-eye"></i> Show
                                </button>
                            </div>
                        </div>
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
        <script>
              $(document).on('click', '.toggle-password', function() {
                $(this).toggleClass('show-password');
                var input = $(this).siblings('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    $(this).html('<i class="fa fa-eye-slash"></i> Hide');
                } else {
                    input.attr('type', 'password');
                    $(this).html('<i class="fa fa-eye"></i> Show');
                }
            });
        </script>
        <!-- Page Specific JS File -->
    @endslot
    
</x-auth>
