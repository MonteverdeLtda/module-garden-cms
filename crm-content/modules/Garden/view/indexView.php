<div class="" id="app">
	<div class="page-title">
		<div class="title_left">
			<h3>Libro Verde <small>Catálogo de plantas y más.</small></h3>
		</div>
		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="input-group">
					<router-link class="btn btn-default btn-sm" :to="{ name: 'Garden-Create' }" tag="a">
						<span data-toggle="tooltip" data-placement="bottom" title="Crear">
							<i class="glyphicon glyphicon-plus"></i>
						</span>
					</router-link>
					<router-link class="btn btn-default btn-sm" :to="{ name: 'Garden-List' }" tag="a">
						<span data-toggle="tooltip" data-placement="bottom" title="Listado">
							<i class="glyphicon glyphicon-list-alt"></i>
						</span>
					</router-link>
					
					<!-- //
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
					-->
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	
	<div class="x_panel">
		<div class="x_content">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<router-view :key="$route.fullPath" ></router-view>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<template id="garden-list">
	<div>
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Listado</h3>
				</div>

				<div class="title_right">
					<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
						<div class="input-group">
							<input @change="getSearch" v-model="searchText" type="text" class="form-control" placeholder="Search for...">
							<span class="input-group-btn">
								<button @click="getSearch" class="btn btn-default" type="button">Buscar</button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="x_panel">
						<div class="x_content">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 text-center">
									<ul class="pagination pagination-split">
										<router-link :to="{ name: 'Garden-Filter-Letter', params: { letter_text: letter }}" tag="li" :key="letter" v-for="letter in letters_list">
											<a>{{ letter.toUpperCase() }}</a>
										</router-link>
									</ul>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12 text-center">
									<p v-if="$route.params.letter_text != undefined">
										Filtrando por letra: {{ $route.params.letter_text }}
										<router-link :to="{ name: 'Garden-List' }" tag="a" class="btn btn-default btn-sm">
											Borrar filtro
										</router-link>
									</p>
									<p v-else-if="$route.params.search_text != undefined">
										Buscando: {{ $route.params.search_text }}
										<router-link :to="{ name: 'Garden-List' }" tag="a" class="btn btn-default btn-sm">
											Borrar filtro
										</router-link>
									</p>
									<p v-else-if="$route.params.value_text != undefined">
										Filtrando por campo: {{ $route.params.value_text }}
										<router-link :to="{ name: 'Garden-List' }" tag="a" class="btn btn-default btn-sm">
											Borrar filtro
										</router-link>
									</p>
								</div>
								<div class="clearfix"></div>
								
								<p v-if="records===null">Cargando...</p>
								<template v-else>
									<div class="col-md-4 col-sm-6 col-xs-12 profile_details" v-for="record in records">
										<div class="well profile_view">
											<div class="col-sm-12">
												<h4 class="brief" data-toggle="tooltip" data-placement="bottom" title="Nombre botánico aceptado"><i>{{ record.name_botanico }}</i></h4>
												<div class="left col-xs-7">
													<h2 data-toggle="tooltip" data-placement="bottom" title="Nombre comercial">{{ record.name_comercial }}</h2>
													<p>
														<strong data-toggle="tooltip" data-placement="bottom" title="Nombre común primario">{{ record.name_comun }}  </strong> 
														<span v-for="a in record.garden_comun_names">{{ a.name }} </span>
													</p>
													
												</div>
												<div class="right col-xs-5 text-center">
													<img :src="'/index.php?controller=Sistema&action=picture&id=' + record.picture + '&w=175'" alt="" class="img-circle img-responsive">
												</div>
											</div>
											<div class="col-xs-12 bottom text-center">
												<div class="col-xs-12 col-sm-6 emphasis">
													<!-- //
													<p class="ratings">
														<a>4.0</a>
														<a href="#"><span class="fa fa-star"></span></a>
														<a href="#"><span class="fa fa-star"></span></a>
														<a href="#"><span class="fa fa-star"></span></a>
														<a href="#"><span class="fa fa-star"></span></a>
														<a href="#"><span class="fa fa-star-o"></span></a>
													</p>
													-->
													<button @click="deleteGarden(record.id)" type="button" class="btn btn-danger btn-sm">
														<i class="fa fa-times"></i>
													</button>
												</div>
												<div class="col-xs-12 col-sm-6 emphasis">
													<router-link :to="{ name: 'Garden-Edit', params: { garden_id: record.id }}" tag="button" type="button" class="btn btn-success btn-sm">
														<i class="fa fa-edit"></i>
													</router-link>
													<router-link :to="{ name: 'Garden-Details', params: { garden_id: record.id }}" tag="button" type="button" class="btn btn-primary btn-sm">
														<i class="fa fa-eye"></i>
													</router-link>
												</div>
											</div>
										</div>
									</div>
								</template>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<template id="garden-details">
	<div>
		<div class="">
			<p v-if="record===null">Cargando...</p>
			<template v-else>
				<div class="page-title">
					<div class="title_left">
						<h3>{{ record.name_botanico }}</h3>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>
									{{ record.name_comun }} 
									<span v-for="a in record.garden_comun_names">- {{ a.name }} </span>
								</h2>
								<div class="clearfix"></div>
							</div>
							<div class="x_content">
								<div class="col-md-7 col-sm-7 col-xs-12">
									<div class="product-image">
										<img :src="'/index.php?controller=Sistema&action=picture&id=' + record.picture + '&w=550'" alt="..." />
									</div>
									<div class="product_gallery">
										<!-- //
										<a>
										<img src="https://garden.org/pics/2015-04-13/Calif_Sue/af62ef.jpg" alt="..." />
										</a>
										<a>
										<img src="https://garden.org/pics/2012-05-01/Calif_Sue/8c7c8e.jpg" alt="..." />
										</a>
										-->
									</div>
								</div>
								
								<div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">
									<h3 class="prod_title" title="Nombre Comercial">{{ record.name_comercial }}</h3>
									<p v-html="record.description"></p>
									
									<p v-if="fields == null">
									</p>
									<template v-else>
										<template v-for="(item) in fields">
											<template v-if="item.type === 'text'">
											  <div class="">
												<h2>{{ item.name }} <small> ({{ item.values.length }})</small></h2>
												
												<ul class="list-inline prod_size">
													<!-- //<li><button type="button" class="btn btn-default btn-xs" v-for="val in item.values">{{ val.value }}</button></li>-->
													
													<router-link :to="{ name: 'Garden-Filter-Fields', params: { value_text: val.value }}" tag="li" :key="val.id" v-for="val in item.values">
														<button type="button" class="btn btn-default btn-xs">{{ val.value.charAt(0).toUpperCase() + val.value.slice(1) }}</button>
													</router-link>
												</ul>
												<!-- //
												<template v-if="item.values.length === 1">
													<table class="table table-responsive">
														<tr>
															<th>{{ item.name }}</th>
															<td>
																<ul>
																	<li v-for="val in item.values">{{ val.value }}</li>
																</ul>
															</td>
														</tr>
													</table>
												</template>
												<template v-else>
													<ul class="list-inline prod_size">
														<li><button type="button" class="btn btn-default btn-xs" v-for="val in item.values">{{ val.value }}</button></li>
													</ul>
												</template>
												-->
											  </div>
											  <!-- //
												-->
												<br />
											</template>
											<template v-else-if="item.type === 'color'">
												<div class="" >
													<h2>{{ item.name }}</h2>
													<ul class="list-inline prod_color">
														<li v-for="val in item.values">
															<p>{{ val.value }}</p>
															<div class="color bg-" :style="'background: ' + val.value + '!important;'"></div>
														</li>
													</ul>
													<br />
												</div>
											</template>
											<template v-else-if="item.type === 'tags'">
												<div class="">
													<h2>{{ item.name }} <small></small></h2>
													<ul class="list-inline prod_size">
														<li v-for="val in item.values"><button type="button" class="btn btn-default btn-sm">{{ val.value }}</button></li>
													</ul>
													<br />
												</div>
											</template>
										</template>
									</template>
									<br />
								</div>
								<!-- // 
								<div class="col-md-12">
									<div class="" role="tabpanel" data-example-id="togglable-tabs">
										<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
											<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a></li>
											<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a></li>
											<li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a></li>
										</ul>
										<div id="myTabContent" class="tab-content">
											<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
												<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher
												synth. Cosby sweater eu banh mi, qui irure terr.</p>
											</div>
											<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
												<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
												booth letterpress, commodo enim craft beer mlkshk aliquip</p>
											</div>
											<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
												<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
												photo booth letterpress, commodo enim craft beer mlkshk </p>
											</div>
										</div>
									</div>
								</div>
								-->
								<div class="col-md-12">
									<div class="col-md-4 pull-right">
										<router-link class="btn btn-default btn-sm" :to="{ name: 'Garden-List' }" tag="a"><h4><i class="glyphicon glyphicon-chevron-left"></i> Regresar</h4> </router-link>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</template>
		</div>
	</div>
