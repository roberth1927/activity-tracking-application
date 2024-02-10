@section('title', __('Actividades'))
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Listado de Actividades  </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.3s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Buscar Actividades">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Agregar Actividades
						</div>
					</div>
				</div>

				<div class="card-body">
						@include('livewire.actividades.modals')
				<div class="table-responsive rounded">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr>
								<td >#</td>
								<th>Descripcion</th>
								<th>Estado</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($actividades as $row)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $row->descripcion }}</td>
								<td>{{ $row->estado ? 'Completada' : 'Pendiente' }}</td>

                                <td width="90" class="text-center">
                                    <div class="btn-group">
                                        <a data-bs-toggle="modal"
                                            data-bs-placement="top"
                                            title="Editar"
                                            x-data="{ scale: 1 }"
                                            x-bind:style="{ transform: 'scale(' + scale + ')',transition: 'transform 0.3s ease' }"
                                            @mouseenter="scale = 1.2" @mouseleave="scale = 1"
                                            data-bs-target="#updateDataModal"
                                            class="btn btn-sm btn-success rounded"
                                            wire:click="edit({{ $row->id }})">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a data-bs-toggle="modal"
                                            data-bs-placement="top"
                                            title="Ver Horas"
                                            x-data="{ scale: 1 }"
                                            x-bind:style="{ transform: 'scale(' + scale + ')',transition: 'transform 0.3s ease' }"
                                            @mouseenter="scale = 1.2" @mouseleave="scale = 1"
                                            data-bs-target="#getTimes"
                                            class="btn btn-sm btn-info ms-2 me-2 rounded"
                                            wire:click="getTimes({{ $row }})">
                                            <i class="fa fa-clock"></i>
                                        </a>

                                        <a data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="Eliminar"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirm('¿Confirmar eliminación de la tarea id {{ $row->id }}? \n¡Las tareas eliminadas no se pueden recuperar!')||event.stopImmediatePropagation()"
                                            wire:click="destroy({{ $row->id }})" x-data="{ scale: 1 }"
                                            x-bind:style="{ transform: 'scale(' + scale + ')',
                                                transition: 'transform 0.3s ease' }"
                                            @mouseenter="scale = 1.2" @mouseleave="scale = 1">
                                            <i class="fa fa-trash rounded"></i>
                                        </a>
                                    </div>

                                </td>


							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>
					<div class="float-end">{{ $actividades->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
