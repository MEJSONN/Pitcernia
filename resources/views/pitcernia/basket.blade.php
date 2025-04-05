@extends('layouts.pitcernia.app')

@section('content')
    <div class="row g-4">
        <!-- Lista pozycji -->
        <div class="col-md-8">
            <div class="border rounded p-3 bg-light shadow-sm mb-3">
                <div class="row align-items-center">

                    <!-- Obraz i opis -->
                    <div class="col-md-5 d-flex align-items-center gap-3">
                        <img src="{{ asset('images/wolina.jpeg') }}" style="width: 100px" class="rounded">
                        <div>
                            <h5 class="mb-1">Wolina</h5>
                            <small class="text-muted">Sos, szynka, ser</small>
                        </div>
                    </div>

                    <!-- Ilość -->
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="input-group" style="max-width: 160px;">
                            <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                            <input type="number" class="form-control text-center quantity-input" value="1"
                                min="1">
                            <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                        </div>
                    </div>

                    <!-- Cena i usuń -->
                    <div class="col-md-4 d-flex justify-content-end align-items-center gap-3">
                        <div class="fw-bold fs-5 text-nowrap">2137 zł</div>
                        <button class="btn btn-sm btn-outline-danger" type="button">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>


            <!-- Drugie danie -->
            <div class="border rounded p-3 bg-light shadow-sm mb-3">
                <div class="row align-items-center">

                    <!-- Obraz i opis -->
                    <div class="col-md-5 d-flex align-items-center gap-3">
                        <img src="{{ asset('images/wolina.jpeg') }}" style="width: 100px" class="rounded">
                        <div>
                            <h5 class="mb-1">Wolina</h5>
                            <small class="text-muted">Sos, szynka, ser</small>
                        </div>
                    </div>

                    <!-- Ilość -->
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="input-group" style="max-width: 160px;">
                            <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                            <input type="number" class="form-control text-center quantity-input" value="1"
                                min="1">
                            <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                        </div>
                    </div>

                    <!-- Cena i usuń -->
                    <div class="col-md-4 d-flex justify-content-end align-items-center gap-3">
                        <div class="fw-bold fs-5 text-nowrap">2137 zł</div>
                        <button class="btn btn-sm btn-outline-danger" type="button">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Podsumowanie zamówienia -->
        <div class="col-md-4">
            <div class="border rounded p-3 bg-light shadow">
                <div class="mb-3 border p-3 rounded">
                    <h5 class="mb-2">Adres dostawy:</h5>
                    <div class="text-muted">Opole, Kościuszki 69</div>
                </div>
                <div class="mb-3 border p-3 rounded">
                    <h5 class="mb-2">Cena całkowita:</h5>
                    <div class="fw-bold fs-4">10 685 zł</div>
                </div>
                <button type="button" class="btn btn-outline-secondary w-100 py-2">
                    Złóż zamówienie
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('click', e => {
        if (e.target.matches('.btn-plus')) {
            const input = e.target.closest('.input-group').querySelector('input');
            input.value = +input.value + 1;
        }
        if (e.target.matches('.btn-minus')) {
            const input = e.target.closest('.input-group').querySelector('input');
            if (+input.value > 1) input.value = +input.value - 1;
        }
    });
</script>
@endpush