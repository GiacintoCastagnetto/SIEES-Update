@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card p-5">
          <div class="card mb-4 w-fit">
            <div class="card-header">
              <strong>Detalles de la encuesta</strong>
            </div>
            <div class="card-body">
              <h4 class="card-title mb-0">
                <strong>
                  {{ $encuesta?->titulo ?? 'No se ha especificado un título' }}
                </strong>
              </h4>
              <p>
                {{ $encuesta?->descripcion ?? 'No se ha especificado una descripción' }}
              </p>
              <h5 class="card-title">
                {{ $encuesta->nombre ? $encuesta->nombre : 'No se ha especificado un nombre del empleador' }}
              </h5>
              <h6 class="card-subtitle d-flex text-body-secondary mb-2 gap-2">
                <div>
                  <strong>Empresa:</strong>
                  {{ $encuesta->empresa ? $encuesta->empresa : 'No especificado' }}
                </div>
                |
                <div>
                  <strong>Puesto:</strong>
                  {{ $encuesta->puesto ? $encuesta->puesto : 'No especificado' }}
                </div>
              </h6>
              <a href="{{ route('encuesta', $encuesta->token_encuesta) }}"
                target="_blank" class="btn btn-primary">
                🔗 Acceder a la encuesta
              </a>
            </div>
            <div class="card-footer d-flex gap-2">
              @foreach ($encuesta->getStatusLabels() as $label)
                <span
                  class="d-flex justify-content-center align-items-center badge rounded-pill {{ $label['class'] }} px-2">
                  {{ $label['text'] }}
                </span>
              @endforeach

              <div>
                <strong>Creada: </strong>
                {{ $encuesta->created_at?->format('d/m/Y') ?? 'N/A' }}
              </div>

              <div>
                <strong>Actualizada: </strong>
                {{ $encuesta->updated_at?->format('d/m/Y') ?? 'N/A' }}
              </div>
            </div>
          </div>
          <table id="tabla_encuestas" class="table-striped table"
            style="width:100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Pregunta</th>
                <th>Área</th>
                <th>Tema</th>
                <th>Métrica</th>
                <th>Respuesta</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- ----------------------------------------------------- --}}
  </div>
@endsection

@push('scripts')
  <script>
    $(function() {
      const table = $('#tabla_encuestas').DataTable({
        lengthMenu: [
          [10, 50, 300],
          [10, 50, 300]
        ],
        dom: 'Blfrtip',
        buttons: [
          'csv', 'excel', 'pdf'
        ],
        processing: true,
        serverSide: true,
        responsive: false,
        searching: true,
        ajax: {
          "url": '{!! route('preguntas_encuesta') !!}',
          "type": 'GET',
          data: {
            id_encuesta: "{{ $encuesta->id }}",
          },
        },
        columns: [{
            data: 'id',
            render: function(id) {
              const baseUrl =
                "{{ route('preguntas.show', ':id') }}";
              const url = baseUrl.replace(':id', id);

              return `<a href="${url}">${id}</a>`;
            }
          },
          {
            data: 'pregunta'
          },
          {
            data: 'area'
          },
          {
            data: 'tema'
          },
          {
            data: 'metricaEvaluacion'
          },
          {
            data: 'respuestas',
            render: (respuestas) => {
              if (respuestas.length === 0) {
                return "<strong><i>N/A</i></strong>";
              }

              if (respuestas.length === 1) {
                return `<strong>${respuestas[0]}</strong>`;
              }

              const responseList = respuestas.map((respuesta) => {
                return `<li><strong>${respuesta}</strong></li>`;
              }).join('');

              return `<ol class="d-flex flex-column m-0 p-0 fw-bold">
                  ${responseList}
                </ol>
              `;
            }
          },
        ],
        order: [
          [0, "asc"]
        ],
        language: {
          "processing": "Procesando...",
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "emptyTable": "Ningún dato disponible en esta tabla",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "search": "Buscar:",
          "infoThousands": ",",
          "loadingRecords": "Cargando...",
          "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
          },
          "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
          },
          "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad",
            "collection": "Colección",
            "colvisRestore": "Restaurar visibilidad",
            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
            "copySuccess": {
              "1": "Copiada 1 fila al portapapeles",
              "_": "Copiadas %d fila al portapapeles"
            },
            "copyTitle": "Copiar al portapapeles",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
              "-1": "Mostrar todas las filas",
              "_": "Mostrar %d filas"
            },
            "pdf": "PDF",
            "print": "Imprimir"
          },
          "autoFill": {
            "cancel": "Cancelar",
            "fill": "Rellene todas las celdas con <i>%d<\/i>",
            "fillHorizontal": "Rellenar celdas horizontalmente",
            "fillVertical": "Rellenar celdas verticalmentemente"
          },
          "decimal": ",",
          "searchBuilder": {
            "add": "Añadir condición",
            "button": {
              "0": "Constructor de búsqueda",
              "_": "Constructor de búsqueda (%d)"
            },
            "clearAll": "Borrar todo",
            "condition": "Condición",
            "conditions": {
              "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
              },
              "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
              },
              "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de"
              },
              "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
              }
            },
            "data": "Data",
            "deleteTitle": "Eliminar regla de filtrado",
            "leftTitle": "Criterios anulados",
            "logicAnd": "Y",
            "logicOr": "O",
            "rightTitle": "Criterios de sangría",
            "title": {
              "0": "Constructor de búsqueda",
              "_": "Constructor de búsqueda (%d)"
            },
            "value": "Valor"
          },
          "searchPanes": {
            "clearMessage": "Borrar todo",
            "collapse": {
              "0": "Paneles de búsqueda",
              "_": "Paneles de búsqueda (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Sin paneles de búsqueda",
            "loadMessage": "Cargando paneles de búsqueda",
            "title": "Filtros Activos - %d"
          },
          "select": {
            "cells": {
              "1": "1 celda seleccionada",
              "_": "%d celdas seleccionadas"
            },
            "columns": {
              "1": "1 columna seleccionada",
              "_": "%d columnas seleccionadas"
            },
            "rows": {
              "1": "1 fila seleccionada",
              "_": "%d filas seleccionadas"
            }
          },
          "thousands": ".",
          "datetime": {
            "previous": "Anterior",
            "next": "Proximo",
            "hours": "Horas",
            "minutes": "Minutos",
            "seconds": "Segundos",
            "unknown": "-",
            "amPm": [
              "AM",
              "PM"
            ],
            "months": {
              "0": "Enero",
              "1": "Febrero",
              "10": "Noviembre",
              "11": "Diciembre",
              "2": "Marzo",
              "3": "Abril",
              "4": "Mayo",
              "5": "Junio",
              "6": "Julio",
              "7": "Agosto",
              "8": "Septiembre",
              "9": "Octubre"
            },
            "weekdays": [
              "Dom",
              "Lun",
              "Mar",
              "Mie",
              "Jue",
              "Vie",
              "Sab"
            ]
          },
          "editor": {
            "close": "Cerrar",
            "create": {
              "button": "Nuevo",
              "title": "Crear Nuevo Registro",
              "submit": "Crear"
            },
            "edit": {
              "button": "Editar",
              "title": "Editar Registro",
              "submit": "Actualizar"
            },
            "remove": {
              "button": "Eliminar",
              "title": "Eliminar Registro",
              "submit": "Eliminar",
              "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
              }
            },
            "error": {
              "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
            },
            "multi": {
              "title": "Múltiples Valores",
              "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
              "restore": "Deshacer Cambios",
              "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
            }
          },
          "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
        },
      });
    });
  </script>
@endpush
