<?php

// mon
$mon_s_hrs=$_POST["mon-s-hrs"];
$mon_s_min=$_POST["mon-s-min"];
$mon_e_hrs=$_POST["mon-e-hrs"];
$mon_e_min=$_POST["mon-e-min"];

//tues
$tue_s_hrs=$_POST["tue-s-hrs"];
$tue_s_min=$_POST["tue-s-min"];
$tue_e_hrs=$_POST["tue-e-hrs"];
$tue_e_min=$_POST["tue-e-min"];
//wed
$wed_s_hrs=$_POST["wed-s-hrs"];
$wed_s_min=$_POST["wed-s-min"];
$wed_e_hrs=$_POST["wed-e-hrs"];
$wed_e_min=$_POST["wed-e-min"];
//thur
$thu_s_hrs=$_POST["thu-s-hrs"];
$thu_s_min=$_POST["thu-s-min"];
$thu_e_hrs=$_POST["thu-e-hrs"];
$thu_e_min=$_POST["thu-e-min"];
//fri
$fri_s_hrs=$_POST["fri-s-hrs"];
$fri_s_min=$_POST["fri-s-min"];
$fri_e_hrs=$_POST["fri-e-hrs"];
$fri_e_min=$_POST["fri-e-min"];
//sat
$sat_s_hrs=$_POST["sat-s-hrs"];
$sat_s_min=$_POST["sat-s-min"];
$sat_e_hrs=$_POST["sat-e-hrs"];
$sat_e_min=$_POST["sat-e-min"];
//sun
$sun_s_hrs=$_POST["sun-s-hrs"];
$sun_s_min=$_POST["sun-s-min"];
$sun_e_hrs=$_POST["sun-e-hrs"];
$sun_e_min=$_POST["sun-e-min"];
//ph check box variable
$mon_ph=$_POST["mon-ph"];
$tue_ph=$_POST["tue-ph"];
$wed_ph=$_POST["wed-ph"];
$thu_ph=$_POST["thu-ph"];
$fri_ph=$_POST["fri-ph"];
$sat_ph=$_POST["sat-ph"];
$sun_ph=$_POST["sun-ph"];
//
$mon_ord_hrs=$mon_diff=$mon_night_hrs=$mon_ph_hrs=$mon_ot_hrs="";
$tue_ord_hrs=$tue_diff=$tue_night_hrs=$tue_ph_hrs=$tue_ot_hrs="";
$wed_ord_hrs=$wd_diff=$wed_night_hrs=$wed_ph_hrs=$wed_ot_hrs="";
$thu_ord_hrs=$mon_diff=$thu_night_hrs=$thu_ph_hrs=$thu_ot_hrs="";
$fri_ord_hrs=$mon_diff=$fri_night_hrs=$fri_ph_hrs=$fri_ot_hrs="";
$sat_ord_hrs=$sat_diff=$sat_night_hrs=$sat_ph_hrs=$sat_ot_hrs=$sat_sp="";
$sun_ord_hrs=$sun_diff=$sun_night_hrs=$sun_ph_hrs=$sun_ot_hrs=$sun_sp="";
//
$baserate=21.5047;
$night_rate=1.3;
$ph_rate=2.5;
$ot_rate=1.5;
$sat_sp_rate=1.25;
$sun_sp_rate=2;
$sun_night_rate=2;
$sun_day_rate=1.5;

$total_hrs=$total_gross_sal=$total_net_sal=$tax="";

$my=array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");

// if any of the value is -- then we set the variable ==0 else we set it to the value from user

