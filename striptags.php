<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$text = '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>';
echo strip_tags($text);
echo "\n";

// Allow <p> and <a>
echo strip_tags($text, '<p><a>');


///////
$text = '<div class="accordionContent" style="display: block;"><p style="margin: 0in 0in 0pt;"><span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="mso-bidi-font-family: Calibri;"><font color="#000000">Installs manufactured grill guards, front-end replacements and various after-market truck and auto accessories per customer’s orders.&nbsp; The Ranch Hand Truck Accessories retail store positions are available in Boerne, TX.</font></span></span></span></p>
<p style="margin: 0in 0in 0pt;">&nbsp;</p>
<p><span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;">Mechanical ability required.&nbsp; </span></span><span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;">Minimal welding experience preferred, 12 volt wiring experience required.&nbsp; <span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;">Prior experience with truck accessory installations and/or fabrication preferred.</span></span></span></span></p>
<p><span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;"></span></span></p>
<p style="margin: 0in 0in 0pt;"><span style="font-size: 16px;"><span style="font-family: arial,helvetica,sans-serif;"><span style="mso-bidi-font-family: Calibri;"><font color="#000000">&nbsp;</font></span></span></span></p>
</div>';
$nop="<p>this is without p tag</p>";

$text2=strip_tags($text, '<p>');
//remvoe empty tags
$text3= preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $text2);
//remove inline styles
$text4= preg_replace('#(<[a-z ]*)(style=("|\')(.*?)("|\'))([a-z ]*>)#', '\\1\\6', $text3);

echo "-------------------<br>";

if (preg_match('%(<p[^>]*>.*?</p>)%i', $nop, $regs)) {
   $result = $regs[1];
  echo "yes p is tere";
    
} else {
   echo $result = "p is not hter";
}
?>