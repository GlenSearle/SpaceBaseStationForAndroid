include <./servo-s2309s.scad>;
wall=1.3;
modem_pcb=[90,45,1.5];

translate([-1.3,-10,12.3])
rotate([180,0,180])
translate([BeamLength+14+wall,2-wall-ServoBody[1]/2,-FlangeToBottom-wall]) clamp();

//translate([8,0-modem_pcb[1]/2,wall]) color("red") cube(modem_pcb);


translate([6,1.5-modem_pcb[1]/2,(wall*2)+modem_pcb[2]+0.3])
rotate ([-90,0,0])
cylinder(r=wall,h=modem_pcb[1]-13);

for (ypos = [-22,-7,8])
translate([0,ypos,0])
hook();


module hook(){
translate([6,0,0])
cube([modem_pcb[0]+4,wall*3,wall]);

translate([8+modem_pcb[0],0,0]){
cube([2,wall*3,5]);

translate([0.5,0,(wall*2)+modem_pcb[2]+0.3])
rotate ([-90,0,0])
cylinder(r=wall,h=wall*3);
 }
}

