<x-app-layout>
    <div class="container-fluid">
        <div class="table-overflow-x">
            <table class="table table-dark table-sm">
                <thead>
                    <tr class="text-center roboto-medium">
                        <th>#</th>
                        <th>NOMBRE</th>
                        <th>STOCK</th>
                        <th>ACTUALIZAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
<tbody id="materiaPrimaTable">
    @forelse ($materiaPrima as $index => $item)
        <tr class="text-center align-middle table-light">
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->mat_pri_nombre }}</td>
            <td>{{ $item->mat_pri_cantidad }} {{ $item->mat_pri_unidad_medida }}</td>
            <td>
                <a href="{{ route('editar-producto', $item->id_materia_prima) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </td>
            <td>
                <form class="form-eliminar" action="{{ route('eliminar.matPrima', $item->id_materia_prima) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No hay materias primas registradas.</td>
        </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>

        {{-- Mostrar error --}}
    @if ($errors->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ $errors->first("error") }}',
            });
        </script>
    @endif

    {{-- Mostrar éxito --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session("success") }}',
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const forms = document.querySelectorAll('.form-eliminar');

            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // evita el envío inmediato

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción no se puede deshacer",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // solo se envía si se confirma
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
