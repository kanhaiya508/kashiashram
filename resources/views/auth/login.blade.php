<x-guest-layout>
    <!-- Login -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link  text-center gap-2">

                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="logo w-100 ">
                </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome to Kashiashram! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>


            <form method="POST" class="mb-3" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email or Username</label>
                    <input value="admin@gmail.com" type="text" class="form-control" id="email" name="email"
                        placeholder="Enter your email " autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>

                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" value="123456" id="password" class="form-control" name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>



                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
            </form>


        </div>
    </div>
    <!-- /Register -->
</x-guest-layout>