for($i=0;$i<7;$i++)
{
    if((${substr($my[$i],0,3)."_s_hrs"}=="--")or (${substr($my[$i],0,3)."_s_min"}=="--")or (${substr($my[$i],0,3)."_e_hrs"}=="--")or (${substr($my[$i],0,3)."_e_min"}=="--"))
    {
        ${substr($my[$i],0,3)."_s_hrs"}=0;
        ${substr($my[$i],0,3)."_s_min"}=0;
        ${substr($my[$i],0,3)."_e_hrs"}=0;
        ${substr($my[$i],0,3)."_e_min"}=0;
        ${substr($my[$i],0,3)."_diff"}=0;
        ${substr($my[$i],0,3)."_ord"}=0;
        ${substr($my[$i],0,3)."_night_hrs"}=0;
        ${substr($my[$i],0,3)."_ot_hrs"}=0;
        ${substr($my[$i],0,3)."_ph_hrs"}=0;

    }
    elseif((${substr($my[$i],0,3)."_s_hrs"}!="--")&&(${substr($my[$i],0,3)."_s_min"}!="--")&&(${substr($my[$i],0,3)."_e_hrs"}!="--")&&(${substr($my[$i],0,3)."_e_min"}!="--"))
    {
        ${substr($my[$i],0,3)."_s_hrs"}=((int)${substr($my[$i],0,3)."_s_hrs"}*(60));
        ${substr($my[$i],0,3)."_s_min"}=(int)${substr($my[$i],0,3)."_s_min"};
        ${substr($my[$i],0,3)."_e_hrs"}=((int)${substr($my[$i],0,3)."_e_hrs"}*(60));
        ${substr($my[$i],0,3)."_e_min"}=(int)${substr($my[$i],0,3)."_e_min"};
    }
}
// mon to friday calculation only as diffrent loading for sat and sunday
for($d=0;$d<5;$d++)
{
// to calculate the diffrence in time.
${substr($my[$d],0,3)."_diff"}=(${substr($my[$d],0,3)."_e_hrs"}+${substr($my[$d],0,3)."_e_min"})-(${substr($my[$d],0,3)."_s_hrs"}+${substr($my[$d],0,3)."_s_min"});
//echo ${substr($my[$d],0,3)."_diff"}."<br>";
//start hours should be greater than 0 for proper calculation when all user enter (--). and and person finish time at 0000 ie(2400) mid night 
if((${substr($my[$d],0,3)."_s_hrs"}>0)&&(${substr($my[$d],0,3)."_e_hrs"}==0)&&(${substr($my[$d],0,3)."_e_min"}==0))
{
    // 00 00 hours is considered as 2400 hours hence some hard coded value below.
    ${substr($my[$d],0,3)."_e_hrs"}=(24*60);
    ${substr($my[$d],0,3)."_e_min"}=0;
    // we repeat the $diff formula so that 24 value is considered
    ${substr($my[$d],0,3)."_diff"}=(${substr($my[$d],0,3)."_e_hrs"}-${substr($my[$d],0,3)."_s_hrs"})+(${substr($my[$d],0,3)."_e_min"}-${substr($my[$d],0,3)."_s_min"});

}

 
//end hours should be greater than start hours except when end hrs is 0000.
elseif(${substr($my[$d],0,3)."_e_hrs"}<${substr($my[$d],0,3)."_s_hrs"})
{
    echo "end hours need to be greater than start hours<br>";
    ${substr($my[$d],0,3)."_diff"}=0;
    ${substr($my[$d],0,3)."_ord_hrs"}=0;
    ${substr($my[$d],0,3)."_ot_hrs"}=0;
    ${substr($my[$d],0,3)."_night_hrs"}=0;
    ${substr($my[$d],0,3)."_ph_hrs"}=0;
}


//when shift fall in both segments(ordinary and night shift)
if((${substr($my[$d],0,3)."_s_hrs"}>=0)&&(${substr($my[$d],0,3)."_s_hrs"}<300)&&(${substr($my[$d],0,3)."_e_hrs"}>=300)&&(${substr($my[$d],0,3)."_e_min"}>=0))
{
 
  if(${substr($my[$d],0,3)."_diff"}>600)
  {
     ${substr($my[$d],0,3)."_night_hrs"}=(300)-(${substr($my[$d],0,3)."_s_hrs"}+${substr($my[$d],0,3)."_s_min"});
     ${substr($my[$d],0,3)."_ord_hrs"}=${substr($my[$d],0,3)."_diff"}-${substr($my[$d],0,3)."_night_hrs"};
     ${substr($my[$d],0,3)."_ot_hrs"}=${substr($my[$d],0,3)."_diff"}-600;
     ${substr($my[$d],0,3)."_ph_hrs"}=0;
     //echo "ord +night>600";
  }     
  elseif(${substr($my[$d],0,3)."_diff"}<=600)
   {
    ${substr($my[$d],0,3)."_night_hrs"}=(300)-(${substr($my[$d],0,3)."_s_hrs"}+${substr($my[$d],0,3)."_s_min"});
    ${substr($my[$d],0,3)."_ord_hrs"}=(${substr($my[$d],0,3)."_diff"})-${substr($my[$d],0,3)."_night_hrs"};
    ${substr($my[$d],0,3)."_ot_hrs"}=0;
    ${substr($my[$d],0,3)."_ph_hrs"}=0;
    //echo "ord +night<=600<br>";
   }

}

// ordinary hours calculation from 0500 to 0000
if((${substr($my[$d],0,3)."_s_hrs"}>=300)&&(${substr($my[$d],0,3)."_s_hrs"}<=1440)&&(${substr($my[$d],0,3)."_e_hrs"}>=300)&&(${substr($my[$d],0,3)."_e_hrs"}<=1440))
{
    if(${substr($my[$d],0,3)."_diff"}>600)
    {
        ${substr($my[$d],0,3)."_ot_hrs"}=${substr($my[$d],0,3)."_diff"}-600;
        ${substr($my[$d],0,3)."_ord_hrs"}=600;
        ${substr($my[$d],0,3)."_night_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=0;
        //echo "ord cal>600<br>";

    }
    elseif(${substr($my[$d],0,3)."_diff"}<=600) 
    {
        ${substr($my[$d],0,3)."_ord_hrs"}=${substr($my[$d],0,3)."_diff"};
        ${substr($my[$d],0,3)."_ot_hrs"}=0;
        ${substr($my[$d],0,3)."_night_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=0;
        //echo "ord cal<=600 <br>";
    }
}


// night shift(when shift fall bwtween 0000 to 0500)

if((${substr($my[$d],0,3)."_s_hrs"}>=0)&&(${substr($my[$d],0,3)."_s_hrs"}<=300)&&(${substr($my[$d],0,3)."_e_hrs"}>=0)&&(${substr($my[$d],0,3)."_e_hrs"}<=300))
{
    //never true as the shift period is is 0 to 300
    if(${substr($my[$d],0,3)."_diff"}>600)
    {
    
        ${substr($my[$d],0,3)."_ord_hrs"}=0;
        ${substr($my[$d],0,3)."_night_hrs"}=${substr($my[$d],0,3)."_diff"};
        //as calculation are for shift falling in 5 hrs ot=0 and ord hrs=0
        ${substr($my[$d],0,3)."_ot_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=0;
        //echo "night>600<br>";
    }
    elseif(${substr($my[$d],0,3)."_diff"}<=600)
    {
        if((${substr($my[$d],0,3)."_e_hrs"}=300)&&(${substr($my[$d],0,3)."_e_min"}>0))
        {
        ${substr($my[$d],0,3)."_night_hrs"}=${substr($my[$d],0,3)."_diff"}-${substr($my[$d],0,3)."_e_min"};
        ${substr($my[$d],0,3)."_ord_hrs"}=${substr($my[$d],0,3)."_e_min"};
        ${substr($my[$d],0,3)."_ot_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=0;
        }
        else
        {
        ${substr($my[$d],0,3)."_ord_hrs"}=0;
        ${substr($my[$d],0,3)."_night_hrs"}=${substr($my[$d],0,3)."_diff"};
        //as calculation are for shift falling in 5 hrs ot=0 and ord hrs=0
        ${substr($my[$d],0,3)."_ot_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=0;
        //echo "night<600<br>";
        }
    }
}

// ph
if(${substr($my[$d],0,3)."_ph"}=="on")
{
    if(${substr($my[$d],0,3)."_diff"}<=600)
    {
        ${substr($my[$d],0,3)."_ord_hrs"}=0;
        ${substr($my[$d],0,3)."_night_hrs"}=0;
        ${substr($my[$d],0,3)."_ot_hrs"}=0;
        ${substr($my[$d],0,3)."_ph_hrs"}=${substr($my[$d],0,3)."_diff"};
    }
    if(${substr($my[$d],0,3)."_diff"}>600)
    {
        ${substr($my[$d],0,3)."_ord_hrs"}=0;
        ${substr($my[$d],0,3)."_night_hrs"}=0;
        ${substr($my[$d],0,3)."_ot_hrs"}=${substr($my[$d],0,3)."_diff"}-600;
        ${substr($my[$d],0,3)."_ph_hrs"}=${substr($my[$d],0,3)."_diff"};
    }
}

} //for loop close  

/// sat and sun if end hrs is 00 00
if(($sat_s_hrs>0)&&($sat_e_hrs==0)&&($sat_e_min==0))
 {
    // 00 00 hours is considered as 2400 hours hence some hard coded value below.
    $sat_e_hrs=(24*60);
    $sat_e_min=0;
    
 }

if(($sun_s_hrs>0)&&($sun_e_hrs==0)&&($sun_e_min==0))
{
    // 00 00 hours is considered as 2400 hours hence some hard coded value below.
    $sun_e_hrs=(24*60);
    $sun_e_min=0;
} 

// sat and sunday diff hours
$sat_diff=($sat_e_hrs+$sat_e_min)-($sat_s_hrs+$sat_s_min);
$sun_diff=($sun_e_hrs+$sun_e_min)-($sun_s_hrs+$sun_s_min);

//sat 00 to 0600 night hrs
if(($sat_s_hrs>=0)&&($sat_s_hrs<=360)&&($sat_e_hrs>=0)&&($sat_e_hrs<=360))
{
    if($sat_diff<=600)
    {
        if(($sat_e_hrs=360)&&($sat_e_min>0))
        {
            $sat_night_hrs=$sat_diff-$sat_e_min;
            $sat_ord_hrs=$sat_e_min;
            $sat_ot_hrs=0;
            $sat_ph_hrs=0;
            //echo "sat night<600 <br>";
        }
        else
        {
            $sat_night_hrs=$sat_diff;
            $sat_ord_hrs=0;
            $sat_ot_hrs=0;
            $sat_ph_hrs=0;

        }
    }
    //never true as the shift calculation is between 0 and 360 hrs
    if($sat_diff>600)
    {
        $sat_night_hrs=$sat_diff;
        $sat_ord_hrs=0;
        $sat_ot_hrs=0;
        $sat_ph_hrs=0;
    }

}

//sat nigth+ ordinary hrs 
if(($sat_s_hrs>=0)&&($sat_s_hrs<360)&&($sat_e_hrs>360))
{
    if($sat_diff<=600)
    {
    $sat_night_hrs=360-($sat_s_hrs+$sat_s_min);
    $sat_ord_hrs=$sat_diff-$sat_night_hrs;
    $sat_ph_hrs=0;
    $sat_ot_hrs=0;
    //echo "sat night+ord< 600 <br>"; 
    }
    //$sat_diff>600
    elseif ($sat_diff>600)
    {
    $sat_night_hrs=360-($sat_s_hrs+$sat_s_min);
    $sat_ord_hrs=600-$sat_night_hrs;
    $sat_ph_hrs=0;
    $sat_ot_hrs=$sat_diff-600;

    }
     
}

//Case of sat night+ordinary+ sat_sp_ord (2100 to 2400) is unlikely so  no calculation done.


//sat ordinary + sat_special 
if(($sat_s_hrs>=360)&&($sat_s_hrs<=1260)&&($sat_e_hrs>=1260)&&($sat_e_hrs<=1440))

if($sat_diff<=600)
{
    $sat_ord_hrs=1260-($sat_s_hrs+$sat_s_min);
    $sat_sp=$sat_diff-$sat_ord_hrs;
    $sat_night_hrs=0;
    $sat_ot_hrs=0;
    $sat_ph_hrs=0;
    //echo "sat ord+ sat_sp_ord<600<br>";
}
elseif($sat_diff>600)
{
    $sat_ord_hrs=1260-($sat_s_hrs+$sat_s_min);
    $sat_sp=$sat_diff-$sat_ord_hrs;
    $sat_night_hrs=0;
    $sat_ot_hrs=$sat_diff-600;
    $sat_ph_hrs=0;
}

//sat ordiary 0600 to 2100
if(($sat_s_hrs>=360)&&($sat_s_hrs<=1260)&&($sat_e_hrs>=360)&&($sat_e_hrs<=1260))
{
    if($sat_diff<=600)
    {
        $sat_ord_hrs=$sat_diff; 
        $sat_night_hrs=0;
        $sat_ph_hrs=0;
        $sat_ot_hrs=0;
    }
    elseif($sat_diff>600)
    {
        $sat_ord_hrs=600;
        $sat_night_hrs=0;
        $sat_ph_hrs=0;
        $sat_ot_hrs=$sat_diff-600;  
    }
}



// sat 2100 to 2400, 1.25 X base hours
if(($sat_s_hrs>=1260)&&($sat_s_hrs<=1440)&&($sat_e_hrs>=1260)&&($sat_e_hrs<=1440))
{
    if($sat_diff<600)
    {
        $sat_ord_hrs=0; 
        $sat_night_hrs=0;
        $sat_ph_hrs=0;  
        $sat_ot_hrs=0;
        $sat_sp=$sat_diff;
    }
    //does not apply and never true as time diff is 180
    elseif ($sat_diff>600)
    {
        $sat_ord_hrs=0; 
        $sat_night_hrs=0;
        $sat_ph_hrs=0;  
        $sat_ot_hrs=0;
        $sat_sp=0;   
    }
    
}
    

//sun night 00 to 0600, 2.0 x base hours

if(($sun_s_hrs>=0)&&($sun_s_hrs<=360)&&($sun_e_hrs>=0)&&($sun_e_hrs<=360))
{
    if($sun_diff<=600)
    {
        if(($sun_e_hrs=360)&&($sun_e_min>0))
        {
            $sun_night_hrs=$sun_diff-$sun_e_min;
            $sun_ord_hrs=$sun_e_min;
            $sun_ot_hrs=0;
            $sun_ph_hrs=0;
            $sun_sp=0;
            //echo "sun night<600 <br>";
        }
        else
        {
            $sun_night_hrs=$sun_diff;
            $sun_ord_hrs=0;
            $sun_ot_hrs=0;
            $sun_ph_hrs=0;
            $sun_sp=0;

        }
    }
    //never true as the shift calculation is between 0 and 360 hrs
    if($sun_diff>600)
    {
        $sun_night_hrs=$sun_diff;
        $sun_ord_hrs=0;
        $sun_ot_hrs=0;
        $sun_ph_hrs=0;
        $sun_sp=0;
    }

}

// sun night and day combined
if(($sun_s_hrs>=0)&&($sun_s_hrs<=360)&&($sun_e_hrs>360)&&($sun_e_hrs<=1260))
{
    if ($sun_diff<600)
    {
    $sun_night_hrs=360-($sun_s_hrs+$sun_s_min);
    $sun_ord_hrs=$sun_diff-$sun_night_hrs;
    $sun_ot_hrs=0;
    $sun_ph_hrs=0;
    $sun_sp=0;
    }
    elseif ($sun_diff>600)
    {
     
    }
}

//sun 0600 to 2100, 1.5 x base hours
if(($sun_s_hrs>=360)&&($sun_s_hrs<=1260)&&($sun_e_hrs>=360)&&($sun_e_hrs<=1260))
{
    if($sun_diff<600)
    {
    $sun_night_hrs=0;
    $sun_ord_hrs=$sun_diff;
    $sun_ot_hrs=0;
    $sun_ph_hrs=0;
    $sun_sp=0;
    }
    elseif($sun_diff>600)
    {
     
    }
}


//sun 2100 to 0000, 2 x base hours 
if(($sun_s_hrs>=1260)&&($sun_s_hrs<=1440)&&($sun_e_hrs>=1260)&&($sun_e_hrs<=1440))
{
    if($sun_diff<600)
    {
    $sun_sp=$sun_diff;
    $sun_ord_hrs=0;
    $sun_ot_hrs=0;
    $sun_ph_hrs=0;
    $sun_night_hrs=0;
    }
    elseif ($sun_diff>600)
    {
    
    }
}


// comibined sunday day + sun _sp..
if(($sun_s_hrs>=360)&&($sun_s_hrs<=1260)&&($sun_e_hrs>1260)&&($sun_e_hrs<=1440))
{
if($sun_diff<600)
{
$sun_ord_hrs=1260-($sun_s_hrs+$sun_s_min);
$sun_sp=$sun_diff-$sun_ord_hrs;
$sun_ot_hrs=0;
$sun_ph_hrs=0;
$sun_night_hrs=0;
}
}

// night+sunday day + sun _sp
//this possibility is remove so wont write the code for it.


// for loop salary calculation and presentation.

echo "<h1 align=\"center\">"."SALARY CALCULATION ARE..</h1>";
for($a=0;$a<5;$a++)
{
echo "<h3>".strtoupper($my[$a])."</h3>";
if(${substr($my[$a],0,3)."_ord_hrs"}!=0)
{
echo "<DIV>ORD : ".(${substr($my[$a],0,3)."_ord_hrs"}/60)."hrs x $baserate=$ ".(${substr($my[$a],0,3)."_ord_hrs"}/60*$baserate)."
<br>";
    $total_hrs+=(${substr($my[$a],0,3)."_ord_hrs"}/60);
    $total_gross_sal+=((${substr($my[$a],0,3)."_ord_hrs"}/60)*$baserate);
}

if(${substr($my[$a],0,3)."_night_hrs"}!=0)
{
echo "NIGHT : ".(${substr($my[$a],0,3)."_night_hrs"}/60)."hrs x $baserate x $night_rate=$ ".(${substr($my[$a],0,3)."_night_hrs"}/60*($baserate*$night_rate))."<br>";
    $total_hrs+=(${substr($my[$a],0,3)."_night_hrs"}/60);
    $total_gross_sal+=(${substr($my[$a],0,3)."_night_hrs"}/60)*($baserate*$night_rate);
}
if(${substr($my[$a],0,3)."_ot_hrs"}!=0)
{ 
echo "OT : ".(${substr($my[$a],0,3)."_ot_hrs"}/60)."hrs x $baserate x $ot_rate=$".(${substr($my[$a],0,3)."_ot_hrs"}/60)*$baserate*$ot_rate."<br>";
    $total_hrs=(${substr($my[$a],0,3)."_ot_hrs"}/60);
    $total_gross_sal+=((${substr($my[$a],0,3)."_ot_hrs"}/60)*$baserate*$ot_rate);
}
if(${substr($my[$a],0,3)."_ph_hrs"}!=0)
{
echo "PH : ".(${substr($my[$a],0,3)."_ph_hrs"}/60)."hrs x $baserate x $ph_rate=$".(${substr($my[$a],0,3)."_ph_hrs"}/60)*$baserate*$ph_rate ."<br>";
$total_hrs=(${substr($my[$a],0,3)."_ph_hrs"}/60);
$total_gross_sal+=((${substr($my[$a],0,3)."_ph_hrs"}/60)*$baserate*$ph_rate);
}

} // for loop close 
//$sat_sp
//$sat_sp_rate
// sat special hours

echo "<h3>".strtoupper($my[5])."</h3>";
if($sat_ord_hrs!=0)
{

 echo "<DIV>ORD : ".($sat_ord_hrs/60)."hrs x $baserate=$ ".(($sat_ord_hrs/60)*$baserate)."</DIV><br>";
 $total_hrs+=($sat_ord_hrs/60);
 $total_gross_sal+=($sat_ord_hrs/60)*$baserate;
}
if($sat_sp!=0)
{
echo "<DIV>SAT_SP ORD : ".($sat_sp/60)."hrs x $baserate x $sat_sp_rate=$ ".($sat_sp/60)*($baserate*$sat_sp_rate)."</DIV><br>";
$total_hrs+=($sat_sp/60);
$total_gross_sal+=($sat_sp/60)*$baserate*$sat_sp_rate;
}

if($sat_night_hrs!=0)
{
echo "NIGHT : ".($sat_night_hrs/60)."hrs x $baserate x $night_rate=$ ".($sat_night_hrs/60)*$baserate*$night_rate."<br>";
$total_hrs+=($sat_night_hrs/60);
$total_gross_sal+=($sat_night_hrs/60)*$baserate*$night_rate;
}

if($sat_ot_hrs!=0)
{ 
echo "OT : ".($sat_ot_hrs/60)."hrs x $baserate x $ot_rate=$".($sat_ot_hrs/60)*$baserate*$ot_rate."<br>";
$total_hrs+=($sat_ot_hrs/60);
$total_gross_sal+=($sat_ot_hrs/60)*$baserate*$ot_rate;
}
if($sat_ph_hrs!=0)
{
echo "PH : ".($sat_ph_hrs/60)."hrs x $baserate x $ph_rate=$".($sat_ph_hrs/60)*$baserate*$ph_rate ."<br>";
$total_hrs+=($sat_ph_hrs/60);
$total_gross_sal+=($sat_ph_hrs/60)*$baserate*$ph_rate;
}
//sun night,sun_day hrs sun_sp_hrs
echo "<h3>".strtoupper($my[6])."</h3>";


if($sun_night_hrs!=0)
{
    echo "<DIV>NIGHT : ".($sun_night_hrs/60)."hrs x $baserate x $sun_night_rate=$ ".($sun_night_hrs/60)*$baserate*$sun_night_rate."</DIV><br>";
$total_hrs+=($sun_night_hrs/60);
$total_gross_sal+=($sun_night_hrs/60)*$baserate*$sun_night_rate;
}

if($sun_ord_hrs!=0)
{
echo "<DIV>ORD : ".($sun_ord_hrs/60)."hrs x $baserate x $sun_day_rate=$ ".($sun_ord_hrs/60)*$baserate*$sun_day_rate."</div><br>";
$total_hrs+=($sun_ord_hrs/60);
$total_gross_sal+=($sun_ord_hrs/60)*$baserate*$sun_day_rate;
}

if($sun_sp!=0)
{
echo "<DIV>ORD : ".($sun_sp/60)."hrs x $baserate x $sun_sp_rate=$ ".($sun_sp/60)*$baserate*$sun_sp_rate."</div><br>";
$total_hrs+=($sun_sp/60);
$total_gross_sal+=($sun_sp/60)*$baserate*$sun_sp_rate;
}
// tax calculation according to ato formula.
// y=ax-b where y is the withholding amount.  a and b are values give by ATO and x is the gross salary + 0.99 cents.
// we will be do calculation for, Where the employee claimed the tax-free threshold in Tax file number declaration Scale 2
if($total_gross_sal<355)
{
$tax=0;
}
elseif($total_gross_sal<422)
{
$tax=round(0.1900*($total_gross_sal+0.99)-67.4635);
}
elseif($total_gross_sal<528)
{
$tax=round(0.2900*($total_gross_sal+0.99)-109.7327);
}
elseif($total_gross_sal<711)
{
$tax=round(0.2100*($total_gross_sal+0.99)-67.4635);
}
elseif($total_gross_sal<1282)
{
$tax=round(0.3477*($total_gross_sal+0.99)-165.4423);
}
elseif($total_gross_sal<1730)
{
$tax=round(0.3450*($total_gross_sal+0.99)-161.9808);
}
elseif($total_gross_sal<3461)
{
$tax=round(0.3900*($total_gross_sal+0.99)-239.8654);
}
elseif($total_gross_sal>3461)
{
$tax=round(0.4700*($total_gross_sal+0.99)-516.7885);
}

echo "TOTAL HOURS :  ".$total_hrs."hrs <br>";
echo "GROSS SALARY:$  ".$total_gross_sal."<br>";
echo "TAX : $ ".$tax."<br>";
echo "NET SALARY :".($total_gross_sal-$tax);
?>
