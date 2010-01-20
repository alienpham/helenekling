{if $id === null}

<h1>{@NewsLetter~news.signup@}</h1>
{formfull $form, $submitAction}

{else}

<h1>{@jelix~crud.title.update@}</h1>
{formfull $form, $submitAction, array('id'=>$id)}

{/if}
