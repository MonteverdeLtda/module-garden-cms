<body class="login">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>
		
		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form action="<?php echo $helper->url("Login","login"); ?>" method="post">
						<h2><?php echo $title; ?></h2>
						<p><?php echo $description; ?></p>
						
						<div>
							<input class="form-control" name="username" type="text" value="" required autocomplete="off" />
						</div>
						<div>
							<input class="form-control" name="password" type="password"  Placeholder="Tu contraseña" required />
						</div>
						<div>
							<span style="width:48%; text-align:left;  display: inline-block;">
								<a class="small-text" href="#">
									
								</a>
							</span>
							<span style="width:50%; text-align:right;  display: inline-block;">
							</span>
						</div>
						
						
						
						<div>
							<input type="hidden" name="controller" value="Login">
							<input type="hidden" name="view" value="login">
							<input type="submit" value="Continuar" class="btn btn-default">
							<a class="reset_pass" href="#">Olvidaste tu contraseña?</a>
						</div>
						<div class="clearfix"></div>
						<div class="separator">
							<p class="change_link">
								¿Nuevo en Monteverde?
								<a href="#register" class="to_register"> Crear Cuenta</a>
							</p>
							<div class="clearfix"></div>
							<br />
							<div>
								<h1>Servicios Ambientales y Forestales Monteverde LTDA</h1>
								<p>
									CMS | Developer by <a href="https://github.com/Feliphegomez">FelipheGomez</a>
								</p>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>