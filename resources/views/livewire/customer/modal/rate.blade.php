<div>
    <!-- ⭐ Rating Modal -->
    <div wire:ignore.self class="modal fade" id="ratemodal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <form class="modal-content shadow-lg border-0 rounded-4" wire:submit.prevent="submitRating">

                <!-- Header -->
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title"><i class="fas fa-star me-2"></i>Rate Service</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <!-- Body -->
                <div class="modal-body p-4">

                    <!-- Star Rating -->
                    <div class="text-center mb-3">
                        <label class="form-label fw-semibold">Your Rating:</label><br>
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" class="btn btn-link text-decoration-none fs-3 p-0"
                                wire:click="$set('rating', {{ $i }})">
                                <i class="fas fa-star {{ $rating >= $i ? 'text-warning' : 'text-secondary' }}"></i>
                            </button>
                        @endfor
                        @error('rating')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">Your Feedback</label>
                        <textarea wire:model.defer="comment" id="comment" class="form-control" rows="3"
                            placeholder="Write your feedback here..."></textarea>
                        @error('comment')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">
                        Submit Rating
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
