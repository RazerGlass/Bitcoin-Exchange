<script src="<?php echo URL;?>js/imgverify.js"></script>
<style>
#noerror {
  color: green;
  text-align: left
}
#error {
  color: red;
  text-align: left
}
#img {
  width: 17px;
  border: none;
  height: 17px;
  margin-left: -20px;
  margin-bottom: 91px
}
.abcd {
  text-align: center
}
.abcd img {
  height: 100px;
  width: 100px;
  padding: 5px;
  border: 1px solid #e8debd
}
</style>
<div class="panel panel-default panel-body col-xs-12 col-md-7">
  <div class="panel-heading">
    <h3 class="panel-title">
 <?php _ex("User Verification form"); ?>
 </h3>
  </div>
  <div class="panel-body col-xs-12 col-md-12">

    <div class="row">

        <div class="alert alert-default">
          <button class="close" data-dismiss="alert" type="button"><span>×</span> <span class="sr-only">Close</span>
          </button>
          <?php _ex( "Upload a valid form of
 identification. Driving licenses, passports, Government
 Issued ID's"); ?>
        </div>
        <div class="panel panel-default">
          <div class="panel-body">
            <form action="<?php echo URL;?>user/veridetails" class="validate" method="post" novalidate="novalidate" enctype="multipart/form-data">
              <div class="row col-margin">
                <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon linecons-user" style="font-style: italic">
                    </div>
                    <input class="form-control" data-message-required="Please enter your First Name" data-validate="required" name="firstname" placeholder="<?php _ex(" First Name "); ?>" type="text">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="input-group">
                    <div class="input-group-addon linecons-user" style="font-style: italic">
                    </div>
                    <input class="form-control" data-message-required="Please enter your Last Name" data-validate="required" name="lastname" placeholder="<?php _ex(" Last Name "); ?>" type="text">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon linecons-shop" style="font-style: italic">
                      </div>
                      <input class="form-control" data-validate="required" id="address" name="address" placeholder="<?php _ex(" Address line 1 ");?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon linecons-shop" style="font-style: italic">
                      </div>
                      <input class="form-control" data-validate="required" id="address" name="address2" placeholder="<?php _ex(" Address line 2 ");?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon linecons-shop" style="font-style: italic">
                      </div>
                      <input class="form-control" data-validate="required" id="address" name="city" placeholder="<?php _ex(" City ");?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon linecons-lock" style="font-style: italic">
                      </div>
                      <input class="form-control" data-validate="required" id="address" name="zipcode" placeholder="<?php _ex(" Postal Code ");?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon linecons-lock" style="font-style: italic">
                      </div>
                      <input class="form-control" data-validate="required" id="address" name="state" placeholder="<?php _ex(" State/Provinince ");?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">

<div class="form-group">
									<script type="text/javascript">
										jQuery(document).ready(function($)
										{
											$("#sboxit-2").selectBoxIt({
												showFirstOption: false
											}).on('open', function()
											{
												// Adding Custom Scrollbar
												$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
											});
										});
									</script>
									
									<select class="form-control" data-validate="required" name="country" id="sboxit-2">
										<option>Select your country</option>
<option value="Afghanistan">Afghanistan</option> 
<option value="Åland Islands">Åland Islands</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="American Samoa">American Samoa</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Anguilla">Anguilla</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option> 
<option value="Aruba">Aruba</option> 
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option> 
<option value="Azerbaijan">Azerbaijan</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Bahamas">Bahamas</option> 
<option value="Bahrain">Bahrain</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bermuda">Bermuda</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Brazil">Brazil</option> 
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
<option value="British Virgin Islands">British Virgin Islands</option> 
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burma">Burma</option> 
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
<option value="Congo-Brazzaville">Congo-Brazzaville</option> 
<option value="Congo-Kinshasa">Congo-Kinshasa</option> 
<option value="Cook Islands">Cook Islands</option> 
<option value="Costa Rica">Costa Rica</option> 
<option value="Croatia">Croatia</option> 
<option value="Curaçao">Curaçao</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="East Timor">East Timor</option> <option value="Ecuador">Ecuador</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Egypt">Egypt</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Falkland Islands">Falkland Islands</option> 
<option value="Faroe Islands">Faroe Islands</option> 
<option value="Federated States of Micronesia">Federated States of Micronesia</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option> 
<option value="French Guiana">French Guiana</option> 
<option value="French Polynesia">French Polynesia</option> 
<option value="French Southern Lands">French Southern Lands</option> 
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
<option value="Heard and McDonald Islands">Heard and McDonald Islands</option> 
<option value="Honduras">Honduras</option> 
<option value="Hong Kong">Hong Kong</option> 
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
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
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Laos">Laos</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libya">Libya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macau">Macau</option> 
<option value="Macedonia">Macedonia</option> 
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
<option value="Moldova">Moldova</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montenegro">Montenegro</option> 
<option value="Montserrat">Montserrat</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
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
<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option> 
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option> 
<option value="Pitcairn Islands">Pitcairn Islands</option> 
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option> 
<option value="Puerto Rico">Puerto Rico</option> 
<option value="Qatar">Qatar</option> 
<option value="Réunion">Réunion</option> 
<option value="Romania">Romania</option> 
<option value="Russia">Russia</option> 
<option value="Rwanda">Rwanda</option> 
<option value="Saint Barthélemy">Saint Barthélemy</option> 
<option value="Saint Helena">Saint Helena</option> 
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option> 
<option value="Saint Martin">Saint Martin</option> 
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
<option value="Saint Vincent">Saint Vincent</option> 
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="São Tomé and Príncipe">São Tomé and Príncipe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia">Serbia</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Sint Maarten">Sint Maarten</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Georgia">South Georgia</option> 
<option value="South Korea">South Korea</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
<option value="Sweden">Sweden</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syria">Syria</option> 
<option value="Taiwan">Taiwan</option> 
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania">Tanzania</option> 
<option value="Thailand">Thailand</option> 
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
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Vatican City">Vatican City</option> 
<option value="Vietnam">Vietnam</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Wallis and Futuna">Wallis and Futuna</option> 
<option value="Western Sahara">Western Sahara</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option> 
									</select>
			                      </div>	
								</div>

                  <div class="col-xs-12 col-sm-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <a href="#"><i class="linecons-calendar"></i></a>
                      </div>
                      <input type="text" data-validate="required" placeholder="<?php _ex(" Date of birth "); ?>" class="form-control datepicker" data-format="D, dd MM yyyy">
                    </div>
                  </div>
                </div>
				</div>
              </div>
            <div class="panel-body">
            <div id="filediv">
              <input name="file[]" type="file" id="file" />
            </div>
            <br/><input type="button" id="add_more" class="upload btn btn-info" value="Add More Files" />
            <input type="submit" value="Validate Information"  class="btn btn-success"  data-message-required="Please select your identification" data-validate="required" name="submit" id="upload" class="upload" />
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12 col-md-12 col-lg-5"> 
	<div class="well well-small">
	<p class="lead"><?php _ex("How to verify"); ?></p>
		<ul class="media-list">
			<li class="media">
				<a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">1</a>
				<div class="media-body">
					<p class="lead" style="margin-top:10px"><?php _ex("Fill out our form"); ?></p>
					<p>
						<?php _ex("All inputs must be filled out. All information must be correct. Once you have submitted your verification information a member of our team will verify the details and either accept or decline. If your verification is declined a member of our team will contact you with the next steps"); ?>
					</p>
				</div>
			</li>
			<li class="media">
				<a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">2</a>

				<div class="media-body">
					<p class="lead" style="margin-top:10px"><?php _ex("2 Documents must be supplied"); ?></p>
					<p>
					
							<?php _ex("A valid passport or national ID"); ?></p>
							<p>
							<?php _ex("Please supply a recent (no older than 3 months old) bank statement, utility bill or valid proof of address document. The information must be clear (we recommend a scanned document.)"); ?>
							</p>
							<p>
						<h5><?php _ex("Document Requirements"); ?></h5>
		<ul>
							<li><?php _ex("No larger than 10MB"); ?></li>
							<li><?php _ex("JPEG,PNG,JPG,PDF"); ?></li>
							<li><?php _ex("Must be scanned, no screenshots or phone pictures"); ?></li>
						</ul>
					</p>
					
				</div>
			</li>
						<li class="media">
				<a href="#" class="btn btn-default btn-circle btn-lg pull-left" style="margin:0 10px 0 0; font-size:20px;" disabled="">3</a>

				<div class="media-body">
					<p class="lead" style="margin-top:10px"><?php _ex("Click the 'validate information' button"); ?></p>
				</div>
			</li>
		</ul>
	</div>
</div>
</div>
</div>
</div>
