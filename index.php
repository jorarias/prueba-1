<?php
//-----------------------------Creacion de la clase Persona
class Persona {
  private $id;
  private $cedula;
  private $nombre;
  private $apellido;
  private $sexo;
  private $fechaNacimiento;
//-----------------------------Metodo constructor de la clase Persona
  public function __construct($idPersona, $numCedula, $fname, $lname, $sex, $date) 
  {
    $this -> id = $idPersona;
    $this -> cedula = $numCedula;
    $this -> nombre = $fname;
    $this -> apellido = $lname;
    $this -> sexo = $sex;
    $this -> fechaNacimiento = $date;
  }
//-----------------------------Metodos Get y Set de la clase Persona
  public function getId() {
      return $this -> id;
  }
  public function setId($valor){
      $this -> id = $valor;
  }
  public function getCedula() {
      return $this -> cedula;
  }
  public function setCedula($valor){
      $this -> cedula = $valor;
  }
  public function getNombre() {
      return $this -> nombre;
  }
  public function setNombre($valor){
      $this -> nombre = $valor;
  }
  public function getApellido() {
      return $this -> apellido;
  }
  public function setApellido($valor){
      $this -> apellido = $valor;
  }
  public function getSexo() {
      return $this -> sexo;
  }
  public function setSexo($valor){
      $this -> sexo = $valor;
  }
  public function getFechaNacimiento() {
      return $this -> fechaNacimiento;
  }
  public function setFechaNacimiento($valor){
      $this -> fechaNacimiento = $valor;
  }
//-----------------------------Metodo toString de la clase Persona
  public function imprimir()
  {
    echo '  Los datos de la persona son: '.$this->id.', '.$this->cedula.', '.$this->nombre.', '.$this->apellido.', '.
    $this->sexo.', '.$this->fechaNacimiento.'<br />';
  }
}
//-----------------------------Declaracion de los objetos Persona
$persona1 = new Persona(1, '2-723-327', 'Sebastian', 'Rodriguez', 'M', '1994/03/10');
$persona2 = new Persona(2, '2-707-229', 'Hector', 'Rodriguez', 'M', '1992/12/06');
$persona3 = new Persona(3, '2-317-910', 'Julia', 'Bolannos', 'F', '1956/11/08');
$persona4 = new Persona(4, '2-263-769', 'Jose Angel', 'Rodriguez', 'M', '1949/04/07');
$persona5 = new Persona(5, '11-577-821', 'Irina', 'Cordoba', 'F', '1994/08/02');
//-----------------------------impresion de los datos de las personas
echo 'Datos de las persona [id, cedula, nombre, apellido, sexo, fecha de nacimiento]<br /><hr />';
echo 'Persona #1: <br />';
$persona1 -> imprimir();
echo 'Persona #2: <br />';
$persona2 -> imprimir();
echo 'Persona #3: <br />';
$persona3 -> imprimir();
echo 'Persona #4: <br />';
$persona4 -> imprimir();
echo 'Persona #5: <br />';
$persona5 -> imprimir();
echo '<hr />';
//-----------------------------incluir archivo de conexion a la base de datos
include('connection.php');
//-----------------------------Guardar las personas en la base de datos
$personas = array();
  $personas[] = $persona1;
  $personas[] = $persona2;
  $personas[] = $persona3;
  $personas[] = $persona4;
  $personas[] = $persona5;
echo 'Se van a guardar los datos en la base de datos <br /><hr />';;
foreach($personas as $p)
{
    $iden= $p->getId();
    $ced= $p->getCedula();
    $nom= $p->getNombre();
    $ape= $p->getApellido();
    $gender= $p->getSexo();
    $fecha= $p->getFechaNacimiento();
    $sentencia = "insert into persona (idpersona, cedula, nombre, apellido, sexo, fechaNacimiento) values 
					    ('$iden','$ced','$nom','$ape','$gender','$fecha')";
    mysql_query($sentencia, $link);
    echo 'Se guardaron los datos de la persona con el id#: '.$iden.' <br />';
}
$personas = array();
//-----------------------------Recuperar los datos de la base de datos
echo '<hr />';
echo 'Se van a recuperar los datos de las personas de la base de datos<br /><hr />';
$sentencia = "select * from Persona order by idpersona desc";
$consulta = mysql_query($sentencia, $link);
while($row = mysql_fetch_array($consulta))
{
    $iden= $row['idpersona'];
    $ced= $row['cedula'];
    $nom= $row['nombre'];
    $ape= $row['apellido'];
    $gender= $row['sexo'];
    $fecha= $row['fechaNacimiento'];
    $per = new Persona($iden, $ced, $nom, $ape, $gender, $fecha);
    $personas[] = $per;
    echo 'Se recuperaron los datos de la persona con el id#: '.$iden.' <br />';
}
echo '<hr />';
echo 'Se va a mostrar los datos recuperados de la base de datos <br /><hr />';;
foreach($personas as $p)
{
    echo 'Persona #'.$p->getId().': <br />';
    echo $p -> imprimir();
}
echo '<hr />';
mysql_close($link);
?>
