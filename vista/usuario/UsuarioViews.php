<?php
/**
 * Created by PhpStorm.
 * User: sepe
 * Date: 4/01/16
 * Time: 20:01
 */

namespace ej27_v3\vista\usuario;
use ej27_v3\controlador\Main;
use ej27_v3\vista\pagina\PaginaViews;
use ej27_v3\modelo\base\Texto;
use ej27_v3\vista\View;
require_once __DIR__ . '/../View.php';
require_once __DIR__ . '/../../controlador/Main.php';
require_once __DIR__.'/../pagina/PaginaViews.php';
require_once __DIR__.'/../../modelo/base/Texto.php';

class UsuarioView extends View
{
    public static function verAcceso()
    {
        require_once __DIR__.'/../plantilla/cabecera.php';
        ?>
        <section>
            <article style="text-align: center">
                <h1>BIENVENIDO AL BLOG</h1>
                    <form id="fLogin" name="fLogin" method="post" action="<?php echo parent::getUrlRaiz(); ?>/controlador/router.php">
                        <fieldset>
                            <legend>Acceso Usuarios</legend>
                            <br/>
                            <label for="usuario">Usuario: </label><input type="text" id="usuario" name="usuario" required><br/>
                            <br/>
                            <label for="password">Password: </label><input type="password" id="password" name="password" required><br/>
                            <br/>
                            <input type="submit" id="entrar" name="entrar" value="Entrar">
                            <input type="hidden" name="ruta" id="ruta" value="accesoUsuarios">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" id="registrarse" name="registrarse" value="Registrarse" onclick="anularRequired()">
                        </fieldset>
                    </form>
                <br/>
            </article>
        </section>
        <?php
        require_once __DIR__.'/../plantilla/pie.php';
    }
    public static function error($cod)
    {
        require_once __DIR__.'/../plantilla/cabecera.php';
        ?>
        <section style="text-align: center">
            <?php
            switch ($cod)
            {
                case 1:
                    echo '<h1>Usuario incorrecto</h1>';
                    break;

                case 2:
                    echo '<h1>Usuario ya registrado</h1>';
                    break;
            }
            self::enlaceTipoForm('Volver al inicio');?>
        </section>
        <?php
        require_once __DIR__.'/../plantilla/pie.php';
    }
    public static function verPaginas()
    {
        if(is_null($u = Main::getFromSesion('usuario')))
        {
            self::error();
        }else
        {
            require_once __DIR__.'/../plantilla/cabecera.php';
            ?>
            <section>
                <article>
                    <h1>Usuario: <?php echo $u->getNombre()?></h1>
                        <fieldset>
                            <legend>Páginas publicadas</legend>
                            <?php
                            $paginas = $u->getPaginas();
                            if(sizeof($u->getPaginas()) < 1)
                            {
                                echo '<br/><p>No hay páginas publicadas</p>';
                            }else
                            {
                                for($x = 1;$x<=sizeof($paginas); $x++)
                                {
                                    PaginaViews::examinarPagina($paginas[$x-1],1);
                                }
                            }
                            ?>
                            <br/><br/>
                        </fieldset>
                    <br/>
                    <?php self::enlaceTipoForm('Nueva página','nuevaPagina');?>
                    <br/>
                    <?php self::enlaceTipoForm('Desconectar');?>
                    <br/>
                </article>
            </section>
            <?php
            require_once __DIR__.'/../plantilla/pie.php';
        }
    }

    public static function verRegistro()
    {
        require_once __DIR__.'/../plantilla/cabecera.php';
        ?>
        <section>
            <article>
                <h1>BIENVENIDO AL BLOG</h1>
                <form id="fRegistro" name="fRegistro" method="post" action="<?php echo self::getUrlRaiz().'/controlador/router.php'; ?>">
                    <fieldset>
                        <legend>Acceso Usuarios</legend>
                        <br/>
                        <label for="nombre">Nombre Completo: </label><input type="text" id="nombre" name="nombre"><br/>
                        <br/>
                        <label for="usuario">Usuario: </label><input type="text" id="usuario" name="usuario"><br/>
                        <br/>
                        <label for="password">Password: </label><input type="password" id="password" name="password"><br/>
                        <br/>
                        <label for="confirm_password">Confirmar password: </label><input type="password" id="confirm_password" name="confirm_password"><br/>
                        <br/>
                        <input type="button" id="aceptar" name="aceptar" value="Aceptar" onclick="validarCampos()">
                        <input type="hidden" name="ruta" value="registroUsuarios"">
                    </fieldset>
                </form>
                <br/>
                <?php self::enlaceTipoForm('Volver'); ?>
                <br/>
            </article>
        </section>
        <?php
        require_once __DIR__.'/../plantilla/pie.php';
    }

}