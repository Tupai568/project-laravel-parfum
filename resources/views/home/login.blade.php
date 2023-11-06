<div class="LoginSigup">
    <div class="container">
        <input type="checkbox" id="signup_toggle" />
        <div class="form">
            <form class="form" action="/login" method="post">
                @csrf
                <div class="form_front">
                    <i class="bx bx-x" id="x-icon"></i>
                    <div class="form_details">Login</div>
                    <input
                        name="username"
                        placeholder="Username"
                        class="input"
                        type="text"
                    />
                    <input
                        name="password"
                        placeholder="Password"
                        class="input"
                        type="password"
                    />
                    <button type="submit" class="btn">Login</button>
                    <span class="switch"
                        >Don't have an account?
                        <label class="signup_tog" for="signup_toggle">
                            Sign Up
                        </label>
                    </span>
                </div>
            </form>
            <form class="form" method="post" action="/register">
                @csrf @csrf

                <div class="form_back">
                    <i class="bx bx-x" id="x-icon"></i>
                    <div class="form_details">SignUp</div>

                    <input
                        name="username"
                        placeholder="username"
                        class="input"
                        type="text"
                        autocomplete="off"
                        value="{{ old('username') }}"
                    />
                    @error('username')
                    <span class="notif">{{ $message }}</span>
                    @enderror
                    <input
                        name="email"
                        placeholder="email"
                        class="input"
                        type="email"
                        autocomplete="off"
                        value="{{ old('email') }}"
                    />
                    @error('email')
                    <span class="notif">{{ $message }}</span>
                    @enderror
                    <input
                        name="password"
                        placeholder="Password"
                        class="input"
                        type="password"
                        autocomplete="off"
                    />
                    @error('password')
                    <span class="notif">{{ $message }}</span>
                    @enderror
                    <input
                        name="confirm_password"
                        placeholder="Confirm Password"
                        class="input"
                        type="password"
                        autocomplete="off"
                    />
                    @error('confirm_password')
                    <span class="notif">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn">Signup</button>
                    <span class="switch"
                        >Already have an account?
                        <label class="signup_tog" for="signup_toggle">
                            Sign In
                        </label>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>