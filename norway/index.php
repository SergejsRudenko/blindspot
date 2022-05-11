<?php
require_once("api.php");

clearSessions();
$custom_session_id = initCustomSession();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="stylesheet" type="text/css" media="all" href="assets/css/reset.css">

<link href='https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="assets/css/style.css?v=7">

<link rel="shortcut icon" type="image/png" href="blindsave-favicon.png">

<script type="text/javascript" src="assets/js/TweenLite.js"></script>
<script type="text/javascript" src="assets/js/TweenLiteCSS.js"></script>
<script type="text/javascript" src="assets/js/TweenLiteEasing.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/js/modernizr.js"></script>
<script type="text/javascript" src="assets/js/script.js?v=8"></script>

<title>Blindsave customizer</title>

</head>
<body>

<header class="header">
    <div class="wrap">
        <a href="/" class="logo"><img src="./assets/img/blindsave-logo.svg"></a>
        <div class="free-delivery-block">
            <p class="delivery-text">Gratis frakt <span>i EU</span></p>
        </div>
        <p class="logo-text">CUSTOMIZER / SPESIALDESIGN</p>
        <div style="clear: both;">
        <div class="header-line">
            <div class="header-line-left"></div>
            <div class="header-line-divider"></div>
            <div class="header-line-right"></div>
        </div>
    </div>
</header>