</template>

<style scope="garden-edit">
.stepContainer {
	height: auto !important;
	overflow: hidden;
}
</style>
<template id="garden-edit">
	<div>
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Crear / Modificar</h3>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div id="wizard_verticle" class="form_wizard wizard_verticle">
						<ul class="list-unstyled wizard_steps">
							<li>
							  <a href="#step-11">
								<span class="step_no">1</span>
							  </a>
							</li>
							<li>
							  <a href="#step-22">
								<span class="step_no">2</span>
							  </a>
							</li>
							<li>
							  <a href="#step-33">
								<span class="step_no">3</span>
							  </a>
							</li>
						  </ul>

						  <div id="step-11">
							<h2 class="StepTitle"></h2>
							<form class="form-horizontal form-label-left" :on-submit="onFinishCallback" action="javascript:false;">
							  <span class="section">Info Básica</span>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="first-name">Nombre comercial <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6">
										<input type="text" v-model="record.name_comercial" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="first-name">Nombre común primario </label>
									<div class="col-md-6 col-sm-6">
										<input type="text" v-model="record.name_comun" class="form-control col-md-7 col-xs-12">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="first-name">Nombre botánico aceptado </label>
									<div class="col-md-6 col-sm-6">
										<input type="text" v-model="record.name_botanico" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="first-name">Descripcion </label>
									<div class="col-md-6 col-sm-6">
										<textarea v-model="record.description" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3" for="first-name">Imagen Principal </label>
									<div class="col-md-6 col-sm-6">
										<input type="hidden" v-model="record.picture" class="form-control col-md-7 col-xs-12">
										<img :src="getPicture()" alt="Picture">
									</div>
								</div>
							</form>
						
							<div class="form-group cropper">
								<label class="control-label col-md-3 col-sm-3" for="first-name">Subir Imagen </label>
								<div class="col-md-6 col-sm-6">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
										  <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
										  <span class="docs-tooltip" data-toggle="tooltip" title="Subir imagen">
											<span class="fa fa-upload"></span> 
											Subir imagen
										  </span>
										</label>
										<hr>
									</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="row">
										<div class="col-md-9 col-sm-9 col-xs-9">
											<div class="img-container">
												<img id="image" :src="getPicture()" alt="Picture">
											</div>
											<div class="input-group input-group-sm docs-buttons">
												<!-- <h3 class="page-header">Toolbar:</h3> -->
												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Mover Imagen">
														<span class="fa fa-arrows"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Recortar Imagen">
														<span class="fa fa-crop"></span>
													  </span>
													</button>
												  </div>

												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Aumentar Zoom">
														<span class="fa fa-search-plus"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Reducir Zoom">
														<span class="fa fa-search-minus"></span>
													  </span>
													</button>
												  </div>

												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Mover imagen (Izquierda)">
														<span class="fa fa-arrow-left"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Mover imagen (Derecha)">
														<span class="fa fa-arrow-right"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Mover imagen (Arriba)">
														<span class="fa fa-arrow-up"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Mover imagen (Abajo)">
														<span class="fa fa-arrow-down"></span>
													  </span>
													</button>
												  </div>

												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Rotar a la izquierda">
														<span class="fa fa-rotate-left"></span> 
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Rotar a la derecha">
														<span class="fa fa-rotate-right"></span> 
													  </span>
													</button>
												  </div>

												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Voltear Horizontalmente">
														<span class="fa fa-arrows-h"></span> 
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Voltear Verticalmente">
														<span class="fa fa-arrows-v"></span> 
													  </span>
													</button>
												  </div>

												  <div class="btn-group">
													<button type="button" class="btn btn-primary" data-method="disable" title="Disable">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Bloquear Movimiento">
														<span class="fa fa-lock"></span>
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="enable" title="Enable">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Desbloquear Movimiento">
														<span class="fa fa-unlock"></span>
													  </span>
													</button>
												  </div>

												  <div class="btn-group btn-group-crop">
													<button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Guardar Imagen">
														Guardar Imagen
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Guardar Imagen (160&times;90)">
														Guardar Imagen (160&times;90)
													  </span>
													</button>
													<button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
													  <span class="docs-tooltip" data-toggle="tooltip" title="Guardar Imagen (320&times;180)">
														Guardar Imagen (320&times;180)
													  </span>
													</button>
												  </div>
											</div>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-3">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="docs-preview clearfix">
													<div class="img-preview preview-lg"></div>
													<div class="img-preview preview-md"></div>
													<div class="img-preview preview-sm"></div>
													<div class="img-preview preview-xs"></div>
												</div>
											</div>
											<div class="docs-data">
												<div class="input-group input-group-sm">
												  <label class="input-group-addon" for="dataWidth">Ancho (Píxeles)</label>
												  <input type="text" class="form-control" id="dataWidth" placeholder="width">
												  <span class="input-group-addon">px</span>
												</div>
												<div class="input-group input-group-sm">
												  <label class="input-group-addon" for="dataHeight">Alto (Píxeles)</label>
												  <input type="text" class="form-control" id="dataHeight" placeholder="height">
												  <span class="input-group-addon">px</span>
												</div>
												<div class="input-group input-group-sm">
												  <label class="input-group-addon" for="dataRotate">Rotar</label>
												  <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
												  <span class="input-group-addon">deg</span>
												</div>
												
											</div>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
										</div>
									</div>
								</div>
							</div>
							
							<div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
										</div>
										<div class="modal-body"></div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
											<a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.png">Descargar Editada</a>
										</div>
								  </div>
								</div>
							  </div>
						  </div>
						  <div id="step-22">
							<h2 class="StepTitle"></h2>
							  <span class="section">Agregar Nombres Comunes</span>
							<div class="x_content">
								<table class="table table-responsive">
									<tr v-for="(comun_name, i) in garden_comun_names">
										<td>{{ comun_name.id }}</td>
										<td>{{ comun_name.name }}</td>
										<td>
											<button @click="removeNameComun(comun_name.id)" type="button" class="btn btn-danger">
												<i class="fa fa-times"></i>
											</button>
										</td>
									</tr>
								</table>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Nuevo Nombre Común</label>
									<div class="col-sm-9">
										<div class="input-group">
											<input v-model="add_comun_name" type="text" class="form-control">
											<span class="input-group-btn">
												<button @click="addNameComun" type="button" class="btn btn-primary">
													<i class="fa fa-plus"></i>
												</button>
											</span>
										</div>
									</div>
								</div>
							</div>
						  </div>
						  <div id="step-33">
							<h2 class="StepTitle"></h2>
							  <span class="section">Agregar Atributos</span>
							<div class="x_content">
								<table class="table table-responsive">
									<tr v-for="(item, i) in fields_items">
										<td>{{ item.id }}</td>
										<td>{{ item.field.name }}</td>
										<td>
											<template class="legend list-unstyled" v-if="item.field.type === 'color'">
												<ul class="legend list-unstyled">
													<li>
														<p>
															<span class="icon">
																<i class="fa fa-square" :style="'color: ' + item.value + ' !important;text-shadow: 0px 0px 2px #000000;'"></i>
															</span>
															<span class="name">
																{{ item.value }}
															</span>
														</p>
													</li>
												</ul>
											</template>
											<template class="legend list-unstyled" v-else>
												{{ item.value }}
											</template>
										</td>
										<td>
											<button @click="removeItemField(item.id)" type="button" class="btn btn-danger">
												<i class="fa fa-times"></i>
											</button>
										</td>
									</tr>
								</table>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Nuevo atributo</label>
									<div class="col-sm-5">
										<div class="input-group">
											<select @change="fieldSelectedChange" v-model="fieldSelected" type="text" class="form-control">
												<option value="">Seleccione...</option>
												<option v-for="(field, a) in fields_form" :value="a">{{ field.name }}</option>
											</select>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="col-sm-12">
											<div class="input-group">
												<template v-if="fields_form[fieldSelected]">
													<input v-model="fieldText" :type="fields_form[fieldSelected].type" class="form-control">
												</template>
												<template v-else>
													<input v-model="fieldText" type="text" class="form-control">
												</template>
												
												<span class="input-group-btn">
													<button @click="addItemField" type="button" class="btn btn-primary">
														<i class="fa fa-plus"></i>
													</button>
												</span>
											</div>
										</div>
										<div class="col-sm-12" v-if="optionsAlt.length > 0">
											<h5>Sugerencias</h5>
											<div class="input-group" v-for="(sug, h) in optionsAlt">
												<template>
													<template v-if="fields_form[fieldSelected]">
														<input :value="sug.value" :type="fields_form[fieldSelected].type" class="form-control">
													</template>
													<template v-else>
														<input :value="sug.value" type="text" class="form-control">
													</template>
													
													<span class="input-group-btn">
														<button @click="addItemFieldSug(h)" type="button" class="btn btn-primary">
															<i class="fa fa-plus"></i>
														</button>
													</span>
													<!--
													<span class="input-group-btn">
														<button @click="addItemField" type="button" class="btn btn-primary">
															<i class="fa fa-plus"></i>
														</button>
													</span>-->
												</template>
											</div>
										</div>
									</div>
								</div>
							</div>
						  </div>
						</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
