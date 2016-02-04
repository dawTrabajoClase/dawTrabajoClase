<?php
/**
 * Created by PhpStorm.
 * User: 2gdwes07
 * Date: 8/1/16
 * Time: 12:54
 */

namespace blog1\modelo\base;
use blog1\modelo\bd\PaginaBD;
use blog1\modelo\bd\RecursoBD;
use blog1\modelo\bd\UsuarioBD;

require_once __DIR__.'/iModeloBase.php';
require_once __DIR__.'/Usuario.php';


class Pagina implements iModeloBase{

  private $codigo;
  private $titulo;

  private $usuario;
  private $recursos;

  /**
   * Pagina constructor.
   * @param $codigo
   * @param $titulo
   * @param $usuario
   */
  public function __construct($titulo=NULL, $usuario=NULL) {
    $this->setTitulo($titulo);
    $this->setUsuario($usuario);
  }


  /**
   * @return mixed
   */
  public function getCodigo() {
    return $this->codigo;
  }

  /**
   * @param mixed $codigo
   */
  public function setCodigo($codigo) {
    $this->codigo = $codigo;
  }

  /**
   * @return mixed
   */
  public function getTitulo() {
    return $this->titulo;
  }

  /**
   * @param mixed $titulo
   */
  public function setTitulo($titulo) {
    $this->titulo = $titulo;
  }

  /**
   * @return mixed
   */
  public function getUsuario() {
    if(is_null($this->usuario))
    {
      $this->usuario = UsuarioBD::findByRef($this);
    }
    return $this->usuario;
  }

  /**
   * @param mixed $usuario
   */
  public function setUsuario(Usuario $usuario) {
    if(is_null($this->getUsuario()))
    {
      $this->usuario = $usuario;
      $this->save();
      $usuario->addPagina($this);
    }
  }

  /**
   * @return mixed
   */
  public function getRecursos() {
    if(is_null($this->recursos))
    {
      $this->recursos = RecursoBD::findByRef($this);
    }
    return $this->recursos;
  }

  /**
   * @param mixed $recursos
   */
  public function addRecurso(Recurso $recurso) {
    $recs = $this->getRecursos();
    if(!is_null($this->getCodigo()))
    {
      for(reset($recs); current($recs) && current($recs)->getCodigo() != $recurso->getCodigo(); next($recs)){}
      if(!current($recs))
      {
        array_push($this->recursos, $recurso);
      }
    }else
    {
      $recurso->save();
      $this->addRecurso($recurso);
    }
    if(is_null($recurso->getPagina()))
    {
      $recurso->setPagina();
    }
  }



  public function save() {
    if(!PaginaBD::find($this))
      PaginaBD::add($this);
    else
      PaginaBD::update(this);
  }

  public function remove() {
    // TODO: Implement remove() method.
  }
}