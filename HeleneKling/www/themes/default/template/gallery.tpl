<h1>Les oeuvres d'art</h1>

<table>
<!-- BEGIN paint -->
<tr>
	<td><a href="index.php?do=show_paint&amp;id={paint.PAINT_ID_PHOTO}&amp;lim={paint.LIM}"><img class="paint" src="{paint.PAINT_IMG}" /></td>
	<td>
		<h2>{paint.PAINT_TITLE}</h2>
		<p><u>Tarif</u> : {paint.PAINT_PRICE} &euro;</p>
	</td>
</tr>
<!-- BEGIN switch_user_logged_in -->
<tr>
	<td>
		<p><a href="index.php?do=paint&amp;p=mod&amp;id={paint.PAINT_ID}" ><img src="./images/interface/write.png" />modifier</a><a href="index.php?do=paint&amp;p=del&amp;id={paint.PAINT_ID}" onclick="javascript:deletePaint({paint.PAINT_ID})" ><img src="./images/interface/delete.png" />Supprimer/Vendue</a></p>
	</td>
	</tr>
<!-- END switch_user_logged_in --> 

<!-- END paint -->
</table>

<!-- BEGIN limite_prec -->
<p class="left"><a href="index.php?do=paint_list&amp;lim={limite_prec.LIMITE_PREC}"><img src="./images/interface/rewind.png" /></a></p>
<!-- END limite_prec -->

<!-- BEGIN limite_suiv -->
<p class="right"><a href="index.php?do=paint_list&amp;lim={limite_suiv.LIMITE_SUIV}"><img src="./images/interface/forward.png" /></a></p>
<!-- END limite_suiv  -->