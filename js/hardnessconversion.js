// Hardness Conversion Tool
// Version: 1.5
// Author: Tom Osborne
// Date: 04/12/2020

function vickersFromRockwell(Rockwell, ElementID) {
    let x_rw = Rockwell;
    let elementID = ElementID;
    let y_vk;

    y_vk =    ( 0.000111 * Math.pow(x_rw, 4) ) 
            - ( 0.014722 * Math.pow(x_rw, 3) )
            + ( 0.845702 * Math.pow(x_rw, 2) )
            - ( 15.166443 * x_rw ) 
            + 303.499402;

    y_vk = Math.round((y_vk + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_vk;
}

function rockwellFromVickers(Vickers, ElementID) {
    let x_vk = Vickers;
    let elementID = ElementID;
    let y_rw;

    y_rw =  - ( 0.0000000001794084 * Math.pow(x_vk, 4) )
            + ( 0.0000005101322 * Math.pow(x_vk, 3) )
            - ( 0.0005927337 * Math.pow(x_vk, 2) )
            + (0.3701118 * x_vk)
            - 40.39573;

    y_rw = Math.round((y_rw + Number.EPSILON) * 10 ) / 10; //1 DP

    document.getElementById(elementID).innerHTML = y_rw;
}

function brinellFromVickers(Vickers, ElementID) {
    let x_vk = Vickers;
    let elementID = ElementID;
    let y_br;

    y_br = ( 0.9317 * x_vk ) + 4.7088;

    y_br = Math.round((y_br + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_br;
}

function vickersFromBrinell(Brinell, ElementID) {
    let x_br = Brinell;
    let elementID = ElementID;
    let y_vk;

    y_vk = ( 1.0732 * x_br ) - 5.0422;

    y_vk = Math.round((y_vk + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_vk;
}

function vickersFromStrength(Strength, ElementID) {
    let x_str = Strength;
    let elementID = ElementID;
    let y_vk;

    y_vk = ( x_str * 0.2936 ) + 14.982;

    y_vk = Math.round((y_vk + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_vk;
}

function strengthFromVickers(Vickers, ElementID) {
    let x_vk = Vickers;
    let elementID = ElementID;
    let y_str;

    y_str = ( x_vk - 14.982 ) / 0.2936;

    y_str = Math.round((y_str + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_str;
}

function vickersFromKnoop(Knoop, ElementID) {
    let x_kn = Knoop;
    let elementID = ElementID;
    let y_vk;

    y_vk =     ( 0.0006 * Math.pow(x_kn, 2)  )
             + ( 0.2434 * x_kn )
             + 203.3;

    y_vk = Math.round((y_vk + Number.EPSILON) * 1 ) / 1; //0 DP

    document.getElementById(elementID).innerHTML = y_vk;
}