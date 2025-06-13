<x-app-layout>
    <div class="container-fluid">
        <section class="">
            <div class="mt-2">
                <h3 class="text-left">
                    <i class="fas fa-industry fa-fw"></i> &nbsp; REPORTE USO DE MATERIAS PRIMAS
                </h3>
            </div>

            <div class="container-fluid tile-container">
                <div class="alert alert-info">
                    <p><strong>Estado de datos:</strong>
                        @if(isset($materiasPrimas) && count($materiasPrimas) > 0)
                            Hay {{ count($materiasPrimas) }} registros disponibles.
                        @else
                            No hay datos disponibles para mostrar.
                        @endif
                    </p>
                </div>

                <!-- Contenedor para el gráfico -->
                <div class="mb-4" style="min-height: 300px;">
                    <canvas id="graficoMateriasPrimas" data-materias='@json($materiasPrimas ?? [])'></canvas>
                </div>

                <!-- Tabla detallada -->
                <div class="table-overflow-x">
                    <table class="table table-dark table-sm">
                        <thead>
                            <tr class="text-center roboto-medium">
                                <th>Materia Prima</th>
                                <th>Producción</th>
                                <th>Cantidad Usada</th>
                                <th>Fecha de Uso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrosUso as $registro)
                                <tr class="text-center table-light">
                                    <td>{{ $registro->mat_pri_nombre }}</td>
                                    <td>{{ $registro->pro_nombre }}</td>
                                    <td>{{ $registro->reg_pmp_cantidad_usada }}</td>
                                    <td>{{ $registro->reg_pmp_fecha_registro }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay datos disponibles.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
