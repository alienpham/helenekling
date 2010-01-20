<div class="event">
<div style="min-height:160px;margin: 20px 0px 0px 0px">
		<h1>{$record->name}</h1>
		<div style="float:right;margin: 20px 0px 0px 0px;border:1px solid #ccc;max-width:200px">
			<table style="padding:5px 5px 5px 5px;">
				<tr>
					<td><b>{@events.opening@}</b></td>
					<td>:</td> 
					<td>{$record->date_debut}</td>
				</tr>
				<tr>
					<td><b>{@events.closing@}</b></td>
					<td>:</td>
					<td>{$record->date_fin}</td>
				</tr>
				<tr>
					<td><b>{@events.horaires@}</b></td>
					<td>:</td> 
					<td>{$record->horaires}</td>
				</tr>
				<tr>
					<td><b>{@events.adresse@}</b></td> 
					<td>:</td>
					<td><a href="http://maps.google.fr/?q={$record->adresse}">{$record->adresse}</a></td>
				</tr>
				<tr>
					<td><b>{@events.else@}</b></td> 
					<td>:</td>
					<td><a href="../../../flyers/{$record->flyer}">{@events.flyer@}</a></td>
				</tr>
			</table>
		</div>
		<div>
			{$record->description}
		</div>
	</div>
	{ifconnected}
			<div class="option"><ul>
				<li>
					<a href="{jurl $editAction,array('id'=>$record->id)}">{@jelix~crud.link.edit.record@}</a>
				</li>
				<li>
					<a href="{jurl $deleteAction, array('id'=>$record->id)}" class="crud-link" onclick="return confirm('{@jelix~crud.confirm.deletion@}')">{@jelix~crud.link.delete.record@}</a>
				</li>
				
			</ul></div>	
	{/ifconnected}
</div>