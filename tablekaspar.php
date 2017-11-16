<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$contactDetails = '<table  border="0" style="font-size:16px;" cellspacing="6"  cellpadding="2" >';
$contactDetails .= '<tr><td colspan="4"><div style="width:100%;"><img style="width:200px; height:100px;"  src="http://kasparcompanies.com/images/kaspar-logo.png"> </div></td></tr>';
$contactDetails .= '<tr><td colspan="4"><h5 align="left" style="text-transform: uppercase;font-size:12px;font-weight: 500">Job Application Request ' . $contact_info['first_name'] . ' ' . $contact_info['last_name'].'</h5></td></tr>';
$contactDetails .= '<tr><th colspan="4" ></th></tr>';
$contactDetails .= '<tr><th colspan="4" ><h3 style="text-transform: uppercase;color:#00ADEF;font-weight: 500;padding:50px 0px">Personal Contact information</h3></th></tr>';
$contactDetails .= '<tr><th colspan="4" ></th></tr>';
$contactDetails .= '<tr style="margin:0px; padding:0px">';
$contactDetails .= '<td style="vertical-align:bottom" >' . $contact_info['first_name'] . '</td>';
$contactDetails .= '<td style="vertical-align:bottom">' . $contact_info['last_name'] . '</td>';
$contactDetails .= '<td style="vertical-align:bottom">' . $contact_info['mi'] . '</td>';
$contactDetails .= '<td style="vertical-align:bottom">'. $contact_info['application_date'] . '</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">First name</td>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Last name</td>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px; width:50px">M</td>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Application Date</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td valign="bottom" style="vertical-align:bottom">' . $contact_info['address'] . '</td>';
$contactDetails .= '<td valign="bottom" style="vertical-align:bottom">' . $contact_info['city'] . '</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td colspan="2" style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Address</td>';
$contactDetails .= '<td colspan="2" style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">City</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td  colspan="2" valign="bottom" style="vertical-align:bottom;width:50px;">' . $contact_info['state'] . '</td>';
$contactDetails .= '<td colspan="2"  valign="bottom" style="vertical-align:bottom">' . $contact_info['zipcode'] . '</td>';
$contactDetails .= '</tr>';

$contactDetails .= '<tr>';
$contactDetails .= '<td  colspan="2" style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">ST</td>';
$contactDetails .= '<td colspan="2" style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Zip code</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td valign="bottom" style="vertical-align:bottom">' . $contact_info['primary_phone_number'] . '</td>';
$contactDetails .= '<td valign="bottom" style="vertical-align:bottom">' . $contact_info['secondary_phone_number'] . '</td>';
$contactDetails .= '<td colspan="2"  valign="bottom" style="vertical-align:bottom">' . $contact_info['email'] . '</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Primary phone number</td>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Secondary phone number</td>';
$contactDetails .= '<td colspan="2" style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;">Email address</td>';
$contactDetails .= '</tr>';

$contactDetails .= '<tr>';
$contactDetails .= '<td style="vertical-align:bottom" colspan="4">' . $contact_info['over_18'] . '</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;" colspan="4" >Are you 18 or older?</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td style="vertical-align:bottom" colspan="4">' . $contact_info['us_citizen'] . '</td>';
$contactDetails .= '</tr>';
$contactDetails .= '<tr>';
$contactDetails .= '<td style="border-top:1px solid #ccc;color:#ccc;padding:0px 0px 30px  0px;" colspan="4">Are you either a US citizen or an Allen authorized to work in the United States</td>';
$contactDetails .= '</tr>';

$contactDetails .= "
                <tr>
                   
                    <td style=\"vertical-align:bottom\">" . $employment_history['employer_name'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['employer_address'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['employer_city'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['employer_state'][$x] . "</td>            
                </tr>
                <tr>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Employer name</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Employer address</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Employer city</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Employer state</td>
                    
                </tr>
                
                <tr>
                   
                    <td style=\"vertical-align:bottom\">" . $employment_history['employer_business_type'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['supervisor_name'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['employment_position'][$x] . "</td>
                </tr>
                <tr> 
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Type of business</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Name of Supervisor </td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Position Held</td>
                </tr>
                
                <tr>
                    <td style=\"vertical-align:bottom\">" . $employment_history['employment_start_date'][$x] . "</td>
                    <td style=\"vertical-align:bottom\">" . $employment_history['employment_end_date'][$x] . "</td>
                    <td style=\"vertical-align:bottom\">" . $employment_history['pay_rate_start'][$x] . "</td>
                     <td style=\"vertical-align:bottom\">" . $employment_history['pay_rate_final'][$x] . "</td>
                </tr>
                <tr>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Start Employment</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">End Employment</td>
                    <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Starting Rate of Pay</td>
                     <td style=\"border-top:1px solid #A9A9A9;color:#A9A9A9;padding:0px 0px 30px  0px;\">Final pay rate</td>
                </tr>
                <tr>
                    <td colspan=\"\" style=\"border-bottom:1px solid #ccc;color:#A9A9A9;padding:0px 0px 30px  0px;width:20%\">Duties performed:</td>
                </tr>
                    <tr>
                    <td colspan=\"4\">" . $employment_history['duties'][$x] . "</td>
                </tr>
                
               
                 <tr>
                    <td colspan=\"\" style=\"border-bottom:1px solid #ccc;color:#A9A9A9;padding:0px 0px 30px  0px;width:10%\" >Reason for leaving:</td>
               <td style=\"width:80%\"></td>
               <td style=\"width:10%\"></td>
                        </tr>
                 <tr>
                    <td colspan=\"4\">" . $employment_history['leaving_reason'][$x] . "</td>
                </tr>
                <tr style=\"border-bottom:1px solid #A9A9A9;\">
                    <td colspan=\"2\"></td>                
                </tr>
                
            ";



$contactDetails .= '</table>';
echo $contactDetails;