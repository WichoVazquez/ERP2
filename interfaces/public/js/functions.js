/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on("ready",proccess);

function proccess()
{
   
  //$(".cajanoticias").dwdinanews();
   $('.cajanoticias').vTicker({
       
        speed: 1000,
        pause: 3000,
        animation: 'fade',
        mousePause: true,
        height: 470,
        direction: 'up',
        showItems: 7
   }); 
}

function popup(url)
{
    window.open(url,'window','directories=no,width=550,height=450,hotkeys=no,location=no,menubar=no,personalbar=no,resizable=no,scrollbars=no,status=no,toolbar=no,left=350,top=100')
}


