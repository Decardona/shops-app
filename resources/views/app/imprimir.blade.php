<x-layouts.app>
  <div class="mb-4 print:hidden">
    <a href="{{ route('ventas.create') }}" class="btn-secundary">Regresar </a>
  </div>
  <div class="flex w-1/2 flex-col items-center justify-center border border-gray-100 p-2">
    <span class="text-2xl font-bold">SHOPS COMPANY INC.</span>
    <span class="text-lg">Factura de venta No: <strong>{{ $venta->id }}</strong></span>
    <p class="text-xs">Fecha:
      <strong>{{ $venta->created_at->setTimezone('America/Bogota')->format('d/m/Y, h:i A') }}</strong>
    </p>
    <div class="mt-2 flex w-auto flex-row justify-start">
      <span class="self-start font-semibold">Cliente</span>
    </div>
    <div class="flex flex-row gap-4 border border-gray-200 px-4 py-2">
      <div class="flex flex-col">
        <p>{{ $venta->tercero->nombre }} {{ $venta->tercero->apellido }}</p>
        <p class="text-xs"><strong>{{ $venta->tercero->tipo_documento }} </strong>: {{ $venta->tercero->documento }}</p>
        <p class="text-xs"><strong>Telefono</strong>: {{ $venta->tercero->telefono }}</p>
        <p class="text-xs"><strong>Direccion</strong>: {{ $venta->tercero->direccion }}</p>
        <p class="text-xs"><strong>Email</strong>: {{ $venta->tercero->email }}</p>
      </div>
    </div>
    <p class="mt-2 font-semibold">Detalle de Productos</p>
    <div class="flex flex-col p-2">
      <div class="flex flex-row justify-between border-b border-gray-200 p-2">
        <span class="font-semibold">Cantidad x Precio = Total</span>
        <span class="font-semibold">Producto</span>
      </div>
      @foreach ($venta->detalles as $detalle)
        <div class="flex flex-row justify-between gap-2 border-b border-gray-200 p-1">
          <span class="text-xs">{{ $detalle->producto->nombre }}</span>
          <span class="text-xs">{{ $detalle->cantidad }} x ${{ number_format($detalle->precio, 0, ',', '.') }} =
            ${{ number_format($detalle->cantidad * $detalle->precio, 0, ',', '.') }}</span>
        </div>
      @endforeach
    </div>
    <div class="mt-2 flex w-auto flex-row justify-end gap-2">
      <span class="self-start text-lg">Total:</span>
      <span class="text-lg font-semibold">${{ number_format($venta->total, 0, ',', '.') }}</span>
    </div>
    <div class="mt-2">
      <span class="text-xs">Gracias por tu compra, esperamos verte pronto.</span>
    </div>
    <button onclick="window.print()" class="btn-primary mt-4 print:hidden">Imprimir</button>
</x-layouts.app>
