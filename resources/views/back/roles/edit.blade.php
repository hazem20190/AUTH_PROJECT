<div class="modal fade  text-start" id="editModal-{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ route('back.roles.update', $role->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edite role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Role_Name</label>
                            <input type="text" id="nameBasic" name="name" class="form-control"
                                placeholder="Enter Name" value="{{ old('name', $role->name) }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <div class="col-md">
                                <small class="form-label ">Permissions</small>
                                @foreach ($permissions as $permission)
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                value="{{ $permission->name }}"
                                                id="edit-tCheck1-{{ $permission->name }}" name="permissions[]"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} />
                                            <label class="form-check-label" for="edit-tCheck1-{{ $permission->name }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('permissions')" class="mt-2" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
            </form>
        </div>
    </div>
</div>
