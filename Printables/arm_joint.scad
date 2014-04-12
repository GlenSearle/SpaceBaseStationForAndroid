include <./servo-s2309s.scad>;
wall=1.75;
BeamLength=12;
//The amount of extra space around the servo.
ServoPadding=0.2;


difference(){
translate([-AxleOffset+0.01,-wall-ServoBody[1]/2,-FlangeToBottom-wall]) 
union(){
cube([ServoBody[0]+wall,ServoBody[1]+wall*2,FlangeToBottom+wall+Flange[2]-0.01]);
translate([0,wall+ServoBody[1]/2,0])
cylinder(r=wall+ServoBody[1]/2,h=FlangeToBottom+wall+Flange[2]-0.01);
}
draw_servo([0,0,0]);

//cable out.
translate([-14.9,-10,-FlangeToBottom-wall-0.2])
cube([10,20,11]);
//Arch for servo cable.
translate([-4.5,0,-8]) scale([0.3,1,1]) cylinder(r=12.5/2,h=9);



//pivot hole
translate([0,0,-FlangeToBottom+0.1])
rotate([0,180,0]) cylinder(r=2.5, h=6);
}

difference(){
rotate([0,0,180])
translate([1+wall*2,7-wall-ServoBody[1]/2,-FlangeToBottom-wall])
beam(BeamLength);

draw_servo([0,0,0]);
}



rotate([0,0,180])
translate([BeamLength+10+wall,7-wall-ServoBody[1]/2,-FlangeToBottom-wall]) clamp();



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


