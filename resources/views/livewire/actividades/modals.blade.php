<!-- Add Modal -->
<div wire:ignore.self class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nueva Actividad</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="descripcion"></label>
                        <input wire:model="descripcion" type="text" class="form-control" id="descripcion"
                            placeholder="Descripcion">
                        @error('descripcion')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="updateDataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Actualizar Actividad</h5>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">

                    <div class="form-group mb-2">
                        <label for="descripcion">Descripcion</label>
                        <input wire:model="descripcion" type="text" class="form-control" id="descripcion"
                            placeholder="Descripcion">
                        @error('descripcion')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select wire:model="estado" class="form-control form-control-sm" id="estado">
                            <option value="0">Pendiente</option>
                            <option value="1">Completada</option>
                        </select>
                        @error('estado')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="getTimes" data-bs-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="">Tiempos Registrados</h2>
                <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-center p-2 rounded" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">{{ $titleActivity }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="thead">
                            <tr>
                                <td>#</td>
                                <th>Fecha</th>
                                <th>Horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tiempos as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->fecha }}</td>
                                    <td>{{ $row->horas }} </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">No data Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <button type="button" wire:click.prevent="showForm()" class="btn btn-primary m-3">Agregar tiempo</button>


            @if($mostrarFormulario)
            <div class="m-3">
                    <h5 class="modal-title" id="">Agregar Tiempo</h5>

                @if ($errorMessage != '')
						<div wire:poll.3s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ $errorMessage }} </div>
				@endif
                <form>
                    <input type="hidden" wire:model="actividad_id">
                    <div class="form-group">
                        <label for="fecha"></label>
                        <input wire:model="fecha" type="date" class="form-control" id="fecha">
                        @error('fecha')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="horas"></label>
                        <input wire:model="horas" type="number" class="form-control" id="horas"
                            placeholder="Tiempo en horas">
                        @error('horas')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </form>


                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="saveTime()" class="btn btn-primary">Save</button>
                </div>

            </div>
            @endif
        </div>
    </div>
</div>
</div>
