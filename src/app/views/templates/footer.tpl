<div class="footer2 top-space">
	<div class="container">
		<div class="row">

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="simplenav">
						<a href="#">Góra strony</a> |
						<b><a href="{$conf->action_url}homeShow">Główna</a></b> |

						{if !\core\RoleUtils::inRole('admin')}
							<b><a href="{$conf->action_url}searchShow">Wyszukaj</a></b> |
						{/if}

						{if \core\RoleUtils::inRole('user') or \core\RoleUtils::inRole('admin')}
							<b><a href="{$conf->action_url}appointments">Wizyty</a></b> |
							<b><a href="{$conf->action_url}logout">Wyloguj</a></b>
						{else}
							<b><a href="{$conf->action_url}registrationShow">Zarejestruj</a></b> |
							<b><a href="{$conf->action_url}loginShow">Zaloguj</a></b>
						{/if}
					</p>
				</div>
			</div>

			<div class="col-md-6 widget">
				<div class="widget-body">
					<p class="text-right">
						Copyright &copy; 2023, Klaudiusz Kołtuński, Mateusz Ratajczak
					</p>
				</div>
			</div>

		</div>
	</div>
</div>