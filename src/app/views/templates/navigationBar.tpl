{assign var=inRoleAdmin value=\core\RoleUtils::inRole('admin') nocache}
{assign var=inRoleUser value=\core\RoleUtils::inRole('user') nocache}

<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav pull-right">    
        <li class="active"><a href="#">TOP</a></li>
        <li class="active"><a href="{$conf->action_url}homeShow">Główna</a></li>

        {if !$inRoleAdmin}
            <li class="active"><a href="{$conf->action_url}searchShow">Wyszukaj</a></li>
        {/if}

        {if $inRoleUser or $inRoleAdmin}
            <li class="active"><a href="{$conf->action_url}appointments">Wizyty</a></li>
            <li><a class="btn" href="{$conf->action_url}logout">Wyloguj</a></li>
        {else}
			<li class="active"><a href="{$conf->action_url}registrationShow">Zarejestruj</a></li>
    		<li><a class="btn" href="{$conf->action_url}loginShow">Zaloguj</a></li>
		{/if}		
	</ul>
</div>