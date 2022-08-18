    <!-- TODO: fix later find a way to place the loginBox in the center of the screen -->
    <div class="login-wrapper">

        <div class="loginBox">
            <span class="fs-4 titleText">Log ind</span>

            <!-- Starts the form for login -->
            <form class="m-0 pb-4" method="post" action="{{ route('authenticate') }}">
                <!-- Adds the label, depending on the language, and a text input for the user -->
                <div class="form-group">
                    <!-- Label for user, depending on the language -->
                    <label for="user">Email</label>
                    <!-- The different information for user input -->
                    <label for="email"></label><input
                        type="text"
                        name="email"
                        id="email"
                        class="form-control"
                        style="width: 50%; margin-left:25%"
                        value="{{old('email')}}"
                    >
                </div>
                <div class="form-group">
                    <!-- Label for password, depending on the language -->
                    <label for="psw">Adgangskode</label>
                    <!-- The different information for password input -->
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        style="width: 50%; margin-left: 25%"
                        value="{{old('password')}}"
                    >
                </div>
                <!-- Security provided by Laravel -->
            {{ csrf_field() }}
            <!-- Submit button for login form, the name depending on the language -->
                <button type="submit" class="btn btn-primary mt-3">Log ind</button>
            </form>
        </div>

    </div>

<style>
    label {
        color: white;
        padding: 1.5em 0 1em 0;
    }

    .titleText {
        color: white;
        line-height: 2.5em;
    }

    .loginBox {
        align-items: center;
        text-align: center;
        background-color: #606060;
        width: 50%;
        display: block;
        margin: 0 auto;
    }

    .login-wrapper {
        width: 100%;
    }

    @media only screen and (max-width: 700px) {
        .loginBox {
            width: 100%;
        }
    }
</style>