var GardenList = Vue.extend({
	template: '#garden-list',
	data() {
		var self = this;
		return {
			load: null,
			records: null,
			searchText: null,
			gardens_ids: [],
			letters_list: ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z',],
		};
	},
	mounted(){
		var self = this;
		self.searchText = (self.$route.params.search_text != undefined) ? self.$route.params.search_text : '';
		self.getGardens();
	},
	methods: {
		getSearch(){
			var self = this;
			if(self.searchText != ""){
				router.push({ name: 'Garden-Search', params: { search_text: self.searchText } })
			}
		},
		getGardens(){
			var self = this;
			
			if(self.$route.params.letter_text != undefined){
				// console.log("Filtrando por letra.");
				self.gardens_ids = [];
				
				api.get('/records/garden_comun_names', {
					params: {
						filter: [
							'name,cs,' + self.$route.params.letter_text
						]
					}
				})
				.then(function (r_garden_comun_names) {
					if(r_garden_comun_names.data.records){
						r_garden_comun_names.data.records.forEach(aa => {
							self.gardens_ids.push(aa.garden);
						});
						self.load = {
							params: {
								join: [
									'garden_comun_names',
								],
								'filter1': [
									'name_comercial,sw,' + self.$route.params.letter_text,
								],
								'filter2': [
									'name_comun,sw,' + self.$route.params.letter_text,
								],
								'filter3': [
									'name_botanico,sw,' + self.$route.params.letter_text,
								],
								'filter4': [
									'id,in,' + self.gardens_ids.join(),
								],
							}
						};
						self.loadList();
					}
				}).catch(function (error) {
					// console.log('error', error, error.response);
					
				});
			}else if(self.$route.params.search_text != undefined){
				// console.log("Filtrando por search.");
				self.gardens_ids = [];
				
				api.get('/records/garden_comun_names', {
					params: {
						filter: [
							'name,cs,' + self.$route.params.search_text
						]
					}
				})
				.then(function (r_garden_comun_names) {
					if(r_garden_comun_names.data.records){
						r_garden_comun_names.data.records.forEach(aa => {
							self.gardens_ids.push(aa.garden);
						});
						
						api.get('/records/garden_items', {
							params: {
								filter: [
									'value,cs,' + self.$route.params.search_text
								]
							}
						})
						.then(function (r_garden_items) {
							if(r_garden_items.data.records){
								r_garden_items.data.records.forEach(aa => {
									self.gardens_ids.push(aa.garden);
								});
								
								self.load = {
									params: {
										join: [
											'garden_comun_names',
										],
										'filter1': [
											'name_comercial,cs,' + self.$route.params.search_text,
										],
										'filter2': [
											'name_comun,cs,' + self.$route.params.search_text,
										],
										'filter3': [
											'name_botanico,cs,' + self.$route.params.search_text,
										],
										'filter4': [
											'description,cs,' + self.$route.params.search_text,
										],
										'filter5': [
											'id,in,' + self.gardens_ids.join(),
										],
									}
								};
								// console.log(self.load);
								
								self.loadList();
							}
						}).catch(function (error) {
							// console.log('error', error, error.response);
							
						});
					}
				}).catch(function (error) {
					// console.log('error', error, error.response);
					
				});
			}else if(self.$route.params.value_text != undefined){
				// console.log("Filtrando por Fields.");
				// console.log(self.$route.params.value_text);
				
				api.get('/records/garden_items', {
					params: {
						filter: [
							'value,cs,' + self.$route.params.value_text
						]
					}
				})
				.then(function (rr) {
					if(rr.data.records){
						bb = [];
						rr.data.records.forEach(aa => {
							bb.push(aa.garden);
						});
						self.load = {
							params: {
								join: [
									'garden_comun_names',
								],
								'filter1': [
									'id,in,' + bb.join(),
								],
							}
						};
						
						self.loadList();
					}
				}).catch(function (error) {
					// console.log('error', error, error.response);
					
				});
			}else{
				self.load = {
					params: {
						join: [
							'garden_comun_names',
						],
					}
				};
				self.loadList();
			}
			
		},
		loadList(){
			var self = this;
			if(self.load !== null){
				api.get('/records/garden', self.load)
				.then(function (response) {
					self.records = response.data.records;
				}).catch(function (error) {
					// console.log('error', error, error.response)
				});
			}
		},
		deleteGarden(garden_id){
			var self = this;
			bootbox.confirm({
				message: "Debes confirmar antes de eliminar, al eliminar se eliminan tambien las imagenes y atributos.",
				locale: 'es',
				callback: function (result) {
					// console.log('This was logged in the callback: ' + result);
					if(result === true){
						api.delete('/records/garden/' + garden_id, {}).then(function (response) {
							 // console.log(response);
							 self.getGardens();
						}).catch(function (error) {
							// console.log(error);// console.log(error.response);
						});
					}
				}
			});

			
		}
	},
});

