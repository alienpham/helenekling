function jelix_wymeditor_default(textarea_id,form_id){jQuery(function(){jQuery("#"+textarea_id).wymeditor({styles:                                                            
      '/* PARA: Signature */                                              '+
      '.signature p{                                                      '+
      ' /* font-weight:bold; font-style: italic */                        '+
      '  '+
      '}',updateSelector:"#"+form_id,updateEvent:'jFormsUpdateFields'})})}