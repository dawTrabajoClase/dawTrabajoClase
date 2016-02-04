/**
 * Created by sepe on 7/01/16.
 */
function anularRequired()
{
    document.getElementById('usuario').setAttribute('required','false');
    document.getElementById('password').setAttribute('required','false');
    document.getElementById('ruta').value = 'accesoRegistro';
    document.getElementById('fLogin').submit();
}

function validarCampos()
{
    var nombre = document.getElementById("nombre").value;
    var usuario = document.getElementById("usuario").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if(nombre.length == 0 || usuario.length == 0 || password.length == 0 || confirm_password.length == 0)
        alert('Ningún campo puede quedar vacío');
    else
    {
        if(password != confirm_password)
        {
            password = '';
            confirm_password = '';
            alert('Las contraseñas no coinciden');
        }else
        {
            document.getElementById('fRegistro').submit();
        }
    }
}