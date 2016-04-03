<section>
    <div class="wrap">
        <div class="form-content">
            <h3>Login</h3>
            <?php
            $this->show_error( 'message-error' );
            $this->show_success( 'message-success' );
            ?>
        <form method="POST" >
            <fieldset>
                <ul>
                    <li>
                        <label for="email">Email</label>
                        <input id="email" type="text" name="_email" />
                    </li>
                    <li>
                        <label for="pwd">Senha</label>
                        <input id="pwd" type="password" name="_password" />
                    </li>
                    <li>
                        <p class="rememberme">
                            <label for="remember">
                                <input id="remember" type="checkbox" name="_remember" />
                                Manter conectado
                            </label>
                        </p>
                        <input class="button btn-login" type="submit" value="Login" name="login_user" />
                    </li>
                </ul>
            </fieldset>
        </form>
    </div>
</section>

