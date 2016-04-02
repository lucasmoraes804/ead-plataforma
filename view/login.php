<?php
 echo $this->error;
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
                    <input id="remember" type="checkbox" name="_remember" />
                    <label for="remember">Manter conectado</label>
                </p>
                <input class="button btn-login" type="submit" value="Login" name="login_user" />
            </li>
        </ul>
    </fieldset>
</form>

