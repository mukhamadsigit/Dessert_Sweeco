@extends('layouts.master')

@section('title', 'Layout Verification')

@section('content')
<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 font-bold text-gray-800">Verification Page</h1>
            <p class="lead text-gray-600">Testing Tailwind CSS + Bootstrap Integration</p>
        </div>
    </div>

    <!-- Tailwind Section -->
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xl border border-gray-100 mb-8">
        <h2 class="text-3xl font-bold text-red-500 mb-4">Tailwind CSS Component</h2>
        <p class="text-gray-600 mb-6">This card is styled using purely Tailwind CSS classes.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-red-50 rounded-xl border border-red-100">
                <h3 class="font-bold text-red-800 mb-2">Tailwind Flexbox</h3>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">1</div>
                    <div class="w-12 h-12 bg-red-400 rounded-full flex items-center justify-center text-white font-bold">2</div>
                    <div class="w-12 h-12 bg-red-300 rounded-full flex items-center justify-center text-white font-bold">3</div>
                </div>
            </div>
            <div class="p-6 bg-blue-50 rounded-xl border border-blue-100">
                <h3 class="font-bold text-blue-800 mb-2">Tailwind Typography</h3>
                <p class="text-sm text-blue-600">The quick brown fox jumps over the lazy dog.</p>
            </div>
        </div>
        <button class="mt-6 px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
            Tailwind Button
        </button>
    </div>

    <!-- Bootstrap Section -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0 h4">Bootstrap Component</h3>
        </div>
        <div class="card-body">
            <p class="card-text text-muted">This card is styled using standard Bootstrap 5 classes.</p>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="alert alert-success" role="alert">
                        A simple Bootstrap alert—check it out!
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Bootstrap Accordion
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" class="btn btn-primary btn-lg mt-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top">
                Bootstrap Button
            </button>
            <button type="button" class="btn btn-outline-secondary btn-lg mt-3">
                Bootstrap Outline
            </button>
        </div>
    </div>
</div>
@endsection
