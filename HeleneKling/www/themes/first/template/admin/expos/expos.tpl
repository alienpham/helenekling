<h1>{TITRE} d'une oeuvre</h1>
<!-- BEGIN error -->
{error.ERROR}
<!-- END error --> 
	<form action="index.php?do=paint&amp;p={ACTION}" method="post" class="css" id="form_ajout" >
		<fieldset>
			<p class="field"><label for="c_nom">Intitulé&nbsp;*</label>
				<input name="c_nom" id="c_nom" type="text" size="60" maxlength="255" value="{INTITULE}" />
			</p>
	
			<p class="field"><label for="c_type">Type d'evènement&nbsp;</label>
				<input name="c_type" id="c_type" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>
				
			<p class="field"><label for="adresse">Adresse&nbsp;</label>
				<input name="adresse" id="adresse" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>	
			
			<p class="field"><label for="date_deb">Date de début&nbsp;</label>
				<input name="date_deb" id="date_deb" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>
			
			<p class="field"><label for="date_fin">Date de fin&nbsp;</label>
				<input name="date_fin" id="date_fin" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>
			
			<p class="field"><label for="theme">Thème&nbsp;</label>
				<input name="theme" id="theme" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>
			
			<p class="field"><label for="c_img">Flyer&nbsp;</label>
				<input name="c_img" id="c_img" type="text" size="60" maxlength="255" value="{IMG}" readonly/>
			</p>
			
			<div id="apercu" ></div> 	
			
			<p><a href="#" onclick="popup('./library/admin/images-popup.php');">Parcourir le serveur</a></p>
			<p><input type="submit" name="envoyer" class="submit" value="Valider" /></p>
		</fieldset>	
	</form>