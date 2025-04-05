@extends('layouts.pitcernia.app')
@section('content')

<div class="container my-4">
    <!-- Komunikat -->
    <div class="alert alert-success text-center fw-bold fs-5" role="alert">
        Wydałeś u nas 2137 zł
    </div>

    <!-- Blok: Aktywne zamówienia -->
    <div class="mb-4">
        <h4 class="mb-3">Aktywne zamówienia</h4>
        <div class="accordion" id="activeOrdersAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingActive1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseActive1" aria-expanded="false" aria-controls="collapseActive1">
                        Zamówienie #1234
                    </button>
                </h2>
                <div id="collapseActive1" class="accordion-collapse collapse" aria-labelledby="headingActive1" data-bs-parent="#activeOrdersAccordion">
                    <div class="accordion-body">

                        <!-- Lista pozycji -->
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light h-100">
                                    <div class="fw-bold">Pizza Wolina</div>
                                    <div>Ilość: 1</div>
                                    <div>Cena: 32,00 zł</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light h-100">
                                    <div class="fw-bold">Pepsi 0.5L</div>
                                    <div>Ilość: 2</div>
                                    <div>Cena: 6,00 zł</div>
                                </div>
                            </div>
                        </div>
                        <div class="container d-flex justify-content-between">
                            <!-- Status zamówienia -->
                            <div class="text-end mt-3 fw-bold fs-5 h-100">
                                <span class="badge bg-warning text-dark">W przygotowaniu</span>
                            </div>
                            <!-- Łączna wartość -->
                            <div class="text-end mt-3 fw-bold fs-5">
                                Razem: 44,00 zł
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blok: Zrealizowane zamówienia -->
    <div class="mb-4">
        <h4 class="mb-3">Zrealizowane zamówienia</h4>
        <div class="accordion" id="completedOrdersAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingCompleted1">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompleted1" aria-expanded="false" aria-controls="collapseCompleted1">
                        Zamówienie #1022
                    </button>
                </h2>
                <div id="collapseCompleted1" class="accordion-collapse collapse" aria-labelledby="headingCompleted1" data-bs-parent="#completedOrdersAccordion">
                    <div class="accordion-body">
                        <!-- Lista pozycji -->
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light h-100">
                                    <div class="fw-bold">Zapiekanka Szefa</div>
                                    <div>Ilość: 1</div>
                                    <div>Cena: 18,50 zł</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light h-100">
                                    <div class="fw-bold">Sok pomarańczowy</div>
                                    <div>Ilość: 1</div>
                                    <div>Cena: 6,00 zł</div>
                                </div>
                            </div>
                        </div>

                        <!-- Łączna wartość -->
                        <div class="text-end mt-3 fw-bold fs-5">
                            Razem: 24,50 zł
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
