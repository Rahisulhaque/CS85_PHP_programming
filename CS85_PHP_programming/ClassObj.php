Class Pen{
  var $color = "black";
  function setInk($ink)
  {
  	$this->color = $ink;
  }
  function write($whatever)
  {
  	echo $whatever;
  }
}

$mypen = new Pen;

$mypen->write("Hello World");
