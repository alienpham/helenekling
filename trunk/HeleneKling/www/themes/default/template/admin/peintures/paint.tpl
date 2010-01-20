<h1>{TITRE} d'une oeuvre</h1>
<!-- BEGIN error -->
{error.ERROR}
<!-- END error --> 
	<form action="index.php?do=paint&amp;p={ACTION}" method="post" id="form_ajout" >
		<fieldset>
			<p class="field"><label for="c_nom">Intitulé&nbsp;*</label>
			<input name="c_nom" id="c_nom" type="text" size="60" maxlength="255" value="{INTITULE}" />
			</p>
	
			<p class="field"><label for="c_prix">Prix&nbsp;</label>
			<input name="c_prix" id="c_prix" type="text" size="60" maxlength="255" value="{PRIX}" />
			</p>
				
			<p class="field"><label for="c_img">Image&nbsp;</label>
			<input name="c_img" id="c_img" type="text" size="60" maxlength="255" value="{IMG}" readonly />
			</p>

			<div id="apercu" ></div> 		
				
			<p><a href="#" onclick="popup('./library/admin/images-popup.php');">Parcourir le serveur</a></p>
			<p><input type="submit" name="envoyer" class="submit" value="Valider" /></p>
		</fieldset>	
	</form>