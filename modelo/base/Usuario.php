<?php
/**
 * Created by PhpStorm.
 * User: 2gdwes07
 * Date: 8/1/16
 * Time: 12:54
 */

namespace blog1\modelo\base;
use blog1\modelo\bd\PaginaBD;
use blog1\modelo\bd\UsuarioBD;

require_once __DIR__.'/iModeloBase.php';
require_once __DIR__.'/Pagina.php';
require_once __DIR__.'/../bd/PaginaBD.php';


class Usuario implements iModeloBase{

  private $login;
  private $nombre;
  private $password;

  private $paginas;

  /**
   * Usuario constructor.
   * @param $nombre
   * @param $usuario
   * @param $password
   */
  public function __construct($login=NULL,$nombre=NULL) {
    if(!empty($login))$this->setLogin($login);
    if(!empty($nombre))$this->setNombre($nombre);
    if(!empty($password))$this->setPassword($password);
  }

  /**
   * @return mixed
   */
  public function getNombre() {
    return $this->nombre;
  }

  /**
   * @param mixed $nombre
   */
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  /**
   * @return mixed
   */
  public function getLogin() {
    return $this->login;
  }

  /**
   * @param mixed $usuario
   */
  public function setLogin($login) {
    $this->login = $login;
  }

  /**
   * @return mixed
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * @param mixed $password
   */
  public function setPassword($password) {
    $this->password = $password;
  }

  /**
   * @return mixed
   */
  public function getPaginas() {
    if(is_null($this->paginas))
    {
      $this->paginas = PaginaBD::findByRef($this);
    }
    return $this->paginas;
  }

  public function setPaginas($pags){
    if(is_null($this->getPaginas()))
    {
      $this->paginas = $pags;
    }
  }
  /**
   * @param mixed $paginas
   */
  public function addPagina(Pagina $pag) {
    if(!is_null($pag->getCodigo()))
    {
      $pags = $this->getPaginas();
      for(reset($pags); current($pags) && current($pags)->getCodigo() != $pag->getCodigo(); next($pags)){}
      if(!current($pags))
      {
        array_push($this->paginas,$pag);
      }
    }else
    {
      $pag->save();
      $this->addPagina($pag);
    }
    if(is_null($pag->getUsuario()))
    {
      $pag->setUsuario($this);
    }
  }

  public function save() {
    if(!UsuarioBD::find($this))
      UsuarioBD::add($this);
    else
      UsuarioBD::update(this);
  }

  public function remove() {
    // TODO: Implement remove() method.
  }
}