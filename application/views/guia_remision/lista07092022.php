<section class="content-header">
	<form id="exp_excel" style="float:right;padding:0px;margin: 0px;" method="post" action="<?php echo base_url();?>guia_remision/excel/<?php echo $permisos->opc_id?>/<?php echo $fec1?>/<?php echo $fec2?>" onsubmit="return exportar_excel()"  >
        	<input type="submit" value="EXCEL" class="btn btn-success" />
        	<input type="hidden" id="datatodisplay" name="datatodisplay">
       	</form>
      <h1>
        Guias de Remision
      </h1>
</section>
<section class="content">
	<div class="box box-solid">
		<div class="box box-body">
			
			<div class="row">
				<div class="col-md-1">
					<?php 
					if($permisos->rop_insertar){
					?>
						<a href="<?php echo base_url();?>guia_remision/nuevo/<?php echo $permisos->opc_id?>" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Nuevo</a>
					<?php 
					}
					?>
				</div>
				<div class="col-md-8">
					<form action="<?php echo $buscar;?>" method="post">
						
					<table width="100%">
						<tr>
							<td><label>Buscar:</label></td>
							<td><input type="text" id='txt' name='txt' class="form-control" style="width: 180px" value='<?php echo $txt?>'/></td>
							<td>
							</td>
							<td><label>Desde:</label></td>
							<td><input type="date" id='fec1' name='fec1' class="form-control" style="width: 150px" value='<?php echo $fec1?>' /></td>
							<td><label>Hasta:</label></td>
							<td><input type="date" id='fec2' name='fec2' class="form-control" style="width: 150px" value='<?php echo $fec2?>' /></td>
							<td><button type="submit" class="btn btn-info"><span class="fa fa-search"></span> Buscar</button>
								</td>
						</tr>
					</table>
					</form>
				</div>					
			</div>
			<br>
			<div class="row">
				<div class="col-md-12">
					<table id="tbl_list" class="table table-bordered table-list table-hover">
						<thead>
							<th>No</th>
							<th>Fecha</th>
							<th>Guia Remision No</th>
							<th>Usuario</th>
							<th>Tipo</th>
							<th>Factura</th>
							<th>Cliente</th>
							<th>Transportista</th>
							<th>Estado</th>
							<th>Acciones</th>
						</thead>
						<tbody>
						<?php 
						$n=0;
						if(!empty($guias)){
							foreach ($guias as $guia) {
								$n++;
								if($guia->gui_denominacion_comp==0){
									$deno='SIN FACTURA';
								}else{
									$deno='FACTURA';
								}
						?>
							<tr>
								<td><?php echo $n?></td>
								<td><?php echo $guia->gui_fecha_emision?></td>
								<td style="mso-number-format:'@'"><?php echo $guia->gui_numero?></td>
								<td style="mso-number-format:'@'"><?php echo $guia->vnd_nombre?></td>
								<td><?php echo $deno?></td>
								<td><?php echo $guia->gui_num_comprobante?></td>
								<td><?php echo $guia->gui_nombre?></td>
								<td><?php echo $guia->tra_razon_social?></td>
								<td><?php echo $guia->est_descripcion?></td>
								<td align="center">
									<div class="btn-group">
										<a href="<?php echo base_url();?>sri/consulta_sri/<?php echo $guia->gui_clave_acceso?>" class="btn btn-info"> <span class="fa fa-file-code-o" title="XML"></span></a>
										<?php 
							        	if($permisos->rop_reporte){
										?>
											<a href="<?php echo base_url();?>guia_remision/show_frame/<?php echo $guia->gui_id?>/<?php echo $permisos->opc_id?>" class="btn btn-warning" title="RIDE"> <span class="fa fa-file-pdf-o"></span></a>
										<?php 
										}
										
										if($permisos->rop_eliminar){
											if($guia->gui_estado!=3){
										?>
												<a href="<?php echo base_url();?>guia_remision/anular/<?php echo $guia->gui_id?>/<?php echo $guia->gui_numero?>/<?php echo $permisos->opc_id?>" class="btn btn-danger btn-anular-comp" title="Anular"><span class="fa fa-times" ></span></a>
										<?php 
											}
										}
										?>
									</div>
								</td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>


</section>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">guia</h4>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
</div>

<script type="text/javascript">
	function enviar_sri(){
        $.ajax({
                url: base_url+"guia_remision/consulta_sri",
                type: 'JSON',
                dataType: 'JSON',
                success: function (dt) {
                },
                    
        });    
    }

    // setInterval('enviar_sri()',1000);

	
</script>