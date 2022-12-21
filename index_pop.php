<?php
	
	$array1 = array(
	  'consumption'=>array(1200,1300,800,900,1000,800,1200,900,1000,1000,300,1600),
	  'baseprice'=>array(0,0,0,0,0,0,0,0,0,0,0,0),
	  'effecprice'=>array(0,0,0,0,0,0,0,0,0,0,0,0));
	  
// 	array_splice($array1['consumption'],0,1,1000);

    $calendar = array();
    
    array_push($calendar, "Yearly");
    array_push($calendar, "q1");
    array_push($calendar, "q1");
    // print_r($calendar);
    
    $basprice = array();
    
    array_push($basprice,30);
    array_push($basprice,40);
    array_push($basprice,50);

    $effective = array();
    
    array_push($effective,40);
    array_push($effective,50);
    array_push($effective,60);
    
    $perc = array();
    
    array_push($perc,20);
    array_push($perc,30);
    array_push($perc,25);
    // array_push($perc,20);
    
    // print_r($basprice);
    // print_r($perc);
    // print_r($effective);
    // print_r($consPercent);
    
    $checkcount = count($calendar);
    $checkbase = count($basprice);
    for($i=0; $i<$checkcount; $i++) {
      if($calendar[$i] == "Yearly") {
        for($j=0;$j<count($array1['consumption']);$j++ ) {
          if($array1['baseprice'][$j] == 0) {
            $consPercent = $array1['consumption'][$j]*($perc[$i]/100);
            $res1 = ($consPercent * $basprice[$i])/$consPercent;
            $res2 = ($consPercent * $effective[$i])/$consPercent;
            array_splice($array1['baseprice'],$j,1,$res1);
            array_splice($array1['effecprice'],$j,1,$res2);
          }
        }
      } else if($calendar[$i] == "q1") {
        $constConsumption = 0;
        $ress1=0;
        $ress2=0;
        for($j=0; $j<3; $j++) {
          if($array1['baseprice'][$j] == 0) {
            $consPercent = $array1['consumption'][$j]*($perc[$i]/100);
            $res1 = ($consPercent * $basprice[$i])/$consPercent;
            $res2 = ($consPercent * $effective[$i])/$consPercent;
            array_splice($array1['baseprice'],$j,1,$res1);
            array_splice($array1['effecprice'],$j,1,$res2);
          } else {
            $consPercent = $array1['consumption'][$j]*($perc[$i]/100);
            $consPercent1 = $array1['consumption'][$j]*($perc[$i-1]/100);

            $counteCount = $i;
           
            for(; $counteCount>=0; $counteCount--) {
              $checking = $array1['consumption'][$j]*($perc[$counteCount]/100);
              $constConsumption = $constConsumption + $checking;

              $ress1 = $ress1 + ($checking*$basprice[$counteCount]);
              $ress2 = $ress2 + ($checking*$effective[$counteCount]);

            }
            $res1 = (($consPercent*$basprice[$i])+($consPercent1*$basprice[$i-1]))/(($consPercent)+($consPercent1));
            $res2 = (($consPercent*$effective[$i])+($consPercent1*$effective[$i-1]))/(($consPercent)+($consPercent1));
            array_splice($array1['baseprice'],$j,1,$res1);
            array_splice($array1['effecprice'],$j,1,$res2);
          }
        }
        // echo $constConsumption;
        echo "<pre>";
        echo "Base :";
        echo round($ress1/$constConsumption,2);
        echo "<br>Effec : ";
        echo round($ress2/$constConsumption,2);
      }
    }

    echo "<pre>";   
    print_r($array1);

?>