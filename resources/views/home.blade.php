@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card p-5">
          <div class="row mb-2">
            <div class="d-flex justify-content-between mb-2 gap-2">
              <div>
                <h1>Encuestas</h1>
               <!-- <a href={{ url('plan-de-estudios/PE_ISI-may-2023.pdf') }} -->
                <a href={{ url('plan-de-estudios/PE_ISI-nov-2023.pdf') }}  
                target="_blank">
                  Descargar plan de estudios ISI
                </a>
              </div>
              <button type="button" id="agregar"
                class="btn btn-success d-flex justify-content-center align-items-center mb-0"
                data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-plus" width="28"
                  height="28" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="#ffffff" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 5l0 14" />
                  <path d="M5 12l14 0" />
              </button>
            </div>

          @if (isset($status))
          <div class="alert alert-success w-100 mb-2">
            <p>{{ $status }}</p>
              @foreach (session('urls') as $index => $url)
                <div>
                  Link de la encuesta {{ $index + 1 }}: 
                  <a href="{{ route('encuesta', $url) }}" target="_blank">
                    {{ route('encuesta', $url) }}
                  </a>
                </div>
              @endforeach
          </div>
        @endif
        
          <table id="tabla_encuestas" class="table-striped table"
            style="width:100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Nombre</th>
                <th>Empresa</th>
                <th>Puesto</th>
                <th>Respuestas</th>
                <th>Encuesta</th>
                <th>Fechas</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal: Crear encuesta --}}
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form class="modal-content" action="{{ route('genera_url') }}"
        method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Crear encuesta</h5>
          <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex flex-column gap-2">



          <label class="form-label mb-0">Título de la Encuesta</label>
          <!-- Campo de entrada de texto para el título de la encuesta -->
          <input type="text" placeholder="Identifica una campaña de encuestas - Ej: 'REDES-01'" name="titulo" class="form-control" required>

          <label class="form-label mb-0">Descripción de la Encuesta</label>
          <!-- Área de texto para la descripción de la encuesta -->
          <textarea placeholder="Describe el propósito de tu encuesta - Ej: Identificar los conocimientos de..." name="descripcion" class="form-control" rows="3" required></textarea>


          <label class="form-label mb-0">Selecciona las preguntas de la encuesta</label>
          <!-- Agrega la lista desplegable de preguntas -->
          <select name="preguntas[]" id="selectPreguntas" class="form-control" multiple>
            <!-- Opción predeterminada -->
            @foreach ($preguntas as $pregunta)
              <option {{ $loop->first ? 'selected' : '' }}
                value="{{ $pregunta->id }}"> {{ $pregunta->pregunta }}
              </option>
            @endforeach
          </select>
                <!-- Agrega numero de cuantas encuestas quieres agregar -->
                <div class="mb-3">
                  <label for="numeroEncuestas" class="form-label">Número de encuestas:</label>
                  <input type="number" class="form-control" id="numeroEncuestas" name="numeroEncuestas" min="1" required>
              </div>


              <label class="form-label">Selecciona el área (Funcionalidad a Futuro)</label>
              <!-- Lista desplegable de áreas deshabilitadaS, Rercordando que se debe subir antes de poder seleccionar las preguntas-->
            <select name="area" id="selectArea" class="form-control" multiple disabled style="font-size: 12px; padding: 5px; height: 2rem;" >
            <!-- Opciones de áreas aquí -->
            </select>
            </div>
            <div class="modal-footer d-flex gap-1">
        <button type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">Cerrar</button>
          <button class="btn btn-success" type="submit">Generar link de
            encuesta</button>

        </div>
      </form>
    </div>
  </div>


  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    rel="stylesheet">
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js">
  </script>
  <script>
    $(document).ready(function() {
      $('#selectPreguntas').select2();
    });
  </script>
@endsection

@push('scripts')
  <script>
    const renderCellData = (data) => {
      if (data) return data;

      return "<strong><i>N/A</i></strong>";
    };

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
          "url": '{!! route('lista_encuesta') !!}',
          "type": 'POST',
        },
        columns: [{
            data: 'id',
            "render": function(id) {
              const url =
                "{{ route('resultado_encuesta', ':id') }}"
              const replacedUrl = url.replace(':id', id);
              return `<a href="${replacedUrl}">${id}</a>`;
            }
          },
          {
            data: 'titulo',
            "render": renderCellData
          },
          {
            data: 'nombre',
            "render": renderCellData
          },
          {
            data: 'empresa',
            "render": renderCellData
          },
          {
            data: 'puesto',
            "render": renderCellData
          },
          {
            data: 'preguntas',
            "render": function(preguntas, type, row) {
              const {
                total,
                respondidas
              } = preguntas;

              const count = `${respondidas} / ${total}`;
              const emoji = respondidas === total ? '✅' : '🟧';

              return `<strong class='text-red-500'>${emoji} ${count}</strong>`;
            }
          },
          {
            data: 'token_encuesta',
            "render": function(token) {
              const url =
                "{{ route('encuesta', ':token_encuesta') }}"
              const replacedUrl = url.replace(':token_encuesta',
                token);
              return `<a href="${replacedUrl}">${token}</a>`;
            }
          },
          {
            data: 'created_at',
            "render": function(created_at, type, row) {
              const mxDateFormat = new Intl.DateTimeFormat('es-MX');

              const [createdAt, updatedAt] = [created_at, row
                .updated_at
              ].map(date => {
                return date ?
                  mxDateFormat.format(new Date(date)) :
                  'N/A';
              });

              return `<div class="d-flex flex-column gap-2">
                <strong>Creada:</strong> ${createdAt}
                <strong>Actualizada:</strong> ${updatedAt}
              </div>`;
            }
          }
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
