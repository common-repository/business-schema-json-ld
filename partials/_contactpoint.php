<?php

function BSJL_render_contact_point($settings_name, $organization_contact, $contact_value = array(), $point_id = 0) {
  $telephone = isset($contact_value['telephone']) ? $contact_value['telephone'] : "" ;
  $contact_type = isset($contact_value['contactType']) ? $contact_value['contactType'] : "" ;
  $contact_option = isset($contact_value['contactOption']) ? $contact_value['contactOption'] : "" ;
  $area_served = isset($contact_value['areaServed']) ? $contact_value['areaServed'] : "" ;
  $available_language = isset($contact_value['availableLanguage']) ? $contact_value['availableLanguage'] : "" ;
?>
  <div class="bs-contact-point" style="border-bottom: 1px dashed grey; width: 50%;">
    <br />
    <label for="">Telephone:</label>
    <input type='text' size="50" name='<?php echo $settings_name . "[" . $organization_contact . "][" . $point_id . "][telephone]";?>' value="<?php echo esc_attr($telephone); ?>" required>
    <br/>
    
    <label for="">contactType:</label>
    <select name='<?php echo $settings_name . "[" . $organization_contact . "][" . $point_id . "][contactType]";?>' required>
      <option value>Please pick one.</option>
      <option value="customer support" <?php selected($contact_type, "customer support");?>>customer support</option>
      <option value="technical support" <?php selected($contact_type, "technical support");?>>technical support </option>
      <option value="billing support" <?php selected($contact_type, "billing support");?>>billing support</option>
      <option value="bill payment" <?php selected($contact_type, "bill payment");?>>bill payment</option>
      <option value="sales" <?php selected($contact_type, "sales");?>>sales</option>
      <option value="reservations" <?php selected($contact_type, "reservations");?>>reservations</option>
      <option value="credit card support" <?php selected($contact_type, "credit card support");?>>credit card support</option>
      <option value="emergency" <?php selected($contact_type, "emergency");?>>emergency</option>
      <option value="baggage tracking" <?php selected($contact_type, "baggage tracking");?>>baggage tracking</option>
      <option value="roadside assistance" <?php selected($contact_type, "roadside assistance");?>>roadside assistance</option>
      <option value="package tracking" <?php selected($contact_type, "package tracking");?>>package tracking</option>
    </select>
     <br />
     
     <label for="">contactOption:</label>
     <select name='<?php echo $settings_name . "[" . $organization_contact . "][" . $point_id . "][contactOption]";?>'>
       <option value>None</option>
       <option value="TollFree" <?php selected($contact_option, "TollFree");?>>TollFree</option>
       <option value="HearingImpairedSupported" <?php selected($contact_option, "HearingImpairedSupported");?>>HearingImpairedSupported</option>
     </select> 
     <br />

     <label for="">areaServed:</label>
     <input type="text" size=50 name="<?php echo $settings_name . "[" . $organization_contact . "][" . $point_id . "][areaServed]";?>" value="<?php echo esc_attr($area_served); ?>" placeholder='example: "US", "GB"'>

     <br />
     <label for="">availableLanguage:</label>
     <input type="text" size=50 name='<?php echo $settings_name . "[" . $organization_contact . "][" . $point_id . "][availableLanguage]";?>' value="<?php echo esc_attr($available_language); ?>" placeholder='example: English, Spanish'>

     <button type="button" onclick="BusinessSchema.addContactPoint(this)">Add New Contact Point</button>
     <button type="button" onclick="BusinessSchema.removeContactPoint(this)" style="margin: 2rem;">Remove</button>
  </div>
<?php
}