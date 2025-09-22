<div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('back.users.update', $user->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Name</label>
                            <input type="text" id="nameBasic" name="name" class="form-control"
                                placeholder="Enter Name" value="{{ $user->name }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="emailBasic" class="form-label">Email</label>
                            <input type="email" id="emailBasic" name="email" class="form-control"
                                placeholder="xxxx@xxx.xx" value="{{ $user->email }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="col mb-0">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <small class="fw-semibold">Status</small>
                            <div class="d-flex gap-3 mt-2">
                                <div class="form-check">
                                    <input name="status" class="form-check-input" type="radio" value="1"
                                        id="defaultRadio1-{{ $user->id }}"
                                        {{ $user->email_verified_at ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="defaultRadio1-{{ $user->id }}">Active</label>
                                </div>
                                <div class="form-check">
                                    <input name="status" class="form-check-input" type="radio" value="0"
                                        id="defaultRadio2-{{ $user->id }}"
                                        {{ !$user->email_verified_at ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultRadio2-{{ $user->id }}">Not
                                        active</label>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
