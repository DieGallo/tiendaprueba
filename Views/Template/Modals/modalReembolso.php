<?php
  $trs = $data->purchase_units[0];
  $cl = $data->payer;
  $idTransaccion = $trs->payments->captures[0]->id;
  // Datos del Cliente
  $nombreCliente = $cl->name->given_name.' '.$cl->name->surname;
  $emailCliente = $cl->email_address;
  $telCliente = isset($cl->phone) ? $cl->phone->phone_number->national_number : "N/A";
  $codCiudad = $cl->address->country_code;
  // Detalle de los montos
  $totalCompra = $trs->payments->captures[0]->seller_receivable_breakdown->gross_amount->value;
  $moneda = $trs->payments->captures[0]->amount->currency_code;
  $comision = $trs->payments->captures[0]->seller_receivable_breakdown->paypal_fee->value;
  $importeNeto = $trs->payments->captures[0]->seller_receivable_breakdown->net_amount->value;
?>
<!-- Modal -->
<div class="modal fade" id="modalReembolso" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Hacer Reembolso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--<?php dep($data); ?> Muestra los datos del objeto de PayPal-->
        <table class="table table-bordered">
          <input type="hidden" id="idTransaccion" value="<?= $idTransaccion ?>">
          <tbody>
            <tr>
              <td>Transacción:</td>
              <td><?= $idTransaccion ?></td>
            </tr>
            <tr>
              <td>Contacto:</td>
              <td><?= $nombreCliente ?><br> <?= $emailCliente ?><br> <?= $telCliente ?></td>
            </tr>
            <tr>
              <td>Importe Total del Reembolso:</td>
              <td><?= $totalCompra.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Importe Neto del Reembolso:</td>
              <td><?= $importeNeto.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Comisión Reembolso por PayPal:</td>
              <td><?= $comision.' '.$moneda ?></td>
            </tr>
            <tr>
              <td>Observación:</td>
              <td><textarea id="txtObservacion" class="form-control"></textarea></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="fntReembolsar();"><i class="fa fa-reply-all" aria-hidden="true"></i> Reembolsar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>