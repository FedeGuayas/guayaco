<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-deuda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hiden="true">x</span>
                </button>
                <h3 class="modal-title"> <i class="fa fa-warning text-danger pull-left"></i> Alerta de deuda </h3>
            </div>
            <div class="modal-body">
                <h4>Esta persona aparece en nuestra base como deudora de un chip (<b>{{ sprintf("%'.04d",$chip_deuda) }}</b>). Se le sumara al costo de la inscripción un valor de <b>$3.00</b></h4>
            </div>
            {{--<div class="modal-footer bg-danger">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>--}}
                {{--<button type="submit" class="btn btn-danger">Confirmar</button>--}}
            {{--</div>--}}
        </div>
    </div>
    {{Form::Close()}}
</div>