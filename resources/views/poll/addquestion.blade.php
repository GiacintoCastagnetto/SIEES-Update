@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card p-5">
          <div class="row mb-2">
            <div class="col-sm-11">
              <h1>Preguntas</h1>
            </div>
            <div class="col-sm-1">
              <button type="button" id="agregar" class="btn btn-success mb-4"
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
          </div>
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          @if ($errors->any())
            <div class="">
              <ul class="d-flex list-unstyled gap-2">
                @foreach ($errors->all() as $error)
                  <li class="alert alert-danger m-0">{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          <table id="tabla_preguntas" class="table-striped table"
            style="width:100%">
            <thead>
              <tr>
                <th>Pregunta</th>
                <th>Tema</th>
                <th>Métrica</th>
                <th># de respuestas</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <form class="modal-content" method="POST"
        action="{{ route('preguntas.store') }}">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Agregar
            pregunta</h5>
          <button type="button" class="close" data-bs-dismiss="modal"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex flex-column gap-2">
          <div>
            <label class="form-label">Escribe una pregunta</label>
            <input type="text" name="pregunta" class="form-control"
              value="{{ old('pregunta') }}"
              placeholder="Ej. ¿Qué lenguas extranjeras requiere el empleado?">
          </div>

          <div>
            <label class="form-label">Tema de la pregunta</label>
            <select class="form-select" name="tema"
              aria-label="Default select example">
              <option selected>Elige un tema</option>
              @foreach ($temas as $tema)
                <option {{ old('tema') == $tema->id ? 'selected' : '' }}
                  value="{{ $tema->id }}">{{ $tema->tema }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="form-label">Escala</label>
            <select class="form-select" name="metrica"
              aria-label="Default select example">
              <option selected>Selecciona la escala</option>
              @foreach ($metrics as $metric)
                <option {{-- Select option based on old 'metrica' value --}}
                  {{ old('metrica') == $metric->id ? 'selected' : '' }}
                  value="{{ $metric->id }}">{{ $metric->nombre }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Options input container -->
          <div id="optionsContainer" style="display: none;">
            <label class="form-label">Opciones (máximo 7)</label>
            <p id="maxOptionsMessage" class="text-danger font-weight-bold m-0"
              style="display: none;">Has alcanzado el máximo número de opciones.
            </p>
            <div id="optionsWrapper" class="d-flex flex-column mb-1 gap-1">
              <!-- Additional options will be appended here -->
            </div>
            <button type="button" class="btn btn-info"
              id="addOptionButton">Agregar opción</button>
          </div>
                 <!-- Area deshabilitado -->
        <div class="mb-3">
          <label class="form-label">Selecciona el área (Funcionalidad a Futuro)</label>
          <!-- Lista desplegable de áreas deshabilitada -->
          <select name="area[]" id="selectArea" class="form-control" multiple disabled style="font-size: 12px; padding: 5px; height: 2rem;">
              <!-- Tus opciones de áreas aquí -->
          </select>
      </div>
        </div>

 


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">
            Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    const MULTIPLE_CHOICE_METRIC_ID = 3;
    const MAX_OPTIONS = 7;
    document.addEventListener('DOMContentLoaded', function() {
      const metricSelect = document.querySelector('select[name="metrica"]');
      const optionsContainer = document.getElementById('optionsContainer');
      const optionsWrapper = document.getElementById('optionsWrapper');
      const addOptionButton = document.getElementById('addOptionButton');
      const maxOptionsMessage = document.getElementById('maxOptionsMessage');

      const MULTIPLE_CHOICE_METRIC_ID = 3;
      const MAX_OPTIONS = 7;
      let addedOptions = 0; // Initialize with 0

      const areMaxOptions = () => addedOptions >= MAX_OPTIONS;

      function showOptions() {
        if (Number(metricSelect.value) === MULTIPLE_CHOICE_METRIC_ID) {
          optionsContainer.style.display = 'block';
          return;
        }

        // Keep the options container hidden if the metric is not multiple choice.
        optionsContainer.style.display = 'none';
      }

      function addOption() {
        if (areMaxOptions()) {
          addOptionButton.disabled = true;
          maxOptionsMessage.style.display = 'block';
          return;
        }

        // Check if the last option input is empty
        const lastOption = optionsWrapper.lastElementChild;
        const isLastOptionEmpty =
          lastOption && lastOption.firstChild.value.trim() === '';

        if (isLastOptionEmpty) {
          lastOption.firstChild.focus();
          return;
        }

        const container = document.createElement('div');
        container.className = 'd-flex flex-row gap-1';

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'opciones[]';
        newInput.className = 'form-control';
        newInput.placeholder = `Ej. Opción ${addedOptions + 1}`;

        // Add delete button next to the new input
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.innerHTML = 'Eliminar';

        deleteButton.addEventListener('click', () => removeOption(container));

        // Append the new input and delete button to the wrapper
        container.appendChild(newInput);
        container.appendChild(deleteButton);

        optionsWrapper.appendChild(container);

        // Update the count of added options
        addedOptions++;

        newInput.focus();
        // Hide the max options message if it was displayed
        maxOptionsMessage.style.display = 'none';

        // Enable the add option button if it was disabled
        addOptionButton.disabled = false;
      }

      function removeOption(container) {
        // Check if there is only one option remaining
        if (addedOptions === 1) {
          return;
        }

        // Find the index of the removed container
        const index = Array.from(optionsWrapper.children).indexOf(container);

        // Remove the container (option and delete button)
        container.remove();

        // Update the count of added options
        addedOptions--;

        // Enable the add option button if the max options limit was not reached
        if (!areMaxOptions()) {
          addOptionButton.disabled = false;
          maxOptionsMessage.style.display = 'none';
        }
      }

      // Attach the showOptions function to the change event of the metric select
      metricSelect.addEventListener('change', showOptions);

      // Attach the addOption function to the click event of the addOptionButton
      addOptionButton.addEventListener('click', addOption);

      // Call showOptions initially to check the initial value of the metric select
      showOptions();
      // Add an initial option
      addOption();
    });

    let table;

    function guardar(params) {
      $.ajax({
        type: "POST",
        url: "{{ route('agrega_pregunta') }}",
        data: {
          pregunta: $("#enviar_pregunta").val(),
          tema: $("#enviar_tema").val(),
          area: 1
        },
        success: function(datos) {
          table.ajax.reload();
        },
      });

    }

    $(function() {
      table = $('#tabla_preguntas').DataTable({
        lengthMenu: [
          [10, 50, 300],
          [10, 50, 300]
        ],
        processing: true,
        serverSide: true,
        responsive: false,
        searching: true,
        ajax: {
          "url": '{!! route('lista_pregunta') !!}',
          "type": 'GET',
        },
        columns: [{
            data: 'id',
            "render": function(id, type, row) {
              const baseUrl =
                "{{ route('preguntas.show', ':id') }}";
              const url = baseUrl.replace(':id', id);

              return `<a href="${url}">${row.pregunta}</a>`;
            }
          },
          //   {
          //     data: 'area'
          //   },
          {
            data: 'tema'
          },
          {
            data: 'metrica_evaluacion'
          },
          {
            data: 'numero_respuestas'
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
