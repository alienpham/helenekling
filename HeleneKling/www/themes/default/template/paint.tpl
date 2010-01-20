<h1>{TITLE}</h1>
<p><u>Tarif</u> : {PRIX} &euro;</p>
<p><img class="photo" src="{SRC}" /></p>

<!-- BEGIN id_prec -->
<p class="left">
	<a href="index.php?do=show_paint&amp;id={id_prec.ID_PREC}&amp;lim={LIM_PREC}"><img src="./images/interface/rewind.png" /></a>
	<a href="index.php?do=paint_list&amp;lim={LIM_RETOUR}"><img src="./images/interface/home.png" /></a>
</p>
<!-- END id_prec  -->

<!-- BEGIN id_suiv -->
<p class="right">
	<a href="index.php?do=show_paint&amp;id={id_suiv.ID_SUIV}&amp;lim={LIM}"><img src="./images/interface/forward.png" /></a>
</p>
<!-- END id_suiv  -->