<div class="modal fade modal-slide-in-right" aria-hidden="true"
	role="dialog" tabindex="-1" id="modal-delete-{{ $t->id }}">
	{{Form::open(['route'=>['runner.tallas.destroy',$t->id],'method'=>'delete'])}}
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
				<span aria-hiden="true">x</span>
				</button>
				<h4 class="modal-title">Tallas</h4>
			</div>
			<div class="modal-body">
				<p>Confirme la acción para elimar la talla <b>{{$t->talla}}</b></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>