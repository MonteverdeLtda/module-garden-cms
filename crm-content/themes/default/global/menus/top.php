<?php if(isset($_SESSION['user'])){ ?>
<div class="nav_menu">
	<nav>
		<div class="nav toggle">
			<a id="menu_toggle"><i class="fa fa-bars"></i></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li class="">
				<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<img src="images/img.jpg" alt=""><?php echo $this->getUserNames(); ?>
					<span class=" fa fa-angle-down"></span>
				</a>
				<ul class="dropdown-menu dropdown-usermenu pull-right">
					<li><a href="<?php echo $this->linkUrl('Usuarios', 'mi_perfil'); ?>"> Mi Cuenta</a></li>
					<!-- //
					<li>
						<a href="<?php echo $this->linkUrl('Usuarios', 'settings'); ?>">
							<span class="badge bg-red pull-right">50%</span>
							<span>Settings</span>
						</a>
					</li>
					-->
					<li>
						<a data-toggle="tooltip" data-placement="top" title="Salir">
							<form method="POST" action="/logout">
								<button style="background-color: transparent;border: 0px;" type="submit"><i class="fa fa-sign-out pull-right"></i>Cerrar Sesion</button>
							</form>
						</a>
					</li>
					<a  href="#"></a>
				</ul>
			</li>
			
		</ul>
	</nav>
</div>
<?php } ?>