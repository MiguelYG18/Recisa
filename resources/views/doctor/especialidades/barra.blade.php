<div class="row">
    <div class="col" style="margin-top: 20px;">
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="text-primary fw-bold m-0">Cupos por Especialidad</h6>
    </div>
    <div class="card-body">
        {{-- Lista de colores para alternar entre barras de progreso --}}
        @php
            $colores = ['bg-danger', 'bg-warning', 'bg-primary', 'bg-info', 'bg-success'];
            $indiceColor = 0; // Índice para alternar colores
        @endphp
        @foreach ($specialization as $item)
        {{-- Calcular el porcentaje dinámicamente --}}
        @php
          $cupoTotal = $item->cupo_doctor; // Total de cupos para la especialidad
          $citasActuales = 3; // Número actual de citas
          $porcentaje = ($citasActuales / $cupoTotal) * 100; // Calcular el porcentaje de ocupación
          $porcentajeRedondeado = round($porcentaje); // Redondear el porcentaje

          // Obtener el color actual y mover al siguiente para la próxima iteración
          $colorBarra = $colores[$indiceColor]; 
          $indiceColor = ($indiceColor + 1) % count($colores); // Mover al siguiente color
        @endphp
        <h4 class="small fw-bold">
          {{ $item->name }}
          <span class="float-end">
            @if ($porcentajeRedondeado == 100)
              Complete!
            @else
              {{ $porcentajeRedondeado }}%
            @endif
          </span>
        </h4>
        {{-- Barra de progreso con color uniforme --}}
        <div class="progress progress-sm mb-3">
          <div class="progress-bar {{ $colorBarra }}" aria-valuenow="{{ $porcentajeRedondeado }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $porcentajeRedondeado }}%;">
            <span class="visually-hidden">
              {{ $porcentajeRedondeado }}%
            </span>
          </div>
        </div>
      @endforeach
    </div>
</div>
</div>
</div> 