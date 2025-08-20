<x-layouts.app :title="__('Dashboard')">
  <div class="flex h-full w-full flex-1 flex-col gap-4">
    {{-- Tarjetas de Resumen --}}
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
      <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700">
        <div class="flex flex-col">
          <span class="text-sm text-gray-500">Ventas de Hoy</span>
          <span class="text-2xl font-bold">{{ $data['totalVentasHoy'] }}</span>
          <span class="mt-2 text-sm text-gray-500">Productos vendidos: {{ $data['totalProductosVendidosHoy'] }}</span>
        </div>
      </div>
      <div class="overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700">
        <div class="flex flex-col">
          <span class="text-sm text-gray-500">Total Ventas de Hoy</span>
          <span class="text-2xl font-bold">${{ number_format($data['totalMontoVentasHoy'], 0, ',', '.') }}</span>
          <span class="mt-2 text-sm text-yellow-500">
            <flux:icon name="arrow-path" class="inline h-4 w-4" />
            Actualizado en tiempo real
          </span>
        </div>
      </div>
      <div class="rounded-xl border border-neutral-200 bg-white p-2 shadow-sm dark:border-neutral-700">
        <div class="border-b border-neutral-200 p-2">
          <span class="text-sm font-semibold text-gray-700">Productos Más Vendidos</span>
        </div>
        <div class="flex h-[200px] flex-col overflow-auto overflow-y-auto px-1"
          style="max-height: calc(100vh - 400px);">
          <div class="divide-y divide-neutral-200">
            @foreach ($data['productosMasVendidos'] as $producto)
              <div class="flex items-center justify-between p-2 hover:bg-gray-50">
                <span class="flex-1 truncate text-sm">{{ $producto->producto->nombre }}</span>
                <div class="ml-4 flex items-center gap-2">
                  <span class="rounded bg-yellow-400 px-2 py-1 text-sm font-semibold text-black">
                    {{ $producto->total_vendido }} unds
                  </span>
                  <span class="text-sm text-gray-500">${{ number_format($producto->total_monto, 0, ',', '.') }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    {{-- Gráfico de Ventas por Hora --}}
    <div
      class="flex-1 overflow-hidden rounded-xl border border-neutral-200 bg-white p-6 shadow-sm dark:border-neutral-700">
      <div class="mb-4 flex items-center justify-between">
        <h3 class="text-lg font-semibold">Ventas por Hora</h3>
        <div class="space-x-2">
          <button class="btn-secundary-grid" onclick="actualizarGrafico('ventas')">Ver Ventas</button>
          <button class="btn-secundary-grid" onclick="actualizarGrafico('montos')">Ver Montos</button>
        </div>
      </div>
      <div id="graficoVentas" class="h-[400px]"></div>
    </div>
  </div>

  @push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
      // Datos para el gráfico
      const datosVentas = @json($data['ventasPorHora']->pluck('total_ventas', 'hora_formato'));
      const datosMontos = @json($data['ventasPorHora']->pluck('monto_total', 'hora_formato'));

      // Configuración del gráfico
      let options = {
        series: [{
          name: 'Ventas',
          data: Object.values(datosVentas)
        }],
        chart: {
          type: 'area',
          height: 400,
          toolbar: {
            show: false
          }
        },
        stroke: {
          curve: 'smooth',
          width: 3
        },
        colors: ['#f0b100'],
        xaxis: {
          categories: Object.keys(datosVentas)
        },
        yaxis: {
          title: {
            text: 'Cantidad de Ventas'
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.2,
            stops: [0, 90, 100]
          }
        }
      };

      const chart = new ApexCharts(document.querySelector("#graficoVentas"), options);
      chart.render();

      // Función para actualizar entre ventas y montos
      function actualizarGrafico(tipo) {
        const nuevasSeries = [{
          name: tipo === 'ventas' ? 'Ventas' : 'Montos',
          data: Object.values(tipo === 'ventas' ? datosVentas : datosMontos)
        }];

        const nuevoTitulo = {
          text: tipo === 'ventas' ? 'Cantidad de Ventas' : 'Monto Total ($)'
        };

        chart.updateOptions({
          series: nuevasSeries,
          yaxis: {
            title: nuevoTitulo
          }
        });
      }
    </script>
  @endpush
</x-layouts.app>