<main class="main ">
    <div class="wrap relative">
        <div class="content content-left">
            <div class="uniform-wrap">
                <p class="preview-title">FORHÅNDSVISNING</p>
                
                <div class="uniform-svg svg-uniform-3" data-uniform="svg-uniform-3">

                    <?php echo file_get_contents("./assets/img/uniform-3.svg"); ?>

                </div>
                <div class="uniform-svg svg-uniform-2 hidden" data-uniform="svg-uniform-2">
                    
                    <?php echo file_get_contents("./assets/img/uniform-2.svg"); ?>
                    
                </div>
                <div class="uniform-svg svg-uniform-1 hidden" data-uniform="svg-uniform-1">

                    <?php echo file_get_contents("./assets/img/uniform-1.svg"); ?>

                </div>

                <div class="change-colors-wrap">
                    <a href="#" class="change-colors">Endring av farge </a>
                </div>
            </div>
        </div><div class="form-wrapper">
            <form class="submit-form" method="POST" action="">
                <div class="input-field required required-input validate-text">
                    <label>Navn<span class="required-star">*</span></label>
                    <input type="text" name="first-name" value="">
                </div>
                <div class="input-field required required-input validate-text">
                    <label>Etternavn<span class="required-star">*</span></label>
                    <input type="text" name="last-name" value="">
                </div>
                <div class="input-field required required-input validate-text">
                    <label>Telefon<span class="required-star">*</span></label>
                    <input type="phone" name="phone" value="">
                </div>
                <div class="input-field required required-input validate-email">
                    <label>E-post<span class="required-star">*</span></label>
                    <input type="email" name="email" value="">
                </div>
                <div class="input-field required required-input validate-text">
                    <label>Adresse<span class="required-star">*</span></label>
                    <input type="text" name="address" value="">
                </div>
                <div class="input-field required required-input validate-text">
                    <label>By<span class="required-star">*</span></label>
                    <input type="text" name="city" value="">
                </div>
                <div class="input-field required required-input validate-text">
                    <label>Postnummer<span class="required-star">*</span></label>
                    <input type="text" name="postal" value="">
                </div>
                <div class="input-field required required-select validate-select">
                    <label>Land<span class="required-star">*</span></label>
                    <select  name="country">
                        <!-- <option value="">Choose</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
                        <option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Curaçao">Curaçao</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-Bissau">Guinea-Bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libya">Libya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option> -->
                        <option value="Norway">Norway</option>
                        <!-- <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Réunion">Réunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Barthélemy">Saint Barthélemy</option>
                        <option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                        <option value="South Sudan">South Sudan</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option> -->
                        <!-- <option value="Switzerland">Switzerland</option> -->
                        <!-- <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-Leste">Timor-Leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option> -->
                    </select>

                    <script type="text/javascript">
                        $("select[name='country'] option").each(function(){
                            $(this).val($(this).html());
                        });
                    </script>
                    <span class="select-icon"></span>
                </div>
                <div class="input-field required required-select validate-select">
                    <label>Velg størrelse<span class="required-star">*</span></label>
                    <select name="size">
                        <option value="">Velg</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                    <span class="select-icon"></span>
                </div>
               <!--  <div class="input-field required required-select validate-select">
                    <label>Select quantity<span class="required-star">*</span></label>
                    <select name="quantity">
                    <option value="">Choose</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <span class="select-icon"></span>
                </div> -->
                <div class="input-field required required-input validate-text">
                    <label>Antall<span class="required-star">*</span></label>
                    <input type="text" name="quantity" value="">
                </div>
                <div class="checkbox-field printing-checkbox">
                    <label>
                        <span class="checkbox-icon"></span>
                        <span class="label">Trykk</span> <!-- (+25 EUR) -->
                        <input class="hidden" type="checkbox" name="print">
                    </label>
                </div>
                <div class="printing-expand">
                    <div class="input-field">
                        <label>Nummer</label>
                        <select name="number">
                            <option value="">Velg</option>
                        </select>
                        <script type="text/javascript">
                            for(var i=0;i<=99;i++){
                                $("select[name='number']").append('<option value="'+i+'">'+i+'</option>');
                            }
                        </script>
                        <span class="select-icon"></span>
                    </div>
                    <div class="input-field">
                        <label>Navn </label>
                        <input type="text" name="print-name" value="">
                    </div>
                </div>
                <div class="input-field">
                    <label>Kommentarer</label>
                    <textarea name="comments"></textarea>
                </div>

                <div class="total-wrap" data-main-price="469">
                    <!-- &euro; -->
                    <p class="total-block">TOTALT: <span class="total">3699</span>&nbsp;NOK</p>
                    <a href="#" class="order-button blue-button">Gå til Kassen</a>
                    <p class="form-note">* - Obligatoriske felt</p>
                </div>

                <div class="form-alert-note ">
                    <p>Please ﬁll all required ﬁelds</p>
                </div>
                <input type="hidden" name="act" value="order" >

                <input type="hidden" name="c_uniform" value="" >
                <input type="hidden" name="c_design" value="" >
                <input type="hidden" name="c_shoulder" value="" >
                <input type="hidden" name="c_arms" value="" >
                <input type="hidden" name="c_logo_line" value="" >
                <input type="hidden" name="c_logo_1" value="" >
                <input type="hidden" name="c_logo_2" value="" >
                <input type="hidden" name="c_logo_3" value="" >
                <input type="hidden" name="c_logo_4" value="" >
                <input type="hidden" name="c_waist" value="" >
                <input type="hidden" name="c_lines" value="" >
                <input type="hidden" name="c_inner_tights" value="" >
                <input type="hidden" name="c_tights" value="" >
                <input type="hidden" name="c_shins" value="" >

                <input type="hidden" name="c_shins_2" value="" >
                <input type="hidden" name="c_shins_3" value="" >
                <input type="hidden" name="c_jersey" value="" >
                <input type="hidden" name="c_jersey_2" value="" >
                <input type="hidden" name="c_arms_2" value="" >

                <input type="hidden" name="c_elbow_armpit" value="" >

                <input type="hidden" name="total_price" value="" >

                <input type="hidden" name="custom_session_id" value="<?php echo($custom_session_id); ?>" >

            </form>
        </div><div class="customizer-sidebar">

          	<?php require_once("sidebar-uniform-1.php"); ?>
            <?php require_once("sidebar-uniform-2.php"); ?>
            <?php require_once("sidebar-uniform-3.php"); ?>

            <div class="total-wrap">
                <!-- &euro; -->
                <p class="total-block">TOTALT: <span class="total"></span>&nbsp;NOK</p>
                <a href="#" class="next-button blue-button">Neste</a>
            </div>
        </div>

        <style>

                    /* Top */
                    /*.sleeve { fill: green; }
                    .chest { fill: orange; }
                    .sleeve-accent-1 { fill: violet; }
                    .sleeve-accent-2 { fill: pink; }
                    .chest-accent-1 { fill: teal; }
                    .chest-accent-2 { fill: blue; }
                    .shirt-logo { fill: red; }*/

                    /* Bottom Back */
                   /* .pants-peace-1 { fill: green; }
                    .pants-peace-2 { fill: violet; }
                    .pants-peace-3 { fill: red; }
                    .pants-peace-4 { fill: orange; }
                    .pants-peace-5 { fill: teal; }
                    .pants-peace-6 { fill: purple; }
                    .pants-peace-7 { fill: yellow; }
                    .pants-back-logo { fill: brown; }*/

                    /* Bottom Front */

                   /* .knees { fill: green; }
                    .pants-peace-8 { fill: lime; }
                    .pants-peace-9 { fill: darkblue; }
                    .pants-peace-10 { fill: yellow; }
                    .pants-peace-11 { fill: red; }
                    .pants-peace-12 { fill: orange; }
                    .pants-front-logo { fill: hotpink; }*/

                    </style>

    </div>
</main>

<div class="popup ">
    
    <div class="accepted-popup ">
        <div class="center">
            <img class="pop-logo" src="./assets/img/check-logo.svg">
            <p class="title">Takk, din bestilling er motatt!</p>
            <p class="text">Du får ordre og betalings informasjon via mail.</p>
            <!-- <a href="/">Tilbake til startsiden </a> -->
        </div>
    </div>
    <div class="loading-popup">
        <div class="spinner">
          <div class="double-bounce1"></div>
          <div class="double-bounce2"></div>
        </div>
    </div>
</div>


<style type="text/css">
    .uniform-svg.hidden{
        display: none;
    }
    .uniform-parts-list.hidden{
        display: none;
    }
</style>

</body>
</html>