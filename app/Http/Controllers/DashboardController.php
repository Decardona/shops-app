<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\VentaDetalle;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ventas del día
        $ventasHoy = Venta::query()
            ->whereDate('created_at', Carbon::today())
            ->get();

        // Totales
        $totalVentasHoy = $ventasHoy->count();
        
        // Total productos vendidos hoy
        $totalProductosVendidosHoy = VentaDetalle::query()
            ->whereIn('venta_id', $ventasHoy->pluck('id'))
            ->sum('cantidad');

        // Total monto vendido hoy
        $totalMontoVentasHoy = $ventasHoy->sum('total');

        // Productos más vendidos del día
        $productosMasVendidos = VentaDetalle::select(
            'producto_id',
            DB::raw('SUM(cantidad) as total_vendido'),
            DB::raw('SUM(cantidad * precio) as total_monto')
        )
            ->with('producto:id,nombre,precio')
            ->whereHas('venta', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->groupBy('producto_id')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        // Ventas por hora (para el gráfico)
        $ventasPorHora = Venta::select(
            DB::raw('HOUR(created_at) as hora'),
            DB::raw('COUNT(*) as total_ventas'),
            DB::raw('SUM(total) as monto_total')
        )
            ->whereDate('created_at', Carbon::today())
            ->groupBy('hora')
            ->orderBy('hora')
            ->get()
            ->map(function ($venta) {
                $venta->hora_formato = sprintf('%02d:00', $venta->hora);
                return $venta;
            });

        // Asegurar que todas las variables tengan valores por defecto
        $data = [
            'totalVentasHoy' => $totalVentasHoy ?? 0,
            'totalProductosVendidosHoy' => $totalProductosVendidosHoy ?? 0,
            'totalMontoVentasHoy' => $totalMontoVentasHoy ?? 0,
            'productosMasVendidos' => $productosMasVendidos ?? collect(),
            'ventasPorHora' => $ventasPorHora ?? collect()
        ];

        return view('dashboard', compact('data'));
    }
}
