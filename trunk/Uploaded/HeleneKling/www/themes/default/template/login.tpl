<!-- BEGIN error_login -->
{error_login.ERROR}
<!-- END error_login --> 

<form action="index.php" method="post" id="form_auth" onsubmit="javascript: return login();">

<div class="login">
 <p>Identifiant</p>
 <p><input name="utilisateur" id="utilisateur" type="text" value="-- login --" onfocus="if(this.value=='-- login --') {this.value='';}"/></p>

 <p>Mot de Passe</p>
 <p><input name="motdepasse" id="motdepasse" type="password"/></p>

 <p><input class="submit" type="submit" name="envoyer" value="Identifier"/></p>
</div>

</form>
