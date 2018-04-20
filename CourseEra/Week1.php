<?php
//date_default_timezone_set('Bangladesh/Dhaka');

echo " Date now :".date('d-m-Y')."<br>";


$now=new DateTime();
$nextweek=new DateTime('today+1 week');
echo "Now ".$now->format('d-m-y')."<br>";
echo 'Next week '.$nextweek->format('d-m-y');
echo '<hr>';

class Person{
    
    public $fullname=false;
    public $department=false;
    public $roll=false;
    public $skill=false;
    function getName()
    {
        
        if($this->fullname!=false and $this->department!=false) return $this->fullname." and ".$this->department;
        if($this->roll!=false and $this->skill!=false) {return $this->roll." and ".$this->skill;}
        return false;
    }
    }
class PLayer{
    public $name="Tamim Iqbal";
    public $score="120";
}

    
    
   $name=new Person();
$name->fullname="Hasnat";
$name->department="CSE";
   $about=new Person();
$about->roll=1503065;
$about->skill="Cricket";
print $name->getName()."<br>";
 print $about->getName()."<br>";  
///from class palyer.
$Player=new PLayer();
print_r($Player);
    





?>