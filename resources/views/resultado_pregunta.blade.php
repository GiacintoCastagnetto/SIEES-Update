@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card p-5">
          <div class="card mb-4 w-fit">
            <div
              class="card-header d-flex align-items-center justify-content-between gap-2">
              <strong>Detalles de pregunta</strong>
              <span
                class="d-flex justify-content-center align-items-center badge rounded-pill text-bg-dark px-2">
                {{ $pregunta->id }}
              </span>
            </div>
            <div class="card-body d-flex flex-column gap-2">
              <div class="d-flex align-items-center flex-wrap gap-2">
                <span
                  class="d-flex justify-content-center align-items-center badge rounded-pill text-bg-info px-2">
                  {{ $pregunta->getNombreArea() }}
                </span>
                <span
                  class="d-flex justify-content-center align-items-center badge rounded-pill text-bg-light px-2">
                  {{ $pregunta->getNombreTema() }}
                </span>
              </div>
              <h2 class="fw-bold fs-4 card-title">
                {{ $pregunta->pregunta }}
              </h2>
              <div>
                <h3 class="fs-5 mb-0">
                  {{ $pregunta->metrica_evaluacion->nombre }}
                </h3>
                <p class="m-0">{{ $pregunta->metrica_evaluacion->descripcion }}
                </p>
              </div>

            </div>
            <div class="card-footer d-flex flex-column gap-2">
              <div class="d-flex gap-2">
                <div>
                  <strong>Creada: </strong>
                  {{ $pregunta->created_at?->format('d/m/Y') ?? 'N/A' }}
                </div>
                <div>
                  <strong>Actualizada: </strong>
                  {{ $pregunta->updated_at?->format('d/m/Y') ?? 'N/A' }}
                </div>
              </div>
            </div>
          </div>

          <table id="tabla_encuestas" class="table-striped table"
            style="width:100%">
            <thead>
              <tr>
                <th>ID Encuesta</th>
                <th>Empleador</th>
                <th>Respuesta</th>
                <th>Fechas encuesta</th>
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
    let table;

    $(function() {
      table = $('#tabla_encuestas').DataTable({
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
          "url": '{!! route('lista_respuesta_pregunta') !!}',
          "type": 'POST',
          data: {
            id_pregunta: "{{ $pregunta->id }}",
          },
        },
        columns: [{
            data: 'id',
            render: function(id) {
              const url =
                "{{ route('resultado_encuesta', ':id') }}"
              const replacedUrl = url.replace(':id', id);
              return `<a href="${replacedUrl}">${id}</a>`;
            }
          },
          {
            data: 'empleador',
            render: function(empleador) {
              const nombre = empleador.nombre || 'N/A Nombre';
              const empresa = empleador.empresa || 'N/A Empresa';
              const puesto = empleador.puesto || 'N/A Puesto';

              return `<div class="d-flex flex-column gap-0">
                <strong class="m-0 p-0">${nombre}</strong>
                <div>
                  ${empresa} |  ${puesto}
                </div>
              </div>`;
            }
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
          {
            data: 'fechas',
            render: function(fechas) {
              const {
                created_at,
                updated_at
              } = fechas;

              // https://lenguajejs.com/javascript/fechas/formatear-fechas-con-intl/
              const mxDateFormat = new Intl.DateTimeFormat(
                undefined, {
                  year: "numeric",
                  month: "2-digit",
                  day: "2-digit",
                });

              const [createdAt, updatedAt] = [created_at, updated_at]
              .map(date => {
                return date ?
                  mxDateFormat.format(new Date(date)) :
                  'N/A';
              });

              return `<div class="d-flex flex-column gap-2">
                <strong>Creada: </strong> ${createdAt}
                <strong>Actualizada: </strong> ${updatedAt}
              </div>`;
            }
          },
        ],
        order: [
          [0, "desc"]
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
