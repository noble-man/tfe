<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login to admin</title>
		<link href="style/css/login-style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
        <form action="login-action.php" method="post">
            <fieldset>
                <legend><h2><b>Identifiez-vous!</b></h2></legend>
                    <p>
                        <label for="username">Utilisateur: </label>
                        <input type="text" name="username" id="username" value="" />
                    </p>
                    <p>
                        <label for="password">Mot de passe: </label>
                        <input type="password" name="password" id="password" value="" />
                    </p>
                    <p>
                        <label for="remember">
                            <input type="checkbox" name="remember" id="remember" value="1" /> Se souvenir de moi.
                        </label>
                    </p>
            </fieldset>
            <p>
                <input type="submit" value="Submit" /> <input type="reset" value="Reset" />
            </p>

            <p style="color: #CC0000">
                <!--- This project's code can be found on <a href="https://github.com/noble-man/tfe"></a>. --->
                This project's code can be found on <a href="#" onclick="window.open('https://github.com/noble-man/tfe');">github</a>.

            </p>
        </form>
    </body>
</html>
