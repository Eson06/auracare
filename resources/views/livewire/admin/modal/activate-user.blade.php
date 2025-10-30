<div>
    <div wire:ignore.self class="modal fade" id="activateUserModal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">

    <form class="modal-content" method="POST" wire:submit.prevent="updateActivateUser()">

        <div class="modal-body text-center py-4">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <svg class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
            <h3>Are you sure?</h3>
            <div class="text-secondary">Do you really want to <strong>{{ $UserisActive == true ? 'Activate' : 'Deactivate'}}</strong> this User?</div>
        </div>
        <div class="modal-footer">
        <div class="w-100">
            <div class="row">
            <div class="col-6"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                Cancel
                </a></div>
            <div class="col-6"> <button type="submit" class="btn  {{ $UserisActive == true ? 'btn-primary' : 'btn-danger'}}"> {{ $UserisActive == true ? 'Activate' : 'Deactivate'}} User</button></div>
            </div>
        </div>
        </div>
    </form>
</div>
</div>
</div>

