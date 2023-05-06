{extends file='main.tpl'}

{block name=content}

<div class="panel-body">
	<h3 class="thin text-center">Rejestracja</h3>
	<p class="text-center text-muted">Zarejestruj się by zostać pacjentem.</p>
	<hr>

	<form action="{$conf->action_url}registration" method="post">
		<div class="top-margin">
			<label>PESEL <span class="text-danger">*</span></label>
		<input type="text" class="form-control" name="pesel">
		</div>
		<div class="top-margin">
			<label>Imie <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="name">
		</div>
		<div class="top-margin">
			<label>Nazwisko <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="surname">
		</div>
		<div class="top-margin">
			<label>Hasło <span class="text-danger">*</span></label>
			<input type="password" class="form-control" name="pass1">
		</div>
		<div class="top-margin">
			<label>Powtórz hasło <span class="text-danger">*</span></label>
			<input type="password" class="form-control" name="pass2">
		</div>
		<div class="top-margin">
			<label>Email <span class="text-danger">*</span></label>
			<input type="text" class="form-control" name="email">
		</div>
		<div class="top-margin">
			<label>Numer kontaktowy </label>
			<input type="text" class="form-control" name="number">
		</div>
		<hr>

		<div class="row">
			<p style="color: rgb(255,0,0)">Skontaktuj się z nami jeśli zapomniałeś danych logowania.</p>
			<div class="col-lg-4 text-right">
				<button class="btn btn-action" type="submit">Rejestracja</button>
			</div>
		</div>
	</form>
</div>

{/block}