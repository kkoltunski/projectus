{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Login</h3>
	<hr>

	<form action="{$conf->action_url}login" method="post">
		<div class="top-margin">
			<label>PESEL</label>
			<input type="text" class="form-control" name="pesel">
		</div>
		<div class="top-margin">
			<label>Hasło</label>
			<input type="password" class="form-control" name="pass">
		</div>
		<hr>

		<div class="row">
			<p style="color: rgb(255,0,0)">Skontaktuj się z nami jeśli zapomniałeś danych logowania.</p>
			<div class="col-lg-4 text-right">
				<button class="btn btn-action" type="submit">Login</button>
			</div>
		</div>
	</form>
</div>

{/block}