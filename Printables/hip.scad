include <./servo-s2309s.scad>;
//Thickness of walls in mm.
wall=1.6;
//Length of beam comming off servo holder in mm.
BeamLendth=90;

//The amount of extra space around the servo sides.
//X & Y of the main body only.
ServoPadding=0.2;

rotate([0,90,0]){



difference(){
translate([-AxleOffset+0.01,-wall-ServoBody[1]/2,-0.1-FlangeToBottom-wall]) 
union(){
cube([ServoBody[0]+wall,ServoBody[1]+wall*2,FlangeToBottom+wall+Flange[2]]);
//pivot hole
translate([AxleOffset+0.01,wall+ServoBody[1]/2,0.1]) 
rotate([0,180,0]){
 cylinder(r=2.5+wall, h=3);
 translate([-7,-(wall/2),0])
  cube([5,wall,3]);
}
translate([0,wall+ServoBody[1]/2,0])
difference(){ 
cylinder(r=wall+ServoBody[1]/2,h=FlangeToBottom+wall+Flange[2]);
translate([-21,-8,10]) cube(15);
}
}
draw_servo([0,0,0]);

//cable out.
translate([-14.9,-10,-FlangeToBottom-wall-0.2])
cube([10,20,11]);
//Arch for servo cable.
translate([-4.5,0,-8]) scale([0.7,1,1]) cylinder(r=12.5/2,h=9);

//pivot hole
translate([0,0,-FlangeToBottom+0.1])
rotate([0,180,0]) cylinder(r=2.5, h=5);
}

//draw_servo([0,0,0]);


translate([18.01+wall,7-wall-ServoBody[1]/2,-FlangeToBottom-wall])
rotate([180,90,0],center=true)
beam(BeamLendth);



//cable hoop.
translate([18,7,-16.6])
difference(){
cube([wall,4+wall,10+(wall*2)]);
translate([-0.1,0,wall]) cube([wall+0.2,4,10]);
}

//mirror cable hoop.
rotate([180,0,0])
translate([18,7,6.6-(wall*2)])
difference(){
cube([wall,4+wall,10+(wall*2)]);
translate([-0.1,0,wall]) cube([wall+0.2,4,10]);
}

}//end rotate

