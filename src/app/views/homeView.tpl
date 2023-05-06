{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<form action="{$conf->action_url}searchFromHome" method="post">
		<h3 class="thin text-center">Nasze specjalizacje</h3>
		<hr>
		<div class="menu-container">
    		<div class="button-container">
				{if !empty($facilitiesSpecializations)}
            		{foreach $facilitiesSpecializations as $specialization}
        				<div class="action-container">
            				<button class="btn btn-action" style="float: left" type="submit" name="buttonValue" value="{$specialization}">{$specialization}</button>
        				</div>
            		{/foreach}
        		{/if}		
    		</div>
		</div>
		<hr>
	</form>
</div>

{/block}