var GardenDetails = Vue.extend({
	template: '#garden-details',
	data() {
		var self = this;
		return {
			idDetails: self.$route.params.garden_id,
			record: null,
			fields: null,
		};
	},
	methods: {
		validateFields(fields){
			var self = this;
			try {
				a = (fields != null && fields != undefined) ? fields : null;
				b = {};
				a.forEach(c => {
					// console.log(c);
					if(!b[c.field.id]){
						b[c.field.id] = {
							"id": c.field.id,
							"name": c.field.name,
							"type": c.field.type,
							"values": []
						};
					}
					b[c.field.id].values.push(c);
				});
				// console.log(b)
				return b;
			}
			catch (e){
				// console.error(e);
				return null;
			}
		}
	},
	mounted(){
		var self = this;
		
		api.get('/records/garden/' + self.idDetails, {
			params: {
				join: [
					'garden_comun_names',
					'garden_items',
					'garden_items,garden_fields',
				]
			}
		}).then(function (response) {
			if(response.data != undefined){
				if(response.data.garden_items){
					self.fields = self.validateFields(response.data.garden_items);
				}
				
				self.record = response.data;
			}
		}).catch(function (error) {
		  // console.log(error);// console.log(error.response);
		});
	},
});

var GardenEdit = Vue.extend({
	template: '#garden-edit',
	data() {
		var self = this;
		return {
			record: {
				id: self.getGardenId(),
				name_comercial: '',
				name_comun: '',
				name_botanico: '',
				picture: null,
				description: '',
			},
			add_comun_name: '',
			fieldSelected: '',
			fieldText: '',
			garden_comun_names: [],
			fields_items: [],
			fields_form: [],
			optionsAlt: []
		};
	},
	mounted(){
		var self = this;
		if(self.getGardenId() > 0){
			self.getRecord();
		}
		self.init_SmartWizard();
		self.getFieldsForm();
	},
	methods: {
		getGardenId(){
			var self = this;
			return (self.$route.params.garden_id <= 0 || self.$route.params.garden_id == undefined) ? null : self.$route.params.garden_id;;
		},
		getPicture(){
			var self = this;
			return '/index.php?controller=Sistema&action=picture&id=' + self.record.picture + '&w=350';
		},
		onFinishCallback(){
			var self = this;
			// console.log("Validando Formulario");
			if(self.validateAllSteps()){
				// console.log("Formulario OK.");
				router.push({ name: 'Garden-Details', params: { garden_id: self.record.id } })
			}
		},
		onLeaveStep(obj, context){
			var self = this;
			// console.log("Leaving step " + context.fromStep + " to go to step " + context.toStep);
			// return (context.toStep < context.fromStep) ? true : self.validateSteps(context.fromStep);
			return self.validateSteps(context.fromStep);
		},
		validateSteps(stepnumber){
			var self = this;
			var isStepValid = true;
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
			
			if(stepnumber == 1){
				// console.log("Creacion del garden.");
				
				if (self.record.name_comercial != "" && self.record.name_comercial.length > 1){
					if (self.record.id === null){
						// console.log("Creando");
						api.post('/records/garden', self.record)
							.then(function (r) {
								if(r.status === 200 && r.data > 0){
									// console.log("Creado!!");
									self.record.id = r.data;
									jQuery('#wizard_verticle').smartWizard('goForward');
									isStepValid = true;
									return true;
									// 
								}else{
									// console.error(r);
									isStepValid = false;
									return false;
								}
							})
							.catch(function (error) {
								// console.log(error);
								// console.error(error);
								// console.log(error.response);
								// console.log(JSON.parse(error.response.config.data));
								// console.log((error.response.headers['x-exception-name']));
								// console.log((error.response.headers['x-exception-message']));
								isStepValid = false;
								return false;
							});
					} else {
						// console.log("Editando");
						api.put('/records/garden/' + self.record.id, self.record)
							.then(function (r) {
								// console.log(r);
							})
							.catch(function (error) {
								// console.error(error);
								// console.log((error.response.headers['x-exception-name']));
								// console.log((error.response.headers['x-exception-message']));
							});
						return true;
					}
				}else{
					alert("Ingresa almenos el Nombre comercial *.");
				}
				
				//return isStepValid;
			}
			else if(stepnumber == 2){
				self.getNamesComunes();				
				return true;
			}
			else if(stepnumber == 3){
				self.getFieldsForm();
				self.getFields();
				self.fieldSelectedChange();
				return true;
			}
			else{
				return true;
			}
			
		},
		addItemFieldSug(sug_id){
			var self = this;
			// console.log(sug_id);
			// console.log(self.optionsAlt[sug_id]);
			if(self.optionsAlt[sug_id]){
				// console.log('self.optionsAlt[sug_id]');
				// console.log(sug_id, self.optionsAlt[sug_id]);
				value = (self.optionsAlt[sug_id].value) ? self.optionsAlt[sug_id].value : '';
				field = (self.optionsAlt[sug_id].field.id) ? self.optionsAlt[sug_id].field.id : '';
				// console.log(value, field);
				
				self.fieldText = value;
				self.addItemField();
			}
		},
		removeNameComun(comun_name_id){
			var self = this;
			api.delete('/records/garden_comun_names/' + comun_name_id, {}).then(function (response) {
				 // console.log(response);
				 self.getNamesComunes();
			}).catch(function (error) {
				// console.log(error);// console.log(error.response);
			});
		},
		getNamesComunes(){
			var self = this;
			api.get('/records/garden/' + self.record.id, {
				params: {
					join: [
						'garden_comun_names',
						// 'garden_items',
						// 'garden_items,garden_fields',
					]
				}
			}).then(function (response) {
				 // console.log(response);
				self.garden_comun_names = (!response.data.garden_comun_names) ? [] : response.data.garden_comun_names;
			}).catch(function (error) {
			  // console.log(error);// console.log(error.response);
			});
		
		},
		addNameComun(){
			var self = this;
			api.post('/records/garden_comun_names', {
				garden: self.record.id,
				name: self.add_comun_name
			}).then(function (response) {
				self.getNamesComunes();
				self.add_comun_name = '';
			}).catch(function (error) {
			  // console.log(error);// console.log(error.response);
			});
		},
		validateAllSteps(){
			var self = this;
			var isStepValid = true;
			// all step validation logic     
			return isStepValid;
		},
		init_SmartWizard(){
			var self = this;
			if( typeof (jQuery.fn.smartWizard) === 'undefined'){ return; }
			// console.log('init_SmartWizard');
			
			jQuery('#wizard').smartWizard();

			jQuery('#wizard_verticle').smartWizard({
				labelNext:'Siguiente', // label for Next button
				labelPrevious:'Anterior', // label for Previous button
				labelFinish:'Finalizar',  // label for Finish button
				transitionEffect: 'slide', // Effect on navigation, none/fade/slide/slideleft
				enableAllSteps: false,  // Enable/Disable all steps on first load
				buttonOrder: ['next', 'finish'],  // button order, to hide a button remove it from the list 'prev',
				onLeaveStep: self.onLeaveStep,
				onFinish: self.onFinishCallback
			});

			jQuery('.buttonNext').addClass('btn btn-success');
			jQuery('.buttonPrevious').addClass('btn btn-primary');
			jQuery('.buttonFinish').addClass('btn btn-default');
			self.init_cropper();
		},
		base64MimeType(encoded) {
		  var result = null;

		  if (typeof encoded !== 'string') {
			return result;
		  }

		  var mime = encoded.match(/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/);

		  if (mime && mime.length) {
			result = mime[1];
		  }

		  return result;
		},
		calculateImageSize(base64String){
			let padding, inBytes, base64StringLength;
			if(base64String.endsWith("==")) padding = 2;
			else if (base64String.endsWith("=")) padding = 1;
			else padding = 0;

			base64StringLength = base64String.length;
			// console.log(base64StringLength)
			inBytes =(base64StringLength / 4 ) * 3 - padding;
			// console.log(inBytes);
			this.kbytes = inBytes / 1000;
			return this.kbytes;
		},
		init_cropper() {
			var self = this;
			if( typeof (jQuery.fn.cropper) === 'undefined'){ return; }
			// console.log('init_cropper');
			
			var $image = jQuery('#image');
			var $download = jQuery('#download');
			var $dataX = jQuery('#dataX');
			var $dataY = jQuery('#dataY');
			var $dataHeight = jQuery('#dataHeight');
			var $dataWidth = jQuery('#dataWidth');
			var $dataRotate = jQuery('#dataRotate');
			var $dataScaleX = jQuery('#dataScaleX');
			var $dataScaleY = jQuery('#dataScaleY');
			var options = {
				  aspectRatio: 'NaN',
				  preview: '.img-preview',
				  crop: function (e) {
					$dataX.val(Math.round(e.x));
					$dataY.val(Math.round(e.y));
					$dataHeight.val(Math.round(e.height));
					$dataWidth.val(Math.round(e.width));
					$dataRotate.val(e.rotate);
					$dataScaleX.val(e.scaleX);
					$dataScaleY.val(e.scaleY);
				  }
				};


			// Tooltip
			jQuery('[data-toggle="tooltip"]').tooltip();


			// Cropper
			$image.on({
			  'build.cropper': function (e) {
				// console.log(e.type);
			  },
			  'built.cropper': function (e) {
				// console.log(e.type);
			  },
			  'cropstart.cropper': function (e) {
				// console.log(e.type, e.action);
			  },
			  'cropmove.cropper': function (e) {
				// console.log(e.type, e.action);
			  },
			  'cropend.cropper': function (e) {
				// console.log(e.type, e.action);
			  },
			  'crop.cropper': function (e) {
				// console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
			  },
			  'zoom.cropper': function (e) {
				// console.log(e.type, e.ratio);
			  }
			}).cropper(options);


			// Buttons
			if (!jQuery.isFunction(document.createElement('canvas').getContext)) {
			  jQuery('button[data-method="getCroppedCanvas"]').prop('disabled', true);
			}

			if (typeof document.createElement('cropper').style.transition === 'undefined') {
			  jQuery('button[data-method="rotate"]').prop('disabled', true);
			  jQuery('button[data-method="scale"]').prop('disabled', true);
			}


			// Download
			if (typeof $download[0].download === 'undefined') {
			  $download.addClass('disabled');
			}


			// Options
			jQuery('.docs-toggles').on('change', 'input', function () {
			  var $this = jQuery(this);
			  var name = $this.attr('name');
			  var type = $this.prop('type');
			  var cropBoxData;
			  var canvasData;

			  if (!$image.data('cropper')) {
				return;
			  }

			  if (type === 'checkbox') {
				options[name] = $this.prop('checked');
				cropBoxData = $image.cropper('getCropBoxData');
				canvasData = $image.cropper('getCanvasData');

				options.built = function () {
				  $image.cropper('setCropBoxData', cropBoxData);
				  $image.cropper('setCanvasData', canvasData);
				};
			  } else if (type === 'radio') {
				options[name] = $this.val();
			  }

			  $image.cropper('destroy').cropper(options);
			});


			// Methods
			jQuery('.docs-buttons').on('click', '[data-method]', function () {
			  var $this = jQuery(this);
			  var data = $this.data();
			  var $target;
			  var result;

			  if ($this.prop('disabled') || $this.hasClass('disabled')) {
				return;
			  }

			  if ($image.data('cropper') && data.method) {
				data = jQuery.extend({}, data); // Clone a new one

				if (typeof data.target !== 'undefined') {
				  $target = jQuery(data.target);

				  if (typeof data.option === 'undefined') {
					try {
					  data.option = JSON.parse($target.val());
					} catch (e) {
					  // console.log(e.message);
					}
				  }
				}

				result = $image.cropper(data.method, data.option, data.secondOption);

				switch (data.method) {
				  case 'scaleX':
				  case 'scaleY':
					jQuery(this).data('option', -data.option);
					break;

				  case 'getCroppedCanvas':
					if (result) {
						// console.log("Guardando imagen editada.");
						// console.log(result);
						// console.log(result.toDataURL());
						
						// result.toDataURL()
						if(result.toDataURL()){
							imageData = result.toDataURL();
							strImage = imageData.replace(/^data:image\/[a-z]+;base64,/, "");
							strImage2 = self.base64MimeType(imageData);
							strImage3 = self.calculateImageSize(strImage);
							
							date = new Date();
							insert = {
								name: 'Editor online',
								description: 'Imagen de plantas, editada y subida desde el formulario principal.',
								size: strImage3,
								data: strImage,
								type: strImage2,
								created: date.toMysqlFormat()
							}
							
							api.post('/records/pictures', insert)
								.then(function (rPicture) {
									// console.log(rPicture);
									if(rPicture.status === 200 && rPicture.data > 0){
										self.record.picture = rPicture.data;
										result = '/index.php?controller=Sistema&action=picture&id=' + rPicture + '&w=350';
									}else{
										result = '';
										self.record.picture = null;
									}
									$inputImage.val('');
									
									  // Bootstrap's Modal
									  jQuery('#getCroppedCanvasModal').modal().find('.modal-body').html('<img class="img-fluid" alt="Responsive image" src="' + imageData + '" />');

									  if (!$download.hasClass('disabled')) {
										$download.attr('href', imageData);
									  }
								})
								.catch(function (error) {
									// console.log(error);
									// console.error(error);
									// console.log(error.response);
									// console.log(JSON.parse(error.response.config.data));
									// console.log((error.response.headers['x-exception-name']));
									// console.log((error.response.headers['x-exception-message']));
									throw new Error('Yeah... Sorry');
									self.record.picture = null;
								});
							
						}
					}

					break;
				}

				if (jQuery.isPlainObject(result) && $target) {
				  try {
					$target.val(JSON.stringify(result));
				  } catch (e) {
					// console.log(e.message);
				  }
				}

			  }
			});

			// Keyboard
			jQuery(document.body).on('keydown', function (e) {
			  if (!$image.data('cropper') || this.scrollTop > 300) {
				return;
			  }

			  switch (e.which) {
				case 37:
				  e.preventDefault();
				  $image.cropper('move', -1, 0);
				  break;

				case 38:
				  e.preventDefault();
				  $image.cropper('move', 0, -1);
				  break;

				case 39:
				  e.preventDefault();
				  $image.cropper('move', 1, 0);
				  break;

				case 40:
				  e.preventDefault();
				  $image.cropper('move', 0, 1);
				  break;
			  }
			});

			// Import image
			var $inputImage = jQuery('#inputImage');
			var URL = window.URL || window.webkitURL;
			var blobURL;

			if (URL) {
			  $inputImage.change(function () {
				var files = this.files;
				var file;

				if (!$image.data('cropper')) {
				  return;
				}
				

				if (files && files.length) {
				  file = files[0];
				  if (/^image\/\w+$/.test(file.type)) {
					blobURL = URL.createObjectURL(file);
					// convirtiendo imagen a Base64-DB
					try {
						self.toDataURL(blobURL, function(dataUrl) {
							// console.log('RESULT:', dataUrl)
							// console.log('FILE:', file);
							strImage = dataUrl.replace(/^data:image\/[a-z]+;base64,/, "");
							date = new Date(file.lastModified);
							
							insert = {
								name: file.name,
								description: 'Imagen de plantas, subida desde el formulario principal.',
								size: file.size,
								data: strImage,
								type: file.type,
								created: date.toMysqlFormat()
							}
							api.post('/records/pictures', insert)
								.then(function (rPicture) {
									// console.log(rPicture);
									if(rPicture.status === 200 && rPicture.data > 0){
										self.record.picture = rPicture.data;
										blobURL = '/index.php?controller=Sistema&action=picture&id=' + rPicture + '&w=350';
									}else{
										blobURL = '';
										self.record.picture = null;
									}
									/*
										$image.one('built.cropper', function () {
											// console.log(blobURL);
										  // Revoke when load complete
										  URL.revokeObjectURL(blobURL);
										}).cropper('reset').cropper('replace', blobURL);
									*/
									$inputImage.val('');
								})
								.catch(function (error) {
									// console.log(error);
									// console.error(error);
									// console.log(error.response);
									// console.log(JSON.parse(error.response.config.data));
									// console.log((error.response.headers['x-exception-name']));
									// console.log((error.response.headers['x-exception-message']));
									throw new Error('Yeah... Sorry');
									self.record.picture = null;
								});
						});
						
					}catch(errorPicture){
						window.alert('Please choose an image file.');
						self.record.picture = null;
					};
					
				  } else {
					window.alert('Please choose an image file.');
					self.record.picture = null;
				  }
				}
			  });
			} else {
			  $inputImage.prop('disabled', true).parent().addClass('disabled');
			}
			
			
		},
		toDataURL(url, callback) {
		  var xhr = new XMLHttpRequest();
		  xhr.onload = function() {
			var reader = new FileReader();
			reader.onloadend = function() {
			  callback(reader.result);
			}
			reader.readAsDataURL(xhr.response);
		  };
		  xhr.open('GET', url);
		  xhr.responseType = 'blob';
		  xhr.send();
		},
		getFieldsForm(){
			var self = this;
			
			api.get('/records/garden_fields', {
				params: {
				}
			}).then(function (response) {
				self.fields_form = (!response.data.records) ? [] : response.data.records;
				
			}).catch(function (error) {
			});
		},
		removeItemField(item_field_id){
			var self = this;
			api.delete('/records/garden_items/' + item_field_id, {}).then(function (response) {
				 self.getFields();
			}).catch(function (error) {
				// console.log(error);// console.log(error.response);
			});
		},
		addItemField(){
			var self = this;
			// console.log('addItemField')
			// console.log(self.fieldText)
			// console.log(self.fieldSelected)
			if(self.fieldText != "" && self.fields_form[self.fieldSelected].id > 0){
				api.post('/records/garden_items', {
					garden: self.record.id,
					field: self.fields_form[self.fieldSelected].id,
					value: self.fieldText
				}).then(function (response) {
					// console.log(response)
					self.getFields();
					//self.fieldSelected = 0;
					self.fieldText = '';
				}).catch(function (error) {
				  // console.log(error);// console.log(error.response);
				});
			}
		},
		getFields(){
			var self = this;
			// console.log('getFields')
			
			api.get('/records/garden_items', {
				params: {
					filter: [
						'garden,eq,' + self.record.id
					],
					join: [
						'garden_fields'
					]
				}
			}).then(function (response) {
				 // console.log(response);
				self.fields_items = (!response.data.records) ? [] : response.data.records;
				
			}).catch(function (error) {
			  // console.log(error);// console.log(error.response);
			});
		},
		getRecord(){
			var self = this;
			// console.log('getRecord')			
			api.get('/records/garden/' + self.getGardenId(), {
				params: {
				}
			}).then(function (response) {
				// console.log(response);
				if (response.data.id != undefined && response.data.id > 0){
					self.record = response.data;
					self.getNamesComunes();
					self.getFields();
				}
			}).catch(function (error) {
			  // console.log(error);// console.log(error.response);
			});
		},
		fieldSelectedChange(){
			var self = this;
			self.optionsAlt = [];
			api.get('/records/garden_items', {
				params: {
					join: [
						'garden_fields'
					],
					filter: [
						'field,in,' + self.fields_form[self.fieldSelected].id
					]
				}
			}).then(function (response) {
				// console.log(response);
				if (response.data.records != undefined){
					response.data.records.forEach(a => {
						// console.log('a', a);
						found = self.optionsAlt.filter(x => x.value === a.value);
						// console.log('a', a);
						// console.log('found', found);
						
						if(found.length === 0){
							self.optionsAlt.push(a);
						}else{
							
						}
					});
				}
			}).catch(function (error) {
			  // console.log(error);// console.log(error.response);
			});
		},
	},
});


var router = new VueRouter({
  routes:[
    { path: '/', component: GardenList, name: 'Garden-List' },
    { path: '/filter/letter/:letter_text', component: GardenList, name: 'Garden-Filter-Letter' },
    { path: '/search/:search_text', component: GardenList, name: 'Garden-Search' },
    { path: '/filter/fields/search/:value_text', component: GardenList, name: 'Garden-Filter-Fields' },
    { path: '/create', component: GardenEdit, name: 'Garden-Create', params: { garden_id: 0 } },
    { path: '/edit/:garden_id', component: GardenEdit, name: 'Garden-Edit'},
    { path: '/details/:garden_id', component: GardenDetails, name: 'Garden-Details'},
  ]
});

app = new Vue({
  router: router,
  data: function () {
    return {definition: null};
  },
  mounted: function () {
	  
  },
  created: function () {
    var self = this;
  }
}).$mount('#app');
</script>