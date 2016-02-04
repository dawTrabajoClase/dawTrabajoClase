<?php
/**
 * Created by PhpStorm.
 * User: sepe
 * Date: 6/01/16
 * Time: 13:24
 */

namespace ej27_v3\vista\recurso;
use ej27_v3\vista\pagina\PaginaViews;
use ej27_v3\vista\View;
use ej27_v3\controlador\Main;
require_once __DIR__.'/../pagina/PaginaViews.php';
require_once __DIR__.'/../View.php';
require_once __DIR__.'/../../controlador/Main.php';

class RecursoViews extends View
{
    public static function nuevoRecurso()
    {
        require_once __DIR__ . '/../plantilla/cabecera.php';
        $u = Main::getFromSesion('usuario');
        ?>
        <section>
            <article>
                <h1>Usuario: <?php echo $u->getNombre() ?></h1>
                <fieldset>
                    <legend>Datos de la página</legend>
                    <?php
                    PaginaViews::examinarPagina(Main::getFromSesion('pagina'), 2);
                    echo '<br/>';
                    self::enlaceTipoForm('Insertar texto', 'nuevoTexto');
                    echo ' || ';
                    self::enlaceTipoForm('Insertar imagen', 'nuevaImagen');
                    ?>
                    <br/><br/>
                </fieldset>
                <br/>
                <?php self::enlaceTipoForm('Volver al inicio', 'accesoUsuarios'); ?>
                <br/>
            </article>
        </section>
        <?php
        require_once __DIR__ . '/../plantilla/pie.php';
    }

    public static function nuevoTexto()
    {
        require_once __DIR__ . '/../plantilla/cabecera.php';
        $u = Main::getFromSesion('usuario');
        ?>
        <section>
            <article>
                <h1>Usuario: <?php echo $u->getNombre() ?></h1>
                <fieldset>
                    <legend>Datos de la página</legend>
                    <?php
                    PaginaViews::examinarPagina(Main::getFromSesion('pagina'));
                    echo '<br/>';
                    ?>
                    <form name="fContenidoTexto" method="post" action="<?php echo parent::getUrlRaiz(); ?>/controlador/router.php">
                        <textarea name="contenido" placeholder="Contenido del nuevo texto..." required cols="50" rows="6"></textarea>
                        <br/>
                        <input type="submit" name="Guardar" value="Guardar">
                        <input type="hidden" name="ruta" value="guardarTexto">
                    </form>
                    <br/><br/>
                </fieldset>
                <br/>
                <?php self::enlaceTipoForm('Volver al inicio', 'accesoUsuarios'); ?>
                <br/>
            </article>
        </section>
        <?php
        require_once __DIR__ . '/../plantilla/pie.php';
    }

    public static function nuevaImagen()
    {
        require_once __DIR__ . '/../plantilla/cabecera.php';
        $u = Main::getFromSesion('usuario');
        ?>
        <section>
            <article>
                <h1>Usuario: <?php echo $u->getNombre() ?></h1>
                <fieldset>
                    <legend>Datos de la página</legend>
                    <?php
                    PaginaViews::examinarPagina(Main::getFromSesion('pagina'));
                    echo '<br/>';
                    ?>
                    <form name="fImagen" method="post" action="<?php echo parent::getUrlRaiz(); ?>/controlador/router.php" enctype="multipart/form-data">
                        <input type="file" name="imagen" accept="image/gif, image/jpg, image/png, image/jpeg, image/tiff" required>
                        <br/><br/>
                        <input type="submit" name="Guardar" value="Guardar">
                        <input type="hidden" name="ruta" value="guardarImagen">
                    </form>
                    <br/><br/>
                </fieldset>
                <br/>
                <?php self::enlaceTipoForm('Volver al inicio', 'accesoUsuarios'); ?>
                <br/>
            </article>
        </section>
        <?php
        require_once __DIR__ . '/../plantilla/pie.php';
    }